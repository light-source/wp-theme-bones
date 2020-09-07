<?php

namespace WpThemeBones\Blocks\Header;


defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\BemBlocks\MODEL;

/**
 * Class Header
 * @package WpThemeBones\Blocks\Header
 */
final class Header extends MODEL {


	//////// fields


	/**
	 * @var string
	 */
	private $_htmlAttrs;
	/**
	 * @var string
	 */
	private $_charset;
	/**
	 * @var string
	 */
	private $_wpHeader;
	/**
	 * @var string
	 */
	private $_bodyClasses;
	/**
	 * @var string
	 */
	private $_wpBodyOpen;


	//////// construct


	/**
	 * Header constructor.
	 */
	public function __construct() {

		$this->_htmlAttrs   = '';
		$this->_charset     = '';
		$this->_wpHeader    = '';
		$this->_bodyClasses = '';
		$this->_wpBodyOpen  = '';

	}


	//////// implementation abstract methods


	/**
	 * @return array
	 */
	public function getArgs() {
		return [
			'htmlAttrs'   => $this->_htmlAttrs,
			'charset'     => $this->_charset,
			'wpHeader'    => $this->_wpHeader,
			'bodyClasses' => $this->_bodyClasses,
			'wpBodyOpen'  => $this->_wpBodyOpen,
		];
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
