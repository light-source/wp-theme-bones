<?php

declare( strict_types=1 );

class SecurityCest {

	//////// constants

	const _THEME = '/wp-content/themes/wp-theme-bones';

	const THEME__VIEW_FOLDER = self::_THEME . '/vendors';

	const EXT__HTACCESS = '.htaccess';

	const THEME__EXT__JSON = self::_THEME . '/vendors/composer.json';
	const THEME__EXT__LOCK = self::_THEME . '/vendors/composer.lock';
	const THEME__EXT__TWIG = self::_THEME . '/Blocks/Header/header.twig';
	const THEME__EXT__SCSS = self::_THEME . '/Blocks/Header/header.scss';
	const THEME__EXT__SH = self::_THEME . '/tools/tests.sh';

	const THEME__FILE__README = self::_THEME . '/readme.md';

	const LOGIN_PAGE = '/wp-login.php';
	const USER_LOGIN = 'maxim';

	//////// static methods

	private static function _ForbiddenUrl( string $url, AcceptanceTester $I ) {

		$I->amOnPage( $url );
		$I->seeResponseCodeIs( 403 );

	}

	//////// methods

	public function htaccessForbiddenDirectoryBrowsing( AcceptanceTester $I ) {
		self::_ForbiddenUrl( self::THEME__VIEW_FOLDER, $I );
	}

	public function htaccessForbiddenFileExtensions( AcceptanceTester $I ) {

		self::_ForbiddenUrl( self::EXT__HTACCESS, $I );
		self::_ForbiddenUrl( self::THEME__EXT__JSON, $I );
		self::_ForbiddenUrl( self::THEME__EXT__LOCK, $I );
		self::_ForbiddenUrl( self::THEME__EXT__TWIG, $I );
		self::_ForbiddenUrl( self::THEME__EXT__SCSS, $I );
		self::_ForbiddenUrl( self::THEME__EXT__SH, $I );


	}

	public function htaccessForbiddenFiles( AcceptanceTester $I ) {
		self::_ForbiddenUrl( self::THEME__FILE__README, $I );
	}

	public function loginCaptcha( AcceptanceTester $I ) {

		$I->amOnPage( self::LOGIN_PAGE );
		$I->fillField( '#user_login', self::USER_LOGIN );
		$I->fillField( '#user_pass', 'test' );
		$I->click( 'Log In', '#wp-submit' );

		$I->see( 'Security field is missing', '#login_error' );

	}

}
