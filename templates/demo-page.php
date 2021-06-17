<?php
/*
Template Name: Demo page
Template Post Type: page
*/

namespace WpThemeBones;

defined('ABSPATH') ||
die('Required constant is missing');

use WpThemeBones\Blocks\DemoPage\DemoPage;
use WpThemeBones\Classes\Fb;

$demoPage = new DemoPage();
$demoPage->loadByDemo();

get_header();

Fb::Instance()->getRenderer()->render($demoPage, [], true);

get_footer();
