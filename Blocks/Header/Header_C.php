<?php

namespace WpThemeBones\Blocks\Header;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\FrontBlocksFramework\MODEL;
use WpThemeBones\Classes\CONTROLLER;

class Header_C extends CONTROLLER {

	public function __construct( ?MODEL $model = null ) {

		$model = ! $model ?
			new Header() :
			$model;

		parent::__construct( $model );

	}

	public function getModel(): Header {
		return parent::getModel();
	}

}
