<?php

namespace WpThemeBones\Classes;

defined( 'ABSPATH' ) ||
die( 'Constant is missing' );

/**
 * Class THUMBNAILS
 * @package WpThemeBones\Classes
 */
abstract class THUMBNAILS {


	//////// constants


	const THUMBNAIL = 'thumbnail'; // 500
	const MEDIUM = 'medium';  // 768
	const LARGE = 'large';  // 1920
	const FULL = 'full';


	//////// static methods


	/**
	 * @param array $sizes
	 *
	 * @return array
	 */
	public static function FilterImageSizes( $sizes ) {
		return array_diff( $sizes, [
			'1536x1536',
			'2048x2048',
			'medium_large',
		] );
	}


	/**
	 * @return void
	 */
	public static function SetupDefaults() {

		// default wp sizes don't optimal (e.g. thumbnail is too small) and redundant (e.g. medium_large)

		update_option( 'thumbnail_size_w', 500 );
		update_option( 'thumbnail_size_h', 0 );

		update_option( 'medium_size_w', 768 );
		update_option( 'medium_size_h', 0 );

		update_option( 'medium_large_size_w', 0 );
		update_option( 'medium_large_size_h', 0 );

		update_option( 'large_size_w', 1920 );
		update_option( 'large_size_h', 0 );

	}

	/**
	 * @param int $threshold
	 * @param array $imageSizes
	 * @param string $file
	 * @param int $attachmentId
	 *
	 * @return false
	 */
	public static function ImageSizeThreshold( $threshold, $imageSizes, $file, $attachmentId ) {

		$threshold = false; // don't need

		return $threshold;
	}

}
