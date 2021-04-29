<?php

namespace WpThemeBones\Blocks\DemoBlock;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Classes\CONTROLLER;

class DemoBlock_C extends CONTROLLER {

	public function getModel(): ?DemoBlock {
		/** @noinspection PhpIncompatibleReturnTypeInspection */
		return parent::getModel();
	}

}
