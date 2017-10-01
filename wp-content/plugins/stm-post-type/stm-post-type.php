<?php
/*
Plugin Name: STM Post Type
Plugin URI: http://stylemixthemes.com/
Description: STM Post Type
Author: Stylemix Themes
Author URI: http://stylemixthemes.com/
Text Domain: stm_post_type
Version: 1.5
*/

define( 'STM_POST_TYPE', 'stm_post_type' );
$plugin_path = dirname( __FILE__ );
require_once $plugin_path . '/post_type.class.php';


function stm_plugin_styles() {
	$plugin_url = plugins_url( '', __FILE__ );

    wp_enqueue_style( 'datetimepicker', $plugin_url . '/assets/css/jquery.datetimepicker.css', null, null, 'all' );
    wp_enqueue_script( 'datetimepicker', $plugin_url . '/assets/js/jquery.datetimepicker.full.min.js', array(), '2.4.5', true );
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );

	wp_enqueue_media();
}

add_action( 'admin_enqueue_scripts', 'stm_plugin_styles' );