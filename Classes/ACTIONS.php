<?php

declare( strict_types=1 );

namespace WpThemeBones\Classes;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Classes\Acf\Main\OPTIONS;

abstract class ACTIONS {

	//////// static methods

	public static function SetHooks() {

		//// functional groups

		add_action( 'after_setup_theme', [ THEME::class, 'SetupSupports', ] );
		add_action( 'wp_mail_failed', [ THEME::class, 'OnMailFail', ] );
		add_filter( 'mod_rewrite_rules', [ THEME::class, 'HtaccessContent' ] );

		add_action( 'after_switch_theme', [ THUMBNAILS::class, 'SetupDefaults', ] );
		add_filter( 'intermediate_image_sizes', [ THUMBNAILS::class, 'FilterImageSizes', ] );
		add_filter( 'big_image_size_threshold', [ THUMBNAILS::class, 'ImageSizeThreshold', ], 10, 4 );

		add_action( 'login_enqueue_scripts', [ LOGIN_FORM::class, 'OnResources', ] );
		add_action( 'login_form', [ LOGIN_FORM::class, 'OnFields', ] );
		add_filter( 'wp_authenticate_user', [ LOGIN_FORM::class, 'FilterVerify', ], 10, 3 );

		//// actions

		add_action( 'acf/init', [ OPTIONS::class, 'Setup', ] );

		//// filters

		//// blocks (scripts, styles, ajax)

		CONTROLLER::InitAll();

	}

}