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
	private $_footer;


	//////// constructor


	/**
	 * Start_Type_Arrow constructor.
	 */
	public function __construct() {

		parent::__construct();

		$this->_footer = '';

	}


	//////// override extends methods


	/**
	 * @return array
	 */
	public function getTemplateArgs() {

		$args = [
			'footer' => $this->_footer,
		];

		return array_merge( parent::getTemplateArgs(), $args );
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
