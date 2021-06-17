<?php

namespace WpThemeBones\Blocks\Article\Theme\Classic;

defined('WP_THEME_BONES') ||
die('Required constant is missing');

use WpThemeBones\Blocks\Article\Article;

class ArticleThemeClassic extends Article
{

    public static function isSupportGutenberg(): bool
    {
        return true;
    }
}
