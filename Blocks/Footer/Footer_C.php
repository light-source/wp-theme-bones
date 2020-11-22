<?php

namespace WpThemeBones\Blocks\Footer;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Classes\CONTROLLER;

/**
 * Class Footer_C
 * @package WpThemeBones\Blocks\Footer
 */
final class Footer_C extends CONTROLLER {


	//////// construct


	/**
	 * Footer_C constructor.
	 */
	public function __construct() {
		parent::__construct( new  Footer() );
	}


	//////// override extend methods


	/**
	 * @return Footer
	 */
	public function getModel() {
		return parent::getModel();
	}

}
