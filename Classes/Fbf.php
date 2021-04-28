<?php

declare( strict_types=1 );

namespace WpThemeBones\Classes;

defined( 'ABSPATH' ) ||
die( 'Constant is missing' );

use LightSource\FrontBlocksFramework\Blocks;
use LightSource\FrontBlocksFramework\Settings;
use LightSource\Log\LOG;

final class Fbf {

	private static ?self $_Instance = null;

	private Settings $_settings;
	private Blocks $_blocks;

	private function __construct() {

		$this->_setupSettings();
		$this->_blocks = new Blocks( $this->_settings );

	}

	public static function Instance(): Fbf {

		if ( ! self::$_Instance ) {
			self::$_Instance = new self();
		}

		return self::$_Instance;

	}

	private function _setupSettings() {

		$this->_settings = new Settings();
		$this->_settings->setBlocksDirPath( __DIR__ . '/../Blocks' );
		$this->_settings->setBlocksDirNamespace( 'WpThemeBones\Blocks' );
		$this->_settings->setErrorCallback( function ( $errors ) {

			$logMessage   = 'Front blocks framework error';
			$logDebugArgs = [
				'$errors' => $errors,
			];
			LOG::Write( LOG::WARNING, $logMessage, $logDebugArgs );

		} );

	}

	private function __clone() {

	}

	public function getBlocks(): Blocks {
		return $this->_blocks;
	}

	public function getSettings(): Settings {
		return $this->_settings;
	}

}
