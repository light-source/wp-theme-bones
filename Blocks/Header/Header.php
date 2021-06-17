<?php

namespace WpThemeBones\Blocks\Header;

defined('WP_THEME_BONES') ||
die('Required constant is missing');

use WpThemeBones\Classes\Block;

class Header extends Block
{

    protected string $htmlAttrs;
    protected string $charset;
    protected string $wpHeader;
    protected array $bodyClasses;
    protected string $wpBodyOpen;

    public function loadByDefault()
    {
        parent::load();
        ob_start();
        wp_head();
        $this->wpHeader = ob_get_clean();

        ob_start();
        wp_body_open();
        $this->wpBodyOpen = ob_get_clean();

        $this->htmlAttrs   = get_language_attributes();
        $this->charset     = get_bloginfo('charset');
        $this->bodyClasses = get_body_class();
    }
}
