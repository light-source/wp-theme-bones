<?php

namespace WpThemeBones\Blocks\Test;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\BLOCK;
use WpThemeBones\Blocks\Start\Start;
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

		$start = new Start( 0 );

		return [
			'start' => $start->getTemplateArgs(),
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