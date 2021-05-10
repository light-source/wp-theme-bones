<?php

namespace WpThemeBones\Blocks\Article\Theme\Classic;

defined('ABSPATH') ||
die('Constant missing');

use LightSource\FrontBlocksFramework\Settings;
use WpThemeBones\Blocks\Article\Article;
use WpThemeBones\Blocks\Article\ArticleC;

class Article_Theme_ClassicC extends ArticleC
{

    public static function getPathToTwigTemplate(Settings $settings, string $controllerClass = ''): string
    {
        return parent::GetPathToTwigTemplate($settings, parent::class);
    }

    public static function getModelClass(): string
    {
        return Article::class;
    }

}
