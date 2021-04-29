<?php

namespace WpThemeBones\Blocks\DemoPage;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\FrontBlocksFramework\MODEL;
use WpThemeBones\Blocks\BemBlock\BemBlock_C;
use WpThemeBones\Blocks\DemoBlock\Type\Arrow\DemoBlock_Type_Arrow_C;
use WpThemeBones\Blocks\DemoBlock\Type\Circle\DemoBlock_Type_Circle_C;
use WpThemeBones\Classes\{
	CONTROLLER
};

class DemoPage_C extends CONTROLLER {

	protected BemBlock_C $_bemBlock;
	protected DemoBlock_Type_Arrow_C $_demoBlockTypeArrow;
	protected DemoBlock_Type_Circle_C $_demoBlockTypeCircle;

	public function __construct( ?MODEL $model = null ) {

		parent::__construct( $model );

		$this->__external['_demoBlockTypeArrow']  = [
			'classes' => [ 'demo-block--type--arrow', ],
		];
		$this->__external['_demoBlockTypeCircle'] = [
			'classes' => [ 'demo-block--type--circle', ],
		];

	}

	public function getModel(): ?DemoPage {
		/** @noinspection PhpIncompatibleReturnTypeInspection */
		return parent::getModel();
	}

}
