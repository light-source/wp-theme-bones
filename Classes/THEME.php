<?php

declare( strict_types=1 );

namespace WpThemeBones\Classes;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\Log\LOG;
use WP_Error;

abstract class THEME {

	//////// constants

	const NAME = 'WpThemeBones';
	const _NAME = 'wp-theme-bones';
	const FOLDER__BLOCKS = '/Blocks';
	const FOLDER__ASSETS_PAGES = '/assets/pages';

	//////// static methods

	public static function GetUrl( string $target, string $folder = '' ): string {

		$url = get_stylesheet_directory_uri() . '/';
		$url .= $folder ?
			$folder . '/' :
			'';
		$url .= $target;

		return $url;
	}

	/**
	 * @return void
	 */
	public static function SetupSupports() {

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'menus' );

	}

	/**
	 * @param WP_Error $wpError
	 *
	 * @return void
	 */
	public static function OnMailFail( $wpError ) {

		$logMessage   = 'Fail send a mail';
		$logDebugArgs = [
			'$wpError' => $wpError,
		];
		LOG::Write( LOG::WARNING, $logMessage, $logDebugArgs );

	}

}
