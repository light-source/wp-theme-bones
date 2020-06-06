<?php

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use Exception;
use DateTime;

/**
 * Class Theme
 * @package WpThemeBones
 */
final class Theme {


	//////// constants


	const FOLDER_ASSETS = 'assets';
	const FOLDER_RESOURCES = 'resources';

	const TEMPLATE_TEST = 'templates/test.php';


	//////// static fields


	/**
	 * @var self|null
	 */
	private static $_Instance = null;


	//////// constructor


	/**
	 * @return self
	 */
	public static function Instance() {
		if ( is_null( self::$_Instance ) ) {
			self::$_Instance = new self();
		}

		return self::$_Instance;
	}

	//////// static methods


	/**
	 * Return url base on relative $sourcePath
	 *
	 * @param string $sourcePath
	 * @param bool $isPreventCache
	 * @param bool $isAbs If false return url without domain
	 *
	 * @return string
	 */
	public static function Url( $sourcePath, $isPreventCache, $isAbs = true ) {

		$urlParts = [];

		array_push( $urlParts, get_stylesheet_directory_uri(), self::FOLDER_ASSETS );

		if ( $isPreventCache ) {

			$timestamp = 0;

			try {
				$dateTime  = new DateTime();
				$timestamp = $dateTime->getTimestamp();
			} catch ( Exception $ex ) {

			}

			$sourcePath .= '?r=' . $timestamp;

		}

		$urlParts[] = $sourcePath;

		$absUrl = implode( DIRECTORY_SEPARATOR, $urlParts );

		return $isAbs ?
			$absUrl :
			wp_make_link_relative( $absUrl );
	}


	//////// methods


	/**
	 * @param string $rules
	 *
	 * @return string
	 */
	public function htaccessContent( $rules ) {

		$name              = __NAMESPACE__;
		$additionalContent = "\n# BEGIN {$name}";

		//// 1. disable directory browsing

		$additionalContent .= "\nOptions -Indexes";

		//// 2. lock non-public files

		$additionalContent .= "\n<FilesMatch '\.(ftpaccess|htaccess|lock|twig|scss)$'>";
		$additionalContent .= "\nOrder allow,deny";
		$additionalContent .= "\nDeny from all";
		$additionalContent .= "\n</FilesMatch>";

		$additionalContent .= "\n<FilesMatch 'log.html|readme.txt|composer.json|package.json'>";
		$additionalContent .= "\nOrder allow,deny";
		$additionalContent .= "\nDeny from all";
		$additionalContent .= "\n</FilesMatch>";

		//// 3. protect files - theme resources (remove first slash to get correct path)

		$pathToThemeResources = ltrim( wp_make_link_relative( get_stylesheet_directory_uri() . '/' . self::FOLDER_RESOURCES ), '/' );
		$additionalContent    .= "\nRewriteRule ^{$pathToThemeResources}/(.*)$ - [F,L]";

		$additionalContent .= "\n# End {$name}\n\n";

		return $additionalContent . "\n" . $rules;
	}

	/**
	 * @return void
	 */
	public function stylesAndScripts() {


		if ( is_singular( [ 'page', ] ) &&
		     self::TEMPLATE_TEST === get_page_template_slug( get_queried_object_id() ) ) {

			wp_enqueue_style( 'home-css', self::Url( 'pages/home/home.min.css', false ) );
			wp_enqueue_script( 'home-js', self::Url( 'pages/home/home.min.js', false ) );

		}

	}

}
