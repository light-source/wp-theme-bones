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

		$addingContent .= "\n# End " . self::NAME . "\n\n";

		$rules = $addingContent . $rules;

		return $rules;
	}

}
