<?php

namespace WpThemeBones\Blocks\Header;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Vendors\LightSource\BemBlocks\MODEL;

/**
 * Class Header
 * @package WpThemeBones\Blocks\Header
 */
final class Header extends MODEL {


	//////// fields


	/**
	 * @var string
	 */
	protected $_htmlAttrs;
	/**
	 * @var string
	 */
	protected $_charset;
	/**
	 * @var string
	 */
	protected $_wpHeader;
	/**
	 * @var string
	 */
	protected $_bodyClasses;
	/**
	 * @var string
	 */
	protected $_wpBodyOpen;


	//////// construct


	/**
	 * Header constructor.
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
		wp_head();
		$this->_wpHeader = ob_get_clean();

		ob_start();
		wp_body_open();
		$this->_wpBodyOpen = ob_get_clean();

		$this->_htmlAttrs   = get_language_attributes();
		$this->_charset     = get_bloginfo( 'charset' );
		$this->_bodyClasses = get_body_class();

	}

}
