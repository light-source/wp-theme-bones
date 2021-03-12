<?php

declare(strict_types=1);

namespace WpThemeBones\Classes;

defined( 'ABSPATH' ) ||
die( 'Constant is missing' );

use LightSource\BemBlocks\Settings as BemBlocksSettings;

/**
 * Class CONTROLLER
 * @package WpThemeBones\Classes
 */
abstract class CONTROLLER extends \LightSource\BemBlocks\CONTROLLER {


	//////// constants


	const _AJAX_PREFIX = Theme::_NAME . '_block__';


	//////// static fields


	/**
	 * @var array
	 */
	private static $_BlocksWithResources = [];


	//////// static methods


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
	 * @return string
	 */
	final protected static function _GetResourceName() {

		// used static for child support

		$fullClassName = static::class;
		$nameParts     = explode( '\\', $fullClassName );

		// get the last part without suffix

		$resourceName = rtrim( $nameParts[ count( $nameParts ) - 1 ], BemBlocksSettings::Instance()->getControllerSuffix() );

		// convert camel case info hyphen (-)

		$resourceName = preg_split( '/(?=[A-Z])/', $resourceName, - 1, PREG_SPLIT_NO_EMPTY );
		$resourceName = implode( '-', $resourceName );

		return strtolower( $resourceName );
	}

	/**
	 * @return array
	 */
	final public static function GetBlocksWithResources() {
		return self::$_BlocksWithResources;
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
		return self::_AJAX_PREFIX . static::GetName();
	}

	//// can be overridden, but require call parent::_method()

	/**
	 * @return void
	 */
	public static function Resources() {

		// below used static for child support

		$resourceName = static::_GetResourceName();

		wp_enqueue_style( static::GetName(), Theme::DistPagesUrl( "{$resourceName}/{$resourceName}.min.css" ), [], null );
		wp_enqueue_script( static::GetName(), Theme::DistPagesUrl( "{$resourceName}/{$resourceName}.min.js" ), [ 'jquery', ], null );

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

			$ajaxName = static::GetAjaxName();
			add_action( "wp_ajax_" . $ajaxName, [ static::class, 'AjaxCallback', ] );
			add_action( "wp_ajax_nopriv_" . $ajaxName, [
				static::class,
				'AjaxCallback',
			] );

		}

		//  using a 'wp' hook, because Conditional Tags (is_page, etc..) don't available before

		add_action( 'wp', function () {

			// below static for child support

			if ( ! static::_IsHaveResources() ) {
				return;
			}

			self::$_BlocksWithResources[] = static::class;

			add_action( 'wp_enqueue_scripts', [ static::class, 'Resources' ] );

		} );

	}

}
