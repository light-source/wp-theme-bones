<?php

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

/**
 * Class ACTIONS
 * @package WpThemeBones
 */
abstract class ACTIONS {

	/**
	 * @return void
	 */
	public static function SetHooks() {

		$themeInstance = Theme::Instance();

		add_action( 'wp_enqueue_scripts', [ $themeInstance, 'stylesAndScripts' ] );

	}

}