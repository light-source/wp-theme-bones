<?php

declare( strict_types=1 );

namespace WpThemeBones\Classes;

defined( 'ABSPATH' ) ||
die( 'Constant is missing' );

abstract class Page {

	final public static function isContainsBlocks(): bool {
		return ! is_admin();
	}

	final public static function onGetHeader() {

		if ( ! self::isContainsBlocks() ) {
			return;
		}

		ob_start();

	}

	final public static function onWpFooter(): void {

		// disable default wp blocks styles
		// (because it can break something, like p:empty:content='' breaks icon-downarrow)
		wp_dequeue_style( 'wp-block-library' );

		if ( ! self::isContainsBlocks() ) {
			return;
		}

		$pageContent = ob_get_clean();
		$js          = Fb::Instance()->getRenderer()->getUsedResources( '.min.js', true );
		$css         = Fb::Instance()->getRenderer()->getUsedResources( '.min.css', true );

		// insert into the head to increase a render time,
		// you can save into a separate file and include it instead of pasting into a page content

		$pageContent = str_replace( '<!--blocks_css-->', "<style>{$css}</style>", $pageContent );
		echo $pageContent;
		echo "\n<script>{$js}</script>\n";

	}
}
