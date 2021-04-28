<?php

namespace WpThemeBones\Blocks\DemoBlock\Type\Arrow;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\DemoBlock\DemoBlock;
use WpThemeBones\Blocks\DemoBlock\DemoBlock_C;
use WpThemeBones\Classes\CONTROLLER;
use WpThemeBones\Classes\Fbf;

final class DemoBlock_Type_Arrow extends DemoBlock {

	protected string $_footer;
	protected string $_parent;

	public function __construct() {

		parent::__construct();

		$this->_parent = CONTROLLER::GetPathToTwigTemplate( Fbf::Instance()->getSettings(), DemoBlock_C::class );

	}

	public function loadArrowTypeByDemo(): void {

		$this->loadByDemo();
		$this->_footer = '[This is a footer]';

	}

}
