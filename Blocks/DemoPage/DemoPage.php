<?php

namespace WpThemeBones\Blocks\DemoPage;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\FrontBlocksFramework\MODEL;
use WpThemeBones\Blocks\DemoBlock\DemoBlock;
use WpThemeBones\Blocks\DemoBlock\Type\Arrow\DemoBlock_Type_Arrow;

class DemoPage extends MODEL {

	protected DemoBlock_Type_Arrow $_demoBlockTypeArrow;
	protected DemoBlock $_demoBlockTypeCircle;

	public function __construct() {

		parent::__construct();

		$this->_demoBlockTypeArrow  = new DemoBlock_Type_Arrow();
		$this->_demoBlockTypeCircle = new DemoBlock();

	}

	public function loadByDemo(): void {

		parent::_load();
		$this->_demoBlockTypeArrow->loadArrowTypeByDemo();
		$this->_demoBlockTypeCircle->loadByDemo();

	}

}
