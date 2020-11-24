<?php

namespace WpThemeBones\Blocks\Start;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Vendors\LightSource\BemBlocks\MODEL;

/**
 * Class Start
 * @package WpThemeBones\Blocks\Start
 */
class Start extends MODEL {


	//////// fields


	/**
	 * @var string
	 */
	protected $_title;
	/**
	 * @var string
	 */
	protected $_text;


	//////// constructor


	/**
	 * Start constructor.
	 */
	public function __construct() {
		parent::__construct();
	}


	//////// methods


	/**
	 * @return void
	 */
	final public function loadByTest() {

		$this->_title = 'Just another new block';
		$this->_text  = 'Description';

	}

}