<?php

namespace WpThemeBones\Blocks\Footer;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\BemBlocks\MODEL;

/**
 * Class Header
 * @package WpThemeBones\Blocks\Header
 */
final class Footer extends MODEL {


	//////// fields


	/**
	 * @var string
	 */
	private $_wpFooter;


	//////// construct


	/**
	 * Footer constructor.
	 */
	public function __construct() {
		$this->_wpFooter = '';
	}


	//////// implementation abstract methods


	/**
	 * @return array
	 */
	public function getArgs() {
		return [
			'wpFooter' => $this->_wpFooter,
		];
	}


	//////// methods


	/**
	 * @return void
	 */
	public function loadByDefault() {
		ob_start();
		wp_footer();
		$this->_wpFooter = ob_get_clean();
	}

}
