<?php

namespace WpThemeBones\Blocks\DemoPage;

defined('ABSPATH') ||
die('Constant missing');

use LightSource\FrontBlocksFramework\Model;
use WpThemeBones\Blocks\Article\Article;

class DemoPage extends Model
{

    protected Article $article;

    public function loadByDemo(): void
    {
        parent::load();
        $this->article->loadByDemo();
    }
}
