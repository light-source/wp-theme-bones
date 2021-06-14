<?php

declare(strict_types=1);

namespace WpThemeBones\Classes;

defined('ABSPATH') ||
die('Constant missing');

use WpThemeBones\Classes\{
    Acf\Main\Options,
    Security\Htaccess,
    Security\LoginForm
};

abstract class Actions
{
    public static function setHooks()
    {
        //// functional groups

        add_action('after_switch_theme', [Thumbnails::class, 'setupDefaults',]);
        add_filter('intermediate_image_sizes', [Thumbnails::class, 'filterImageSizes',]);
        add_filter('big_image_size_threshold', [Thumbnails::class, 'imageSizeThreshold',], 10, 4);

        add_action('after_setup_theme', [Theme::class, 'setupSupports',]);
        add_action('wp_mail_failed', [Theme::class, 'onMailFail',]);

        add_action('login_enqueue_scripts', [LoginForm::class, 'onResources',]);
        add_action('login_form', [LoginForm::class, 'onFields',]);
        add_filter('wp_authenticate_user', [LoginForm::class, 'filterVerify',], 10, 3);

        add_action('get_header', [Page::class, 'onGetHeader',]);
        add_action('wp_footer', [Page::class, 'onWpFooter',]);

        //// actions

        add_action('acf/init', [Options::class, 'setup',]);

        //// filters

        add_filter('mod_rewrite_rules', [Htaccess::class, 'filterContent']);

        //// fb

        Fb::Instance()->getRenderer()->getBlocksLoader()->loadAllBlocks();
    }

}
