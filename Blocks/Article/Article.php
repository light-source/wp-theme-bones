<?php

namespace WpThemeBones\Blocks\Article;

defined('ABSPATH') ||
die('Constant missing');

use LightSource\FrontBlocksFramework\Model;

class Article extends Model
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
}