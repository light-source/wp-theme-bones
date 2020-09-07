<?php

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\Footer\Footer_C;

$footerC = new Footer_C();
$footerC->getModel()->loadByDefault();
$footerC->render( [], true );
