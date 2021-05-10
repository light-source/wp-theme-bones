<?php

namespace WpThemeBones\Blocks\Header;

defined('ABSPATH') ||
die('Constant missing');

use LightSource\FrontBlocksFramework\Model;

class Header extends Model
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
