<?php

namespace WpThemeBones\Blocks\DemoBlock;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Classes\CONTROLLER;

final class DemoBlock_C extends CONTROLLER {

	//////// construct

	public function __construct() {
		parent::__construct( new DemoBlock() );
	}

	//////// override extend methods

	/**
	 * @return DemoBlock
	 */
	public function getModel() {
		return parent::getModel();
	}

}
