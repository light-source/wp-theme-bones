<?php

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\Header\Header_C;

$headerC = new Header_C();
$headerC->getModel()->loadByDefault();
$headerC->render( [], true );
