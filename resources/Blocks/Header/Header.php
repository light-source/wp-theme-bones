<?php

namespace WpThemeBones\Blocks\Header;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\BLOCK;

/**
 * Class Header
 * @package WpThemeBones\Blocks\Header
 */
final class Header extends BLOCK {


	//////// override extends methods


	/**
	 * @return array
	 */
	public function getTemplateArgs() {

		ob_start();
		wp_head();
		$wpHead = ob_get_clean();

		ob_start();
		wp_body_open();
		$wpBodyOpen = ob_get_clean();

		return [
			'htmlAttrs'   => get_language_attributes(),
			'charset'     => get_bloginfo( 'charset' ),
			'wpHeader'    => $wpHead,
			'bodyClasses' => get_body_class(),
			'wpBodyOpen'  => $wpBodyOpen,
		];
	}

}
