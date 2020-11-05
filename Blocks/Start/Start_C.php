<?php

namespace WpThemeBones\Blocks\Start;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Std\CONTROLLER;

/**
 * Class Start_C
 * @package WpThemeBones\Blocks\Start
 */
final class Start_C extends CONTROLLER {


	//////// construct


	/**
	 * Start_C constructor.
	 */
	public function __construct() {
		parent::__construct( new Start() );
	}


	//////// override extend methods


	/**
	 * @return Start
	 */
	public function getModel() {
		return parent::getModel();
	}

}
