<?php
/*
Template Name: Demo page
Template Post Type: page
*/

namespace WpThemeBones;

defined('ABSPATH') ||
die('Constant missing');

use WpThemeBones\Blocks\DemoPage\DemoPageC;
use WpThemeBones\Classes\Fbf;

$demoPageController = new DemoPageC();
$demoPageController->getModel()->loadByDemo();

get_header();

Fbf::Instance()->getBlocks()->renderBlock($demoPageController, [], true);

get_footer();
