<?php

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\Header\HeaderC;
use WpThemeBones\Classes\Fbf;

$headerController = new HeaderC();
$headerController->getModel()->loadByDefault();

Fbf::Instance()->getBlocks()->renderBlock( $headerController, [], true );
