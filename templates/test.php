<?php
/*
Template Name: Test
Template Post Type: page
*/

namespace WpThemeBones;

use WpThemeBones\Pages\Home;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

$home = new Home();
echo $home->render();
