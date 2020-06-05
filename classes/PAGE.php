<?php

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\Log\BASE;

/**
 * Class PAGE
 * @package WpThemeBones
 */
abstract class PAGE extends BASE {


	//////// construct


	/**
	 * PAGE constructor.
	 */
	public function __construct() {

	}


	//////// abstract methods


	/**
	 * @return string
	 */
	public abstract function render();

}