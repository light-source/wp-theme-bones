<?php

namespace WpThemeBones\Blocks\Article;

defined('ABSPATH') ||
die('Constant missing');

use WpThemeBones\Classes\Controller;

class ArticleC extends Controller
{

    public function getModel(): ?Article
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return parent::getModel();
    }
}
