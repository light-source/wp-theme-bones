<?php

namespace WpThemeBones\Blocks\Header;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\FrontBlocksFramework\MODEL;

class Header extends MODEL {

	protected string $_htmlAttrs;
	protected string $_charset;
	protected string $_wpHeader;
	protected array $_bodyClasses;
	protected string $_wpBodyOpen;

	public function __construct() {
		parent::__construct();
	}

	public function loadByDefault() {

		parent::_load();
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
