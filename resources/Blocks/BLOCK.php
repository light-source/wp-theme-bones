<?php

namespace WpThemeBones\Blocks;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\Log\BASE;
use LightSource\Log\LOG;

use WpThemeBones\Std\HELPER;
use WpThemeBones\Std\Html;
use WpThemeBones\Std\THEME;

/**
 * Class BLOCK
 * @package Angama\Blocks
 */
abstract class BLOCK extends BASE {


	//////// constants


	const AJAX_PREFIX = THEME::_NAME . '_block_';


	//////// static fields


	/**
	 * @var array
	 */
	private static $_Classes = [];


	//////// static methods


	/**
	 * @param string $directory
	 * @param string $namespace
	 *
	 * @return void
	 */
	final private static function _LoadDirectory( $directory, $namespace ) {

		// exclude ., ..
		$fs = array_diff( scandir( $directory ), [ '.', '..' ] );

		$phpFileNames = HELPER::ArrayFilter( $fs, function ( $f ) {
			return ( false !== strpos( $f, '.php' ) &&
			         'index.php' !== $f );
		}, false );

		$subDirectoryNames = HELPER::ArrayFilter( $fs, function ( $f ) {
			return false === strpos( $f, '.' );
		}, false );

		foreach ( $phpFileNames as $phpFileName ) {

			$phpFile      = implode( DIRECTORY_SEPARATOR, [ $directory, $phpFileName ] );
			$phpClass     = implode( '\\', [ $namespace, str_replace( '.php', '', $phpFileName ), ] );
			$logDebugArgs = [
				'directory' => $directory,
				'namespace' => $namespace,
				'phpFile'   => $phpFile,
				'phpClass'  => $phpClass,
			];

			require_once $phpFile;

			if ( ! class_exists( $phpClass, false ) ) {

				$logMsg = 'Class file does not correct';
				self::_SLog( LOG::BROKEN, $logMsg, $logDebugArgs );

				continue;
			}

			if ( ! is_subclass_of( $phpClass, self::class ) ) {
				$logMsg = 'Form class does not child';
				self::_SLog( LOG::BROKEN, $logMsg, $logDebugArgs );
				continue;
			}

			self::$_Classes[] = $phpClass;

		}

		foreach ( $subDirectoryNames as $subDirectoryName ) {

			$subDirectory = implode( DIRECTORY_SEPARATOR, [ $directory, $subDirectoryName ] );
			$subNamespace = implode( '\\', [ $namespace, $subDirectoryName ] );

			self::_LoadDirectory( $subDirectory, $subNamespace );

		}


	}

	/**
	 * @return void
	 */
	final private static function _LoadAll() {

		$directory = __DIR__;
		$namespace = __NAMESPACE__;

		// exclude ., ..
		$fs = array_diff( scandir( $directory ), [ '.', '..', ] );

		$subDirectoryNames = HELPER::ArrayFilter( $fs, function ( $f ) {
			return false === strpos( $f, '.' );
		}, false );

		foreach ( $subDirectoryNames as $subDirectoryName ) {

			$subDirectory = implode( DIRECTORY_SEPARATOR, [ $directory, $subDirectoryName ] );
			$subNamespace = implode( '\\', [ $namespace, $subDirectoryName ] );

			self::_LoadDirectory( $subDirectory, $subNamespace );

		}

	}

	/**
	 * @return void
	 */
	final public static function Init() {

		self::_LoadAll();

		foreach ( self::$_Classes as $blockClass ) {

			$isSupportAjax   = call_user_func( [ $blockClass, '_IsSupportAjax' ] );
			$isHaveResources = call_user_func( [ $blockClass, '_IsHaveResources' ] );

			if ( $isSupportAjax ) {

				$currentBlockName = call_user_func( [ $blockClass, 'GetName' ] );
				add_action( "wp_ajax_" . self::AJAX_PREFIX . $currentBlockName, [ $blockClass, 'AjaxCallback', ] );
				add_action( "wp_ajax_nopriv_" . self::AJAX_PREFIX . $currentBlockName, [
					$blockClass,
					'AjaxCallback',
				] );

			}

			if ( $isHaveResources ) {
				add_action( 'wp_enqueue_scripts', [ $blockClass, 'Resources', ] );
			}

		}

	}

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
	 * @return string
	 */
	final protected static function _GetAjaxName() {
		// used static for child support
		return self::AJAX_PREFIX . static::GetName();
	}

	/**
	 * @return string For example - convert 'BlogItem' into 'blog-item'
	 */
	final protected static function _GetTwigName() {

		// used static for child support
		$fullClassName = static::class;
		$shortName     = explode( '\\', $fullClassName );
		$shortName     = $shortName[ count( $shortName ) - 1 ];
		$nameParts     = preg_split( '/(?=[A-Z])/', $shortName, - 1, PREG_SPLIT_NO_EMPTY );
		$newNameParts  = [];

		foreach ( $nameParts as $namePart ) {
			$newNameParts[] = strtolower( $namePart );
		}

		return implode( '-', $newNameParts );
	}

	/**
	 * @return string Unique form name base on static::class (without first namespace part)
	 */
	final public static function GetName() {

		// used static for child support
		$fullClassName = static::class;
		$nameParts     = explode( '\\', $fullClassName );
		if ( count( $nameParts ) > 1 ) {
			// remove global namespace, as Angama
			$nameParts = array_slice( $nameParts, 1 );
		}

		return strtolower( implode( '_', $nameParts ) );
	}

	/**
	 * @return array
	 */
	public function getTemplateArgs() {
		return [];
	}


	//////// methods


	/**
	 * @param array $args
	 *
	 * @return string
	 */
	final public function render( $args = [] ) {

		$args = array_merge( $this->getTemplateArgs(), $args );

		return Html::Instance()->render( self::_GetTwigName(), $args );
	}

}
