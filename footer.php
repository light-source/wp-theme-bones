<?php

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\Footer\Footer_C;
use WpThemeBones\Classes\Fbf;

$footerController = new Footer_C();

$footerHtml = Fbf::Instance()->getBlocks()->renderBlock( $footerController );

// for fbf (see PAGE.php), insert styles into the head (for render speed increase, and echo script (in the footer)
wp_footer();

echo $footerHtml;
