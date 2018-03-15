<?php 
/*
Plugin Name: Youtube Subscriber Widget
Plugin URI: 
Description: Display subscriber of your Youtube channel
Version: 1.0.0
Author: Long Nguyen
Author URI: http://longnguyenwp.site
License: GPLv2 or later
*/

if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

require_once(plugin_dir_path(__FILE__) . 'inc/youtube-sub-script.php');
require_once(plugin_dir_path(__FILE__) . 'inc/youtube-sub-widget.php');

function register_yts_widget() {
	register_widget('Youtube_Sub_Widget');
}

add_action( 'widgets_init', 'register_yts_widget');
