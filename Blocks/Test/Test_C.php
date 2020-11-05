<?php

namespace WpThemeBones\Blocks\Test;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Std\CONTROLLER;
use WpThemeBones\Std\THEME;

/**
 * Class Test_C
 * @package WpThemeBones\Blocks\Test
 */
final class Test_C extends CONTROLLER {


	//////// construct


	/**
	 * Test_C constructor.
	 */
	public function __construct() {
		parent::__construct( new Test() );
	}


	//////// static methods


	/**
	 * @return void
	 */
	public static function Resources() {

		parent::Resources();

		wp_enqueue_style( self::GetName(), Theme::DistPagesUrl( 'test/test.min.css' ), [], null );
		wp_enqueue_script( self::GetName(), Theme::DistPagesUrl( 'test/test.min.js' ), [ 'jquery', ], null );

	}


	//////// override extend methods


	/**
	 * @return Test
	 */
	public function getModel() {
		return parent::getModel();
	}


	//////// getters


	/**
	 * @return bool
	 */
	protected static function _IsHaveResources() {
		return THEME::IsTemplate( THEME::TEMPLATE_TEST );
	}

}
