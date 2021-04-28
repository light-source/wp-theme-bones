<?php

namespace WpThemeBones\Blocks\DemoPage;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\FrontBlocksFramework\MODEL;
use WpThemeBones\Blocks\DemoBlock\Type\Arrow\DemoBlock_Type_Arrow_C;
use WpThemeBones\Classes\{
	CONTROLLER,
	TEMPLATE
};

class DemoPage_C extends CONTROLLER {

	protected DemoBlock_Type_Arrow_C $_demoBlockTypeArrow;

	public function __construct( ?MODEL $model = null ) {

		parent::__construct( $model );

		$this->_demoBlockTypeArrow = new DemoBlock_Type_Arrow_C();

	}

	protected static function _IsHaveResources(): bool {
		return ( TEMPLATE::IsTemplate( TEMPLATE::DEMO_PAGE ) ||
		         is_home() ||
		         is_front_page() );
	}

}
