<?php

namespace WpThemeBones\Blocks\DemoBlock;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\FrontBlocksFramework\MODEL;
use WpThemeBones\Classes\CONTROLLER;

class DemoBlock_C extends CONTROLLER {

	public function __construct( ?MODEL $model = null ) {

		$model = ! $model ?
			new DemoBlock() :
			$model;

		parent::__construct( $model );

	}

	public function getModel(): DemoBlock {
		return parent::getModel();
	}

}
