<?php

namespace WpThemeBones\Blocks\DemoBlock\Type\Arrow;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Classes\CONTROLLER;

final class DemoBlock_Type_Arrow_C extends CONTROLLER {

	//////// construct

	public function __construct() {
		parent::__construct( new DemoBlock_Type_Arrow() );
	}

	///////  methods

	/**
	 * @return DemoBlock_Type_Arrow
	 */
	public function getModel() {
		return parent::getModel();
	}

}
