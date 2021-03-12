<?php

declare( strict_types=1 );

class PagesCest {

	//////// constants

	const DEMO = '/demo-page/';

	//////// static methods

	private static function _VisitPage( string $page, AcceptanceTester $I ): void {

		$page .= '?donotcachepage=' . $I->getConfig( 'cacheArg' );

		$I->amOnPage( $page );
		$I->seeResponseCodeIs( 200 );

	}

	//////// methods

	public function demo( AcceptanceTester $I ): void {

		self::_VisitPage( self::DEMO, $I );

		// todo

	}

}
