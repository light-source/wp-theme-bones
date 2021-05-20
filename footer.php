<?php

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\Footer\Footer;
use WpThemeBones\Classes\Fb;

$footer = new Footer();

$footerHtml = Fb::Instance()->getRenderer()->render( $footer );

// for fb (see PAGE.php), insert styles into the head (for render speed increase, and echo script (in the footer)
wp_footer();

echo $footerHtml;
