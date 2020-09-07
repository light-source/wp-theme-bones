<?php

namespace WpThemeBones\Blocks\Test;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\BemBlocks\MODEL;
use WpThemeBones\Blocks\Start\Type\Arrow\Start_Type_Arrow;

/**
 * Class Test
 * @package WpThemeBones\Blocks\Test
 */
final class Test extends MODEL {


	//////// fields


	/**
	 * @var Start_Type_Arrow
	 */
	private $_startTypeArrow;


	//////// construct


	/**
	 * Test constructor.
	 */
	public function __construct() {

		$this->_startTypeArrow = new Start_Type_Arrow();

	}


	//////// implementation abstract methods


	/**
	 * @return array
	 */
	public function getArgs() {
		return [
			'startTypeArrow' => $this->_startTypeArrow->getArgs(),
		];
	}


	//////// methods


	/**
	 * @return void
	 */
	public function loadByTest() {
		$this->_startTypeArrow->loadArrowTypeByTest();
	}

}
