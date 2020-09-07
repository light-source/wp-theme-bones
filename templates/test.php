<?php
/*
Template Name: Test
Template Post Type: page
*/

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\Test\Test_C;

get_header();

$testC = new Test_C();
$testC->getModel()->loadByTest();
$testC->render( [], true );

get_footer();
