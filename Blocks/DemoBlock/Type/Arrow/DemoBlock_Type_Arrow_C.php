<?php

namespace WpThemeBones\Blocks\DemoBlock\Type\Arrow;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\FrontBlocksFramework\MODEL;
use WpThemeBones\Blocks\DemoBlock\DemoBlock_C;
use WpThemeBones\Classes\CONTROLLER;

class DemoBlock_Type_Arrow_C extends CONTROLLER {

	protected DemoBlock_C $_demoBlock;

	public function __construct( ?MODEL $model = null ) {

		$model = ! $model ?
			new DemoBlock_Type_Arrow() :
			$model;

		parent::__construct( $model );

		$this->_demoBlock = new DemoBlock_C();

	}

	public function getModel(): DemoBlock_Type_Arrow {
		return parent::getModel();
	}

}
