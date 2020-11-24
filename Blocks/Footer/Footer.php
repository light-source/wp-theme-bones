<?php

namespace WpThemeBones\Blocks\Footer;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Vendors\LightSource\BemBlocks\MODEL;

/**
 * Class Header
 * @package WpThemeBones\Blocks\Header
 */
final class Footer extends MODEL {


	//////// fields


	/**
	 * @var string
	 */
	protected $_wpFooter;


	//////// construct


	/**
	 * Footer constructor.
	 */
	public function __construct() {
		parent::__construct();
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
