<?php

namespace WpThemeBones\Blocks\Header;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Std\CONTROLLER;

/**
 * Class Header_C
 * @package WpThemeBones\Blocks\Header
 */
final class Header_C extends CONTROLLER {


	//////// constructor


	/**
	 * Header_C constructor.
	 */
	public function __construct() {
		parent::__construct( new Header() );
	}


	//////// override extend methods


	/**
	 * @return Header
	 */
	public function getModel() {
		return parent::getModel();
	}

}
