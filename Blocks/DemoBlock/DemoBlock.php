<?php

namespace WpThemeBones\Blocks\DemoBlock;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\FrontBlocksFramework\MODEL;

class DemoBlock extends MODEL {

	protected string $_title;
	protected string $_text;
	protected array $_classes;

	public function __construct() {
		parent::__construct();
	}

	final public function loadByDemo(): void {

		parent::_load();
		$this->_title = 'Just demo block';
		$this->_text  = 'Description';

	}

}