<?php

namespace WpThemeBones\Classes;

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
		add_action( 'wp_mail_failed', [ THEME::class, 'OnMailFail', ] );

		//// filters

		add_filter( 'mod_rewrite_rules', [ THEME::class, 'HtaccessContent' ] );
		add_filter( 'intermediate_image_sizes', [ THUMBNAILS::class, 'FilterImageSizes', ] );
		add_filter( 'big_image_size_threshold', [ THUMBNAILS::class, 'ImageSizeThreshold', ], 10, 4 );

		//// blocks (scripts, styles, ajax)

		CONTROLLER::InitAll();

	}

}
