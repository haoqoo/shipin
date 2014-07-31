<?php 
	/**
	 * 功能：辅助设置
	 * 说明：该文件加载到wp-settings.php
	 */

	// ** 后台左侧菜单 ** //
	//隐藏更新count
	define('HIDDEN_UPDATE', true);	
	//隐藏插件
	define('HIDDEN_PLUGIN', false);
	//隐藏工具
	define('HIDDEN_TOOL', true);
	//隐藏外观
	//define('HIDDEN-');

	//打印
	define('DEBUG_LOG', true);
	function debug_logger($msg){
		if(DEBUG_LOG && $msg!==''){
			echo $msg.'<br>';
		}
	}

	//屏蔽后台左侧菜单
	// function _menu_hide_(){
	// 	global $menu,$submenu;
	// }


	//屏蔽后台更新模块 
	function wp_hide_notices() {
    	remove_action( 'admin_notices', 'update_nag', 3 );
	}
	add_action('admin_menu','wp_hide_notices');

	//屏蔽admin-header 一些无用的功能
	function annointed_admin_bar_remove() {//屏蔽wordpress官网
    	global $wp_admin_bar;
    	$wp_admin_bar->remove_menu('wp-logo');
	}
	add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);

	function wp_admin_header(){
		//屏蔽 更新提醒
		remove_action( 'admin_bar_menu', 'wp_admin_bar_updates_menu', 40 );
		if ( ! is_network_admin() && ! is_user_admin() ) {
			//屏蔽 评论
			remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
		}
	}
	add_action('admin_bar_menu','wp_admin_header');

	//remove goole 字体。
	require_once('disable-google-fonts.php');

	require_once('custom-fields.php');


 ?>