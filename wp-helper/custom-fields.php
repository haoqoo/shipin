<?php 
	/**
	 * 功能：辅助设置
	 * 说明：发表文章添加固定字段
	 */
	function register_field(){
		//add_action('publish_page', 'add_custom_field');//发布页面时	
		add_action('publish_post', 'add_custom_field');//发布文章时
	}

	function add_custom_field($post_ID) {		
		if(!wp_is_post_revision($post_ID)) {
			add_post_meta($post_ID, 'like', '2', true);
		}
	}

 ?>