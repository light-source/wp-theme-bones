<?php

declare(strict_types=1);

namespace WpThemeBones\Classes\Acf;

use WpThemeBones\Classes\Acf\Main\BaseGroup;

abstract class SiteSettings extends BaseGroup
{
    const _ROOT = 'site-settings';

    const GOOGLE_CAPTCHA__PRIVATE_KEY = self::_ROOT . '__google-captcha__private-key';
    const GOOGLE_CAPTCHA__PUBLIC_KEY = self::_ROOT . '__google-captcha__public-key';
}