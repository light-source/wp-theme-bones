<?php

namespace WpThemeBones\Blocks\DemoPage;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\BemBlocks\MODEL;
use WpThemeBones\Blocks\DemoBlock\Type\Arrow\DemoBlock_Type_Arrow_C;

final class DemoPage extends MODEL {

	//////// fields

	protected DemoBlock_Type_Arrow_C $_demoBlockTypeArrow;

	//////// construct

	public function __construct() {

		parent::__construct();

		$this->_demoBlockTypeArrow = new DemoBlock_Type_Arrow_C();

	}

	//////// methods

	public function loadByDemo(): void {
		$this->_demoBlockTypeArrow->getModel()->loadArrowTypeByDemo();
	}

}
