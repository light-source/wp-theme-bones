<?php

namespace WpThemeBones\Blocks\Article;

defined('ABSPATH') ||
die('Constant missing');

use WpThemeBones\Classes\Block;

class Article extends Block
{

    protected string $title;
    protected string $text;
    protected array $classes;

    final public function loadByDemo(): void
    {
        parent::load();
        $this->title = "I'm Article";
        $this->text  = 'Some description';
    }

    public function loadByGutenberg(int $postId, string $prefix = '')
    {
        parent::loadByGutenberg($postId, $prefix);
        $this->loadByDemo();
    }
}
