<?php 
	/**
	 * 功能：辅助设置
	 * 说明：该文件加载到wp-settings.php
	 */

	// ** 后台左侧菜单 ** //
	//隐藏更新count
	define('HIDDEN_UPDATE', true);	
	//隐藏插件
	define('HIDDEN_PLUGIN', true);
	//隐藏工具
	define('HIDDEN_TOOL', true);
	//隐藏外观
	//define('HIDDEN-');

	//打印
	define('DEBUG_LOG', true);



	//屏蔽后台更新模块 
	function wp_hide_notices() {
    	remove_action( 'admin_notices', 'update_nag', 3 );
	}
	add_action('admin_menu','wp_hide_notices');

	//屏蔽admin-header 一些无用的功能
	function annointed_admin_bar_remove() {
    	global $wp_admin_bar;
    	$wp_admin_bar->remove_menu('wp-logo');
	}
	add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);

	function wp_admin_header(){
		remove_action( 'admin_bar_menu', 'wp_admin_bar_updates_menu', 40 );
		if ( ! is_network_admin() && ! is_user_admin() ) {
			//评论
			remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
		}
	}
	add_action('admin_bar_menu','wp_admin_header');

	require('custom-fields.php');


 ?>