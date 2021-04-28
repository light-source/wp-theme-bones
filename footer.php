<?php

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\Footer\Footer;
use WpThemeBones\Blocks\Footer\Footer_C;
use WpThemeBones\Classes\Fbf;

$footerModel = new Footer();
$footerModel->loadByDefault();
$footerController = new Footer_C( $footerModel );

Fbf::Instance()->getBlocks()->renderBlock( $footerController, [], true );
