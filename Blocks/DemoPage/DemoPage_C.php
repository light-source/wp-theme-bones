<?php

namespace WpThemeBones\Blocks\DemoPage;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Classes\{
	CONTROLLER,
	THEME
};

final class DemoPage_C extends CONTROLLER {

	//////// construct

	public function __construct() {
		parent::__construct( new DemoPage() );
	}

	//////// static methods

	protected static function _IsHaveResources(): bool {
		return THEME::IsTemplate( THEME::TEMPLATE_DEMO_PAGE ) || is_home() || is_front_page();
	}


	//////// override extend methods

	/**
	 * @return DemoPage
	 */
	public function getModel() {
		return parent::getModel();
	}

}
