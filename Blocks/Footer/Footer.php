<?php

namespace WpThemeBones\Blocks\Footer;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\FrontBlocksFramework\MODEL;

class Footer extends MODEL {

	protected string $_wpFooter;

	public function __construct() {
		parent::__construct();
	}

	public function loadByDefault(): void {
		ob_start();
		wp_footer();
		$this->_wpFooter = ob_get_clean();
	}

}
