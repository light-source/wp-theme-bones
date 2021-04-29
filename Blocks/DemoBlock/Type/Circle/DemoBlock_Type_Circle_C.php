<?php

namespace WpThemeBones\Blocks\DemoBlock\Type\Circle;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\FrontBlocksFramework\Settings;
use WpThemeBones\Blocks\DemoBlock\DemoBlock;
use WpThemeBones\Blocks\DemoBlock\DemoBlock_C;

class DemoBlock_Type_Circle_C extends DemoBlock_C {

	public static function GetPathToTwigTemplate( Settings $settings, string $controllerClass ): string {
		return parent::GetPathToTwigTemplate( $settings, parent::class );
	}

	public static function GetModelClass(): string {
		return DemoBlock::class;
	}

}
