<?php

namespace WpThemeBones\Std;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

/**
 * Class ACTIONS
 * @package Angama\Std
 */
abstract class ACTIONS {

	/**
	 * @return void
	 */
	public static function SetHooks() {

		//// actions

		add_action( 'after_setup_theme', [ THEME::class, 'SetupSupports', ] );
		add_action( 'after_switch_theme', [ THUMBNAILS::class, 'SetupDefaults', ] );

		//// filters

		add_filter( 'mod_rewrite_rules', [ THEME::class, 'HtaccessContent' ] );
		add_filter( 'intermediate_image_sizes', [ THUMBNAILS::class, 'FilterImageSizes', ] );

		//// blocks (scripts, styles, ajax)

		CONTROLLER::InitAll();

	}

}
