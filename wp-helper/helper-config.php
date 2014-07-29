<?php 
	/**
	 * 功能：辅助设置
	 * 说明：该文件加载到wp-settings.php
	 */

	// ** 后台左侧菜单 ** //
	//隐藏更新count
	define('HIDDEN-UPDATE', true);	
	//隐藏插件
	define('HIDDEN-PLUGIN', true);
	//隐藏工具
	define('HIDDEN-TOOL', true);
	//隐藏外观
	//define('HIDDEN-');



	//屏蔽后台更新模块 
	function wp_hide_notices() {
    	remove_action( 'admin_notices', 'update_nag', 3 );
	}
	add_action('admin_menu','wp_hide_notices');

	//屏蔽admin-header 一些无用的功能
	function wp_admin_header(){
		
	}


	require('custom-fields.php');


 ?>