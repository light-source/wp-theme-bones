<?php

namespace WpThemeBones\Std;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\CONTROLLER;

/**
 * Class ACTIONS
 * @package Angama\Std
 */
abstract class ACTIONS {

	/**
	 * @return void
	 */
	public static function SetHooks() {

		//// filters

		add_filter( 'mod_rewrite_rules', [ THEME::class, 'HtaccessContent' ] );

		//// blocks (scripts, styles, ajax)

		CONTROLLER::InitAll();

	}

}
