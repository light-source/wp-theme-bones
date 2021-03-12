<?php

declare(strict_types=1);

namespace WpThemeBones\Classes;

defined( 'ABSPATH' ) ||
die( 'Constant is missing' );

abstract class HELPER {

	//////// static methods

	final public static function GetCurrentHost(): string {
		return ( parse_url( site_url(), PHP_URL_HOST ) );
	}

	/**
	 * @param string $url
	 * @param bool $isPost
	 * @param array $fields
	 *
	 * @return string|false
	 */
	final public static function CUrl( string $url, bool $isPost, array $fields = [] ) {

		$response = false;

		$resource = curl_init();

		if ( false === $resource ) {
			return $response;
		}

		$options = [
			CURLOPT_URL            => $url,
			// return, not print result
			CURLOPT_RETURNTRANSFER => true,
		];

		if ( $isPost ) {

			$options[ CURLOPT_POST ]       = true;
			$options[ CURLOPT_POSTFIELDS ] = $fields;

		}

		curl_setopt_array( $resource, $options );

		// return  result or FALSE

		$response = curl_exec( $resource );

		curl_close( $resource );

		return $response;
	}

}
