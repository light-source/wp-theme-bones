<?php

namespace WpThemeBones\Blocks\Start;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\BLOCK;

/**
 * Class Start
 * @package WpThemeBones\Blocks\Start
 */
class Start extends BLOCK {


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

		$this->_title = '';
		$this->_text  = '';

	}


	//////// override extends methods


	/**
	 * @return array
	 */
	public function getTemplateArgs() {

		return [
			'title' => $this->_title,
			'text'  => $this->_text,
		];


	}


	//////// methods


	/**
	 * @return void
	 */
	final public function loadByTest() {

		$this->_title = 'Just another block';
		$this->_text  = 'Description';

	}

}