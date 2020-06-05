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


	public function htaccess() {
		// fixme secure scss and twig
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
