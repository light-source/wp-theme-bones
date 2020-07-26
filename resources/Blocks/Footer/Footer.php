<?php

namespace WpThemeBones\Blocks\Footer;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\BLOCK;

/**
 * Class Header
 * @package WpThemeBones\Blocks\Header
 */
final class Footer extends BLOCK {


	//////// override extends methods


	/**
	 * @return array
	 */
	public function getTemplateArgs() {

		ob_start();
		wp_footer();
		$wpFooter = ob_get_clean();

		return [
			'wpFooter' => $wpFooter,
		];
	}

}
