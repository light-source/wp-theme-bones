<?php

declare(strict_types=1);

namespace WpThemeBones\Classes;

defined('ABSPATH') ||
die('Constant missing');

use LightSource\Log\LOG;
use WP_Error;

abstract class Theme
{
    const NAME = 'WpThemeBones';
    const _NAME = 'wp-theme-bones';
    const FOLDER__BLOCKS = 'Blocks';
    const FOLDER__ASSETS_PAGES = 'assets/pages';

    public static function getUrl(string $target, string $folder = ''): string
    {
        $url = get_stylesheet_directory_uri() . '/';
        $url .= $folder ?
            $folder . '/' :
            '';
        $url .= $target;

        return $url;
    }

    public static function setupSupports(): void
    {
        add_theme_support('post-thumbnails');
        add_theme_support('automatic-feed-links');
        add_theme_support('menus');
    }

    public static function onMailFail(WP_Error $wpError): void
    {
        $logMessage   = 'Fail send a mail';
        $logDebugArgs = [
            '$wpError' => $wpError,
        ];
        LOG::Write(LOG::WARNING, $logMessage, $logDebugArgs);
    }
}