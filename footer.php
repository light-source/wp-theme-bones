<?php

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\Footer\Footer;

$footer = new Footer();
echo $footer->render();
