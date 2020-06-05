<?php

namespace WpThemeBones\Pages;

use LightSource\Log\LOG;
use WpThemeBones\Html;
use WpThemeBones\PAGE;

/**
 * Class Home
 * @package WpThemeBones\Pages
 */
final class Home extends PAGE {


	//////// implementation abstract methods


	/**
	 * @return string
	 */
	public function render() {

		$this->_log( LOG::DEBUG, 'Test message', [
			'true' => 1,
		] );

		return Html::Instance()->render( 'home', [
			'text'   => 'Home',
			'bottom' => $this->_blockHomeStart(),
		] );

	}


	//////// methods


	/**
	 * @return string
	 */
	private function _blockHomeStart() {

		return Html::Instance()->render( 'start', [
			'text'  => 'Hello world!',
			'class' => 'home__start',
		] );

	}

}