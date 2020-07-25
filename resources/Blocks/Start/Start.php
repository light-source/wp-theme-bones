<?php

namespace WpThemeBones\Blocks\Start;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\BLOCK;

/**
 * Class Start
 * @package WpThemeBones\Blocks\Start
 */
final class Start extends BLOCK {


	//////// fields


	/**
	 * @var int
	 */
	private $_postId;


	//////// constructor


	/**
	 * Start constructor.
	 *
	 * @param int $postId
	 */
	public function __construct( $postId ) {
		$this->_postId = $postId;
	}


	//////// override extends methods


	/**
	 * @return array
	 */
	public function getTemplateArgs() {

		// for example get args deps on $this->_postId;

		return [
			'title' => 'Just another block',
			'text'  => 'Description',
		];
	}

}