<?php

namespace Yoast\WP\Free\Tests\Presentations\Indexable_Home_Page_Presentation;

use Yoast\WP\Free\Tests\TestCase;

/**
 * Class Title_Test
 *
 * @coversDefaultClass \Yoast\WP\Free\Presentations\Indexable_Home_Page_Presentation
 *
 * @group presentations
 * @group title
 */
class Title_Test extends TestCase {
	use Presentation_Instance_Builder;

	/**
	 * Does the setup for testing.
	 */
	public function setUp() {
		$this->setInstance();

		parent::setUp();
	}

	/**
	 * Tests the situation where the title is set.
	 *
	 * @covers ::generate_title
	 */
	public function test_with_title() {
		$this->indexable->title = 'Homepage title';

		$this->assertEquals( 'Homepage title', $this->instance->generate_title() );
	}

	/**
	 * Tests the situation where the title is not set and we fall back to the options title.
	 *
	 * @covers ::generate_title
	 */
	public function test_with_default_fallback() {
		$this->options_helper
			->expects( 'get_title_default' )
			->once()
			->with( 'title-home-wpseo' )
			->andReturn( 'The homepage title' );

		$this->assertEquals( 'The homepage title', $this->instance->generate_title() );
	}

}