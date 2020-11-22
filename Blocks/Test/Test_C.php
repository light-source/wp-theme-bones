<?php

namespace WpThemeBones\Blocks\Test;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Classes\CONTROLLER;
use WpThemeBones\Classes\THEME;

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
	 * @return bool
	 */
	protected static function _IsHaveResources() {
		return THEME::IsTemplate( THEME::TEMPLATE_TEST );
	}


	//////// override extend methods


	/**
	 * @return Test
	 */
	public function getModel() {
		return parent::getModel();
	}

}
