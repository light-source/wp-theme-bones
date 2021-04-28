<?php

namespace WpThemeBones\Blocks\Footer;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\FrontBlocksFramework\MODEL;
use WpThemeBones\Classes\CONTROLLER;

class Footer_C extends CONTROLLER {

	public function __construct( ?MODEL $model = null ) {

		$model = ! $model ?
			new Footer() :
			$model;

		parent::__construct( $model );

	}

	public function getModel(): Footer {
		return parent::getModel();
	}

}
