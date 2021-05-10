<?php

namespace WpThemeBones\Blocks\Header;

defined('ABSPATH') ||
die('Constant missing');

use WpThemeBones\Classes\Controller;

class HeaderC extends Controller
{

    public function getModel(): ?Header
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return parent::getModel();
    }
}
