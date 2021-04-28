<?php

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\Header\Header;
use WpThemeBones\Blocks\Header\Header_C;
use WpThemeBones\Classes\Fbf;

$headerModel = new Header();
$headerModel->loadByDefault();
$headerController = new Header_C( $headerModel );

Fbf::Instance()->getBlocks()->renderBlock( $headerController, [], true );
