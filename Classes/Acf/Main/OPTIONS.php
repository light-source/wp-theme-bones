<?php

declare(strict_types=1);

namespace WpThemeBones\Classes\Acf\Main;

defined( 'ABSPATH' ) ||
die( 'Constant is missing' );

abstract class OPTIONS {

	//////// static methods

	public static function Setup(): void {

		if ( ! function_exists( 'acf_add_options_page' ) ) {
			return;
		}

		acf_add_options_page( [
			'page_title' => 'Site Settings',
			'menu_title' => 'Site Settings',
			'menu_slug'  => 'site-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
		] );

	}

}
