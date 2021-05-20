<?php

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\Header\Header;
use WpThemeBones\Classes\Fb;

$header = new Header();
$header->loadByDefault();

Fb::Instance()->getRenderer()->render( $header, [], true );
