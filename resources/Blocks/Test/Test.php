<?php

namespace WpThemeBones\Blocks\Test;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\BLOCK;
use WpThemeBones\Blocks\Start\Type\Arrow\Start_Type_Arrow;
use WpThemeBones\Std\THEME;

/**
 * Class Test
 * @package WpThemeBones\Blocks\Test
 */
final class Test extends BLOCK {


	//////// static methods


	/**
	 * @return void
	 */
	public static function Resources() {

		parent::Resources();

		if ( ! THEME::IsTemplate( THEME::TEMPLATE_TEST ) ) {
			return;
		}

		wp_enqueue_style( 'test-css', Theme::DistPagesUrl( 'test/test.min.css' ), [], '1.0.0' );
		wp_enqueue_script( 'test-js', Theme::DistPagesUrl( 'test/test.min.js' ), [ 'jquery', ], '1.0.0' );

	}


	//////// override extends methods


	/**
	 * @return array
	 */
	public function getTemplateArgs() {

		$startTypeArrow = new Start_Type_Arrow();
		$startTypeArrow->loadArrowTypeByTest();

		return [
			'startTypeArrow'     => $startTypeArrow->getTemplateArgs(),
			// just for testing the new names way (locate a twig by namespace)
			'startTypeArrowHtml' => $startTypeArrow->render(),
		];
	}

	//////// getters

	/**
	 * @return bool
	 */
	protected static function _IsHaveResources() {
		return true;
	}

}