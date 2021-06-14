<?php

declare(strict_types=1);

namespace WpThemeBones\Classes;

defined('ABSPATH') ||
die('Constant is missing');

use WP_Post;

abstract class Template
{
    const _FOLDER = 'templates';
    const DEMO_PAGE = self::_FOLDER . '/demo-page.php';

    public static function isTemplate(string $templateConst, int $pageId = 0): bool
    {
        if (! $pageId) {
            $queriedObject = get_queried_object();

            $pageId = ($queriedObject instanceof WP_Post &&
                       'page' === $queriedObject->post_type) ?
                $queriedObject->ID :
                $pageId;
        }

        return ($pageId &&
                $templateConst === get_page_template_slug($pageId));
    }
}
