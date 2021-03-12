<?php

declare( strict_types=1 );

namespace WpThemeBones\Classes\Acf;

use WpThemeBones\Classes\Acf\Main\BASE_GROUP;

abstract class SITE_SETTINGS extends BASE_GROUP {

	//////// constants

	const _ROOT = 'site-settings';

	//// level 1

	const GOOGLE_CAPTCHA__PRIVATE_KEY = self::_ROOT . '__google-captcha__private-key';
	const GOOGLE_CAPTCHA__PUBLIC_KEY = self::_ROOT . '__google-captcha__public-key';

}