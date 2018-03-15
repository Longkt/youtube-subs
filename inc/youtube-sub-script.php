<?php 

function yts_add_scripts() {
	//Add CSS
	wp_enqueue_style( 'yts-style', plugin_dir_url(__FILE__) . '../css/style.css');

	//Add JS
	wp_enqueue_script('yts-script', plugin_dir_url(__FILE__) . '../js/script.js', array('jquery'), '1.0.0', false);

	//Add Google script
	wp_enqueue_script('google-script', 'https://apis.google.com/js/platform.js');
}

add_action( 'wp_enqueue_scripts', 'yts_add_scripts');