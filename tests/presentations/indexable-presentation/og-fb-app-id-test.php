<?php

namespace Yoast\WP\Free\Tests\Presentations\Indexable_Presentation;

use Yoast\WP\Free\Tests\TestCase;

/**
 * Class OG_FB_App_ID_Test
 *
 * @coversDefaultClass \Yoast\WP\Free\Presentations\Indexable_Presentation
 *
 * @group presentations
 * @group opengraph
 */
class OG_FB_App_ID_Test extends TestCase {
	use Presentation_Instance_Builder;

	/**
	 * Sets up the test class.
	 */
	public function setUp() {
		parent::setUp();

		$this->setInstance();
	}

	/**
	 * Tests the situation where the Facebook app ID is given.
	 *
	 * @covers ::generate_og_fb_app_id
	 */
	public function test_generate_og_fb_app_id() {
		$this->options_helper
			->expects( 'get' )
			->with( 'fbadminapp', '' )
			->once()
			->andReturn( '12345' );

		$this->assertEquals( '12345', $this->instance->generate_og_fb_app_id() );
	}

	/**
	 * Tests the situation where an empty value is returned.
	 *
	 * @covers ::generate_og_fb_app_id
	 */
	public function test_generate_og_fb_app_id_with_empty_return_value() {
		$this->options_helper
			->expects( 'get' )
			->with( 'fbadminapp', '' )
			->once()
			->andReturn( '' );

		$this->assertEmpty( $this->instance->generate_og_fb_app_id() );
	}
}