<?php

namespace WpThemeBones\Blocks\Start\Type\Arrow;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Std\CONTROLLER;

/**
 * Class Start_Type_Arrow_C
 * @package WpThemeBones\Blocks\Start\Type\Arrow
 */
final class Start_Type_Arrow_C extends CONTROLLER {


	//////// construct


	/**
	 * Start_Type_Arrow_C constructor.
	 */
	public function __construct() {
		parent::__construct( new Start_Type_Arrow() );
	}


	/////// override extend methods


	/**
	 * @return Start_Type_Arrow
	 */
	public function getModel() {
		return parent::getModel();
	}

}
