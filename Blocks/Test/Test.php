<?php

namespace WpThemeBones\Blocks\Test;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Vendors\LightSource\BemBlocks\MODEL;
use WpThemeBones\Blocks\Start\Type\Arrow\Start_Type_Arrow_C;

/**
 * Class Test
 * @package WpThemeBones\Blocks\Test
 */
final class Test extends MODEL {


	//////// fields


	/**
	 * @var Start_Type_Arrow_C
	 */
	protected $_startTypeArrow;


	//////// construct


	/**
	 * Test constructor.
	 */
	public function __construct() {

		parent::__construct();

		$this->_startTypeArrow = new Start_Type_Arrow_C();

	}


	//////// methods


	/**
	 * @return void
	 */
	public function loadByTest() {
		$this->_startTypeArrow->getModel()->loadArrowTypeByTest();
	}

}
