<?php

declare( strict_types=1 );

namespace WpThemeBones\Classes;

defined( 'ABSPATH' ) ||
die( 'Constant is missing' );

abstract class CONTROLLER extends \LightSource\FrontBlocksFramework\CONTROLLER {

	const _AJAX_PREFIX = THEME::_NAME . '_block__';

	private static array $_BlocksWithResources = [];

	protected static function _IsSupportAjax(): bool {
		return false;
	}

	protected static function _IsHaveResources(): bool {
		return false;
	}

	final public static function GetBlocksWithResources(): array {
		return self::$_BlocksWithResources;
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

	public static function Resources(): void {

		// below used static for child support

		$resourceRelativePath = parent::GetResourceInfo( Fbf::Instance()->getSettings(), static::class )['relativeResourcePath'];

		wp_enqueue_style( static::GetName(), THEME::GetUrl( "{$resourceRelativePath}.min.css", THEME::FOLDER__BLOCKS ), [], null );
		wp_enqueue_script( static::GetName(), THEME::GetUrl( "{$resourceRelativePath}.min.js", THEME::FOLDER__BLOCKS ), [ 'jquery', ], null );

	}

	public static function AjaxCallback(): void {

	}

	public static function OnLoad(): void {

		parent::OnLoad();

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
