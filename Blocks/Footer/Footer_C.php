<?php

namespace WpThemeBones\Blocks\Footer;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Classes\CONTROLLER;

class Footer_C extends CONTROLLER {

	public function getModel(): ?Footer {
		/** @noinspection PhpIncompatibleReturnTypeInspection */
		return parent::getModel();
	}

}
