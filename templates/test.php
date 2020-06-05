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

echo '<html>';
echo '<head>';
wp_head();
echo '</head>';
echo '<body>';
echo $home->render();
wp_footer();
echo '</body>';
echo '</html>';
