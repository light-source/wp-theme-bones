<?php

namespace WpThemeBones\Std;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

/**
 * Class HELPER
 * @package Angama\Std
 */
abstract class HELPER {


	//////// static methods

	/**
	 * Work as std, but added special to remind about default save keys,
	 * it's can broken some code if wait work with first-[0] element
	 *
	 * @param array $array
	 * @param callable $callback
	 * @param bool $isSaveKeys
	 *
	 * @return array
	 */
	final public static function ArrayFilter( $array, $callback, $isSaveKeys ) {

		$arrayResult = array_filter( $array, $callback );

		return $isSaveKeys ?
			$arrayResult :
			array_values( $arrayResult );
	}

}

