<?php

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\Header\Header_C;
use WpThemeBones\Classes\Fbf;

$headerController = new Header_C();
$headerController->getModel()->loadByDefault();

Fbf::Instance()->getBlocks()->renderBlock( $headerController, [], true );
