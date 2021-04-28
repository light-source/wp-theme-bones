<?php

namespace WpThemeBones\Blocks\DemoPage;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\FrontBlocksFramework\MODEL;
use WpThemeBones\Blocks\DemoBlock\Type\Arrow\DemoBlock_Type_Arrow;

class DemoPage extends MODEL {

	protected DemoBlock_Type_Arrow $_demoBlockTypeArrow;

	public function __construct() {

		parent::__construct();

		$this->_demoBlockTypeArrow = new DemoBlock_Type_Arrow();

	}

	public function loadByDemo(): void {

		parent::_load();
		$this->_demoBlockTypeArrow->loadArrowTypeByDemo();

	}

}
