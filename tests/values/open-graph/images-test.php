<?php

namespace Yoast\WP\Free\Tests\Values\Open_Graph;

use Mockery;
use Yoast\WP\Free\Helpers\Image_Helper;
use Yoast\WP\Free\Helpers\Open_Graph\Image_Helper as Open_Graph_Image_Helper;
use Yoast\WP\Free\Helpers\Url_Helper;
use Yoast\WP\Free\Tests\TestCase;
use Yoast\WP\Free\Values\Open_Graph\Images;

/**
 * Class OG_Image_Generator_Test
 *
 * @coversDefaultClass \Yoast\WP\Free\Values\Open_Graph\Images
 *
 * @group values
 * @group opengraph
 * @group opengraph-image
 */
class Images_Test extends TestCase {

	/**
	 * @var Mockery\MockInterface|Open_Graph_Image_Helper
	 */
	protected $open_graph_image_helper;

	/**
	 * @var Mockery\MockInterface|Image_Helper
	 */
	protected $image_helper;

	/**
	 * @var Images
	 */
	protected $instance;

	/**
	 * @var Url_Helper|Mockery\Mock
	 */
	protected $url_helper;

	/**
	 * Setup the tests.
	 */
	public function setUp() {
		parent::setUp();

		$this->image_helper            = Mockery::mock( Image_Helper::class )->makePartial();
		$this->url_helper              = Mockery::mock( Url_Helper::class )->makePartial();
		$this->open_graph_image_helper = Mockery::mock(
			Open_Graph_Image_Helper::class, [ new Url_Helper(), $this->image_helper ]
		)->makePartial();
		$this->instance = new Images( $this->image_helper, $this->url_helper );
		$this->instance->set_helpers( $this->open_graph_image_helper );
	}

	/**
	 * Test adding an image by id.
	 *
	 * @covers ::add_image_by_id
	 */
	public function test_add_image_by_id() {
		$this->open_graph_image_helper
			->expects( 'get_image_url_by_id' )
			->once()
			->with( 1337 )
			->andReturn( 'image.jpg' );

		$this->instance->add_image_by_id( 1337 );

		$this->assertEquals(
			[
				'image.jpg' => [
					'url' => 'image.jpg',
				],
			],
			$this->instance->get_images()
		);
	}

	/**
	 * Test adding an image by id with no image being found.
	 *
	 * @covers ::add_image_by_id
	 */
	public function test_add_image_by_id_no_image_found() {
		$this->open_graph_image_helper
			->expects( 'get_image_url_by_id' )
			->once()
			->with( 1337 )
			->andReturnFalse();

		$this->instance->add_image_by_id( 1337 );

		$this->assertEquals( [], $this->instance->get_images() );
	}

}