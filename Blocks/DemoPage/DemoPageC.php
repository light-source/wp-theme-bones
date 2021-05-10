<?php

namespace WpThemeBones\Blocks\DemoPage;

defined('ABSPATH') ||
die('Constant missing');

use LightSource\FrontBlocksFramework\Model;
use WpThemeBones\Blocks\{
    Article\Theme\Classic\Article_Theme_ClassicC,
    BemBlock\BemBlockC
};
use WpThemeBones\Classes\{
    Controller
};

class DemoPageC extends Controller
{

    protected BemBlockC $bemBlock;
    protected Article_Theme_ClassicC $article;

    public function __construct(?Model $model = null)
    {
        parent::__construct($model);

        $this->setExternal(
            'article',
            [
                'classes' => ['article--theme--classic',],
            ]
        );
    }

    public function getModel(): ?DemoPage
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return parent::getModel();
    }
}
