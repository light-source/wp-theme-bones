<?php

namespace WpThemeBones\Blocks\Footer;

defined('ABSPATH') ||
die('Constant missing');

use WpThemeBones\Classes\Controller;

class FooterC extends Controller
{

    public function getModel(): ?Footer
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return parent::getModel();
    }

}
