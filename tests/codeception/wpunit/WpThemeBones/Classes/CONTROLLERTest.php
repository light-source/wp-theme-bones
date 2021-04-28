<?php

declare( strict_types=1 );

namespace WpThemeBones\Classes;

use Codeception\TestCase\WPTestCase;
use Error;

class CONTROLLERTest extends WPTestCase {

	//////// methods

	public function testTwigTemplates() {

		$blocks            = Fbf::Instance()->getBlocks();
		$controllerClasses = $blocks->getLoadedControllerClasses();

		foreach ( $controllerClasses as $controllerClass ) {

			if ( ! is_subclass_of( $controllerClass, CONTROLLER::class ) ) {
				$this->fail( 'The blocks list is wrong' );
			}

			try {
				$controller = new $controllerClass();
			} catch ( Error $ex ) {
				$this->fail( 'The block constructor is wrong : ' . $controllerClass );
			}

			// 1. for IDE
			// 2. for blocks without model, like js/css only
			if ( ! is_subclass_of( $controller, CONTROLLER::class ) ||
			     ! $controller->getModel() ) {
				continue;
			}

			$this->assertNotEmpty( $blocks->renderBlock( $controller ), 'Wrong block is ' . $controllerClass );

		}

	}

}
