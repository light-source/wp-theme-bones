<?php

namespace WpThemeBones\Blocks\DemoBlock\Type\Arrow;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\DemoBlock\DemoBlock;

final class DemoBlock_Type_Arrow extends DemoBlock {

	//////// fields

	protected string $_footer;

	//////// constructor

	public function __construct() {
		parent::__construct();
	}

	//////// methods

	public function loadArrowTypeByDemo():void {

		$this->loadByDemo();
		$this->_footer = '[This is a footer]';

	}

}
