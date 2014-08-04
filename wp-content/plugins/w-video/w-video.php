<?php
/*
Plugin Name:W-Video
Plugin URI: 
Description: 自定义视频播放插件
Version: 1.0 
Author: 水滴石
Author URI:  http://www.wanjunjun.com/
*/
include 'functions.php';

add_action('admin_init', 'video_button');

function video_button(){
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
     return;
   }
   if ( get_user_option('rich_editing') == 'true' ) {
     add_filter( 'mce_external_plugins', 'add_video_plugin' );
     add_filter( 'mce_buttons', 'register_video_button' );
   }
}

function register_video_button($buttons){
	array_push( $buttons, "|", "swf" );
	return $buttons;
}

function add_video_plugin($plugin_array){
	$plugin_array['swf'] = plugins_url('',__FILE__).'/editor_plugin.js';
	return $plugin_array;
}


?>