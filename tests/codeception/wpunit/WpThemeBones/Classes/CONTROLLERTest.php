<?php

declare( strict_types=1 );

namespace WpThemeBones\Classes;

use Codeception\TestCase\WPTestCase;
use Error;

class CONTROLLERTest extends WPTestCase {

	//////// methods

	public function testTwigTemplates() {

		$blocks = CONTROLLER::GetAllBlocks();

		foreach ( $blocks as $block ) {

			if ( ! is_subclass_of( $block, CONTROLLER::class ) ) {
				$this->fail( 'The blocks list is wrong' );
			}

			try {
				$controller = new $block();
			} catch ( Error $ex ) {
				$this->fail( 'The block constructor is wrong : ' . $block );
			}

			// for IDE
			if ( ! is_subclass_of( $controller, CONTROLLER::class ) ) {
				continue;
			}

			$this->assertNotEmpty( $controller->render(), 'Wrong block is ' . $block );

		}

	}

}
