<?php

declare( strict_types=1 );

class SecurityCest {

	//////// constants

	const _THEME = '/wp-content/themes/angama';

	const HTACCESS = '.htaccess';
	const THEME_JSON = self::_THEME . '/vendors/composer.json';
	const THEME_LOCK = self::_THEME . '/vendors/composer.lock';
	const THEME_TWIG = self::_THEME . '/Blocks/Header/header.twig';
	const THEME_SCSS = self::_THEME . '/Blocks/Header/header.scss';
	const THEME_README = self::_THEME . '/readme.md';
	const THEME_BLOCKS = self::_THEME . '/Blocks/Header/Header.php';
	const THEME_MAILS = self::_THEME . '/assets/mail/signature.heml';
	const LOGIN_PAGE = '/wp-login.php';
	const THEME_VIEW_FOLDER = self::_THEME . '/vendors';

	const USER_LOGIN = 'maxim';

	//////// static methods

	private static function _ForbiddenUrl( string $url, AcceptanceTester $I ) {

		$I->amOnPage( $url );
		$I->seeResponseCodeIs( 403 );

	}

	//////// methods

	public function htaccessFileExtensions( AcceptanceTester $I ) {

		self::_ForbiddenUrl( self::HTACCESS, $I );
		self::_ForbiddenUrl( self::THEME_JSON, $I );
		self::_ForbiddenUrl( self::THEME_LOCK, $I );
		self::_ForbiddenUrl( self::THEME_TWIG, $I );
		self::_ForbiddenUrl( self::THEME_SCSS, $I );

	}

	public function htaccessFiles( AcceptanceTester $I ) {
		self::_ForbiddenUrl( self::THEME_README, $I );
	}

	public function htaccessFolders( AcceptanceTester $I ) {

		self::_ForbiddenUrl( self::THEME_BLOCKS, $I );
		self::_ForbiddenUrl( self::THEME_MAILS, $I );

	}

	public function htaccessFolderView( AcceptanceTester $I ) {
		self::_ForbiddenUrl( self::THEME_VIEW_FOLDER, $I );
	}

	public function loginCaptcha( AcceptanceTester $I ) {

		$I->amOnPage( self::LOGIN_PAGE );
		$I->fillField( '#user_login', self::USER_LOGIN );
		$I->fillField( '#user_pass', 'test' );
		$I->click( 'Log In', '#wp-submit' );

		$I->see( 'Security field is missing', '#login_error' );

	}

}
