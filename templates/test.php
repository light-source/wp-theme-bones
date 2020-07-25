<?php
/*
Template Name: Test
Template Post Type: page
*/

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use  WpThemeBones\Blocks\Test\Test;

get_header();

$test = new Test();
echo $test->render();

get_footer();
