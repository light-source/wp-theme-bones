<?php

namespace WpThemeBones\Std;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

/**
 * Class CONTROLLER
 * @package WpThemeBones\Std
 */
abstract class CONTROLLER extends \LightSource\BemBlocks\CONTROLLER {


	//////// constants


	const AJAX_PREFIX = THEME::_NAME . '_block_';


	//////// static methods


	//// can be overridden, but require call parent::_method()

	/**
	 * @return void
	 */
	public static function Resources() {


	}

	/**
	 * @return void
	 */
	public static function AjaxCallback() {

	}


	//////// override extends methods


	/**
	 * @return void
	 */
	final protected static function _Init() {

		// below used static for child support

		if ( static::_IsSupportAjax() ) {

			$currentBlockName = static::GetAjaxName();
			add_action( "wp_ajax_" . $currentBlockName, [ static::class, 'AjaxCallback', ] );
			add_action( "wp_ajax_nopriv_" . $currentBlockName, [
				static::class,
				'AjaxCallback',
			] );

		}

		if ( static::_IsHaveResources() ) {
			add_action( 'wp_enqueue_scripts', [ static::class, 'Resources', ] );
		}

	}


	//////// getters


	/**
	 * @return bool
	 */
	protected static function _IsSupportAjax() {
		return false;
	}

	/**
	 * @return bool
	 */
	protected static function _IsHaveResources() {
		return false;
	}

	/**
	 * @return string Unique form name base on static::class (without first namespace part)
	 */
	final public static function GetName() {

		// used static for child support
		$fullClassName = static::class;
		$nameParts     = explode( '\\', $fullClassName );
		if ( count( $nameParts ) > 1 ) {
			// remove global namespace
			$nameParts = array_slice( $nameParts, 1 );
		}

		return strtolower( implode( '_', $nameParts ) );
	}

	/**
	 * @return string
	 */
	final public static function GetAjaxName() {
		// used static for child support
		return self::AJAX_PREFIX . static::GetName();
	}

}
