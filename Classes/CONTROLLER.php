<?php

declare( strict_types=1 );

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

	const _AJAX_PREFIX = THEME::_NAME . '_block__';

	//////// static fields

	private static array $_BlocksWithResources = [];
	private static array $_AllBlocks = [];

	//////// static methods

	protected static function _IsSupportAjax(): bool {
		return false;
	}

	protected static function _IsHaveResources(): bool {
		return false;
	}

	final protected static function _GetResourceName(): string {

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

	final public static function GetBlocksWithResources(): array {
		return self::$_BlocksWithResources;
	}

	final public static function GetAllBlocks(): array {
		return self::$_AllBlocks;
	}

	final public static function GetName(): string {

		// used static for child support
		$fullClassName = static::class;
		$nameParts     = explode( '\\', $fullClassName );

		if ( count( $nameParts ) > 1 ) {
			// remove global namespace
			$nameParts = array_slice( $nameParts, 1 );
		}

		return strtolower( implode( '_', $nameParts ) );
	}

	final public static function GetAjaxName(): string {
		// used static for child support
		return self::_AJAX_PREFIX . static::GetName();
	}

	//// can be overridden, but require call parent::_method()

	public static function Resources(): void {

		// below used static for child support

		$resourceName = static::_GetResourceName();

		wp_enqueue_style( static::GetName(), THEME::GetUrl( "{$resourceName}/{$resourceName}.min.css", THEME::FOLDER__ASSETS_PAGES ), [], null );
		wp_enqueue_script( static::GetName(), THEME::GetUrl( "{$resourceName}/{$resourceName}.min.js", THEME::FOLDER__ASSETS_PAGES ), [ 'jquery', ], null );

	}

	public static function AjaxCallback(): void {

	}

	//////// override extends methods

	final protected static function _Init(): void {

		// using static for child support
		self::$_AllBlocks[] = static::class;

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
