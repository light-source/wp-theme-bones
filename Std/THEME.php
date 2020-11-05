<?php

namespace WpThemeBones\Std;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

/**
 * Class THEME
 * @package Angama\Std
 */
abstract class THEME {


	//////// constants


	const DIST_PAGES_FOLDER = '/assets/pages';
	const RESOURCES_FOLDER = 'resources';
	const NAME = 'WpThemeBones';
	const _NAME = 'wp_theme_bones';
	const TEMPLATE_TEST = 'templates/test.php';


	//////// static methods


	/**
	 * @param string $templateConst
	 *
	 * @return bool
	 */
	public static function IsTemplate( $templateConst ) {
		return ( is_singular( [ 'page', ] ) &&
		         $templateConst === get_page_template_slug( get_queried_object_id() ) );
	}

	/**
	 * @param string $target
	 *
	 * @return string
	 */
	public static function DistPagesUrl( $target ) {
		return get_stylesheet_directory_uri() . self::DIST_PAGES_FOLDER . '/' . $target;
	}

	/**
	 * Add htaccess rules
	 *
	 * @param string $rules
	 *
	 * @return string
	 */
	public static function HtaccessContent( $rules ) {

		// to correct work required enabled modules : rewrite, expires, headers

		$addingContent = "\n# BEGIN " . self::NAME;

		//// 1. disable directory browsing

		$addingContent .= "\nOptions -Indexes";

		//// 2. lock non-public files

		$addingContent .= "\n<FilesMatch '\.(ftpaccess|htaccess|conf|json|lock|twig|scss)$'>";
		$addingContent .= "\nOrder allow,deny";
		$addingContent .= "\nDeny from all";
		$addingContent .= "\n</FilesMatch>";

		$addingContent .= "\n<FilesMatch 'log.html|readme.txt'>";
		$addingContent .= "\nOrder allow,deny";
		$addingContent .= "\nDeny from all";
		$addingContent .= "\n</FilesMatch>";

		//// 3. protect theme resources

		$addingContent        .= "\n<IfModule mod_rewrite.c>";
		$addingContent        .= "\nRewriteEngine On";
		$pathToThemeResources = ltrim( wp_make_link_relative( get_stylesheet_directory_uri() . '/' . self::RESOURCES_FOLDER ), '/' );
		$addingContent        .= "\nRewriteRule ^{$pathToThemeResources}/(.*)$ - [F,L]";
		$addingContent        .= "\n</IfModule>";

		$addingContent .= "\n# End " . self::NAME . "\n\n";

		$rules = $addingContent . $rules;

		return $rules;
	}

	/**
	 * @return void
	 */
	public static function SetupSupports() {

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'menus' );

	}

}
