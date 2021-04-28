<?php
/*
Template Name: Demo page
Template Post Type: page
*/

namespace WpThemeBones;

defined( 'ABSPATH' ) ||
die( 'Constant missing' );

use WpThemeBones\Blocks\DemoPage\DemoPage;
use WpThemeBones\Blocks\DemoPage\DemoPage_C;
use WpThemeBones\Classes\Fbf;

$demoPageModel = new DemoPage();
$demoPageModel->loadByDemo();
$demoPageController = new DemoPage_C( $demoPageModel );

get_header();

Fbf::Instance()->getBlocks()->renderBlock( $demoPageController, [], true );

get_footer();
