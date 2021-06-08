<?php

namespace WpThemeBones\Blocks\DemoPage;

defined('ABSPATH') ||
die('Constant missing');

use LightSource\FrontBlocks\Helper;
use LightSource\FrontBlocks\Settings;
use WpThemeBones\Blocks\Article\Theme\Classic\ArticleThemeClassic;
use WpThemeBones\Blocks\Catalyst\Catalyst;
use WpThemeBones\Blocks\Common\Common;
use WpThemeBones\Classes\Block;

class DemoPage extends Block
{

    protected Common $common;
    protected Catalyst $catalyst;
    protected ArticleThemeClassic $article;

    public function loadByDemo(): void
    {
        parent::load();
        $this->article->loadByDemo();
    }

    public function getTemplateArgs(Settings $settings): array
    {
        return Helper::arrayMergeRecursive(
            parent::getTemplateArgs($settings),
            [
                'article' => [
                    'classes' => ['article--theme--classic',],
                ],
            ],
        );
    }
}
