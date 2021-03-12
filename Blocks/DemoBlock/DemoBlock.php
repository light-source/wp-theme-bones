<?php

namespace WpThemeBones\Blocks\DemoBlock;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\BemBlocks\MODEL;

class DemoBlock extends MODEL {

	//////// fields

	protected string $_title;
	protected string $_text;

	//////// constructor

	public function __construct() {
		parent::__construct();
	}

	//////// methods

	final public function loadByDemo():void {

		$this->_title = 'Just another new block';
		$this->_text  = 'Description';

	}

}