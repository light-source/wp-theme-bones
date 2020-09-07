<?php

namespace WpThemeBones\Blocks\Test;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\BemBlocks\MODEL;
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
	private $_startTypeArrowC;


	//////// construct


	/**
	 * Test constructor.
	 */
	public function __construct() {

		$this->_startTypeArrowC = new Start_Type_Arrow_C();

	}


	//////// implementation abstract methods


	/**
	 * @return array
	 */
	public function getArgs() {
		return [
			'startTypeArrow' => $this->_startTypeArrowC->getTemplateArgs(),
		];
	}


	//////// methods


	/**
	 * @return void
	 */
	public function loadByTest() {
		$this->_startTypeArrowC->getModel()->loadArrowTypeByTest();
	}

}
