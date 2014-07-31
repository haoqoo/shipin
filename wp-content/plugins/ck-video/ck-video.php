<?php
/*
Plugin Name:CK-Video
Plugin URI: http://www.qiuxinjiang.cn/
Description: 通过超酷播放器增加带自己广告的视频，多集连播地址间用“||”间隔，请及时到ckplayer官方论坛更新冷聚星的解析插件最新版:http://www.ckplayer.com/bbs/forum.php?mod=viewthread&tid=2486
Version: 0.65 
Author: 滴水成江
Author URI:  http://www.qiuxinjiang.cn/
*/

include 'functions.php';

/* 启用、停用插件时要调用的函数 */
register_activation_hook( __FILE__, 'CK_Video_register' );   
register_deactivation_hook( __FILE__, 'CK_Video_remove' );   


// 增加设置按钮
add_filter('plugin_action_links', 'add_ck_settings_link', 10, 2 );
function add_ck_settings_link($links, $file) {
   if(current_user_can('level_10')){
	static $this_plugin;
	if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
 
	if ($file == $this_plugin){
		$settings_link = '<a href="'.wp_nonce_url("admin.php?page=ck-video/menu.php").'">设置</a>';
		array_unshift($links, $settings_link);
	}
	return $links;
}
}


add_action('init', 'CK_Video_addbuttons');
add_shortcode('ckvideo','CK_Video');   
add_shortcode('ckvideonext','CK_Video_Next'); 	
?>