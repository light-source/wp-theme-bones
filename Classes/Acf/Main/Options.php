<?php

declare(strict_types=1);

namespace WpThemeBones\Classes\Acf\Main;

defined('ABSPATH') ||
die('Constant is missing');

abstract class Options
{
    public static function setup(): void
    {
        if (! function_exists('acf_add_options_page')) {
            return;
        }

        acf_add_options_page(
            [
                'page_title' => 'Site Settings',
                'menu_title' => 'Site Settings',
                'menu_slug'  => 'site-settings',
                'capability' => 'edit_posts',
                'redirect'   => false,
            ]
        );
    }
}
