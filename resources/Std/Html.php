<?php

namespace WpThemeBones\Std;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use LightSource\Log\BASE;

use LightSource\Log\LOG;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

use Exception;

/**
 * Class Html
 *
 * Singleton class
 *
 * @package Angama\Std
 */
final class Html extends BASE {


	//////// constants


	const FILE_EXTENSION = '.twig';
	const RELATIVE_PATH_TO_HTML = '/../Blocks';


	//////// static fields


	/**
	 * @var self|null
	 */
	private static $_Instance = null;


	//////// fields


	/**
	 * @var FilesystemLoader
	 */
	private $_twigLoader;
	/**
	 * @var Environment
	 */
	private $_twigEnvironment;


	//////// construct


	/**
	 * Html constructor.
	 */
	private function __construct() {

		$this->_twig();

	}

	/**
	 * @return self
	 */
	public static function Instance() {
		if ( is_null( self::$_Instance ) ) {
			self::$_Instance = new self();
		}

		return self::$_Instance;
	}


	//////// static


	/**
	 * @param array $args
	 *
	 * @return array
	 */
	private static function _GeneralArgs( $args ) {

		$generalArgs = [
		];

		return array_merge( $generalArgs, $args );
	}


	//////// methods


	/**
	 * @return void
	 */
	private function _twig() {

		try {

			$this->_twigLoader = new FilesystemLoader( __DIR__ . self::RELATIVE_PATH_TO_HTML );

			$this->_twigEnvironment = new Environment( $this->_twigLoader, [
				// generate exception if var does not exists without replace to NULL
				'strict_variables' => true,
				// disable autoescape to prevent broken data
				'autoescape'       => false,
			] );
		} catch ( Exception $ex ) {

			$this->_twigLoader      = null;
			$this->_twigEnvironment = null;

		}

	}

	/**
	 * @param string $template Relative path (relative to the Blocks folder) to a file
	 * @param array $args [ key => value ] Args for template
	 * @param bool $isPrint
	 *
	 * @return string Rendered html
	 */
	public function render( $template, $args = [], $isPrint = false ) {

		$html = '';

		// twig didn't loaded

		if ( is_null( $this->_twigEnvironment ) ) {
			return $html;
		}

		$args = self::_GeneralArgs( $args );

		try {
			// generate exception if template does not exists OR broken
			// also if var does not exists (because used 'strict_variables' flag, see Twig_Environment->__construct)
			$html .= $this->_twigEnvironment->render( $template, $args );
		} catch ( Exception $ex ) {

			$html = '';

			$logMessage   = 'Template is wrong';
			$logDebugArgs = [
				'$template' => $template,
				'error'     => $ex->getMessage(),
				'file'      => $ex->getFile(),
				'line'      => $ex->getLine(),
				'args'      => $args,
			];
			$this->_log( LOG::BROKEN, $logMessage, $logDebugArgs );

		}

		if ( $isPrint ) {
			echo $html;
		}

		return $html;

	}

}
