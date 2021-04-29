<?php

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\Footer\Footer_C;
use WpThemeBones\Classes\Fbf;

$footerController = new Footer_C();
$footerController->getModel()->loadByDefault();

Fbf::Instance()->getBlocks()->renderBlock( $footerController, [], true );
