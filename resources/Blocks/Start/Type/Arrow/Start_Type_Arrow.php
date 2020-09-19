<?php

namespace WpThemeBones\Blocks\Start\Type\Arrow;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\Start\Start;

final class Start_Type_Arrow extends Start {


	//////// fields


	/**
	 * @var string
	 */
	protected $_footer;


	//////// constructor


	/**
	 * Start_Type_Arrow constructor.
	 */
	public function __construct() {
		parent::__construct();
	}


	//////// methods


	/**
	 * @return void
	 */
	public function loadArrowTypeByTest() {

		$this->loadByTest();
		$this->_footer = '[This is a footer]';

	}

}
