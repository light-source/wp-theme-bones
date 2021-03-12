<?php
/*
Template Name: Demo page
Template Post Type: page
*/

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\DemoPage\DemoPage_C;

get_header();

$testC = new DemoPage_C();
$testC->getModel()->loadByDemo();
$testC->render( [], true );

get_footer();
