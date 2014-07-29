<?php 
	/**
	 * 功能：辅助设置
	 * 说明：发表文章添加固定字段
	 */
	function register_field(){
		//add_action('publish_page', 'add_custom_field');//发布页面时	
		add_action('publish_post', 'add_custom_field');//发布文章时

		//写文章时，添加的固定字段，视频地址
		add_action('admin_menu', 'create_meta_box');      
    	add_action('save_post', 'save_postdata');
	}

	//发布文章时，添加评分字段，该字段不可见，发表文章时自动添加
	function add_custom_field($post_ID) {		
		if(!wp_is_post_revision($post_ID)) {
			add_post_meta($post_ID, 'like', '2', true);
		}
	}

	$new_meta_boxes =      
    array(        
        "vlink" => array(      
            "name" => "vlink",      
            "std" => "视频地址",      
            "title" => "视频地址:")      
    );

    function new_meta_boxes() {      
        global $post, $new_meta_boxes;      
        foreach($new_meta_boxes as $meta_box) {      
            $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);      
            if($meta_box_value == "")      
                $meta_box_value = $meta_box['std'];      
            echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';      
            // 自定义字段标题      
            //echo'<h4>'.$meta_box['title'].'</h4>';      
            // 自定义字段输入框      
            //echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';    
            if ('视频地址'==$meta_box_value) {
                echo '<input style="width:500px;" name="'.$meta_box['name'].'_value" placeholder="'.$meta_box_value.'">';  
            }else{
                echo '<input style="width:500px;" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'">';  
            }
            
        }      
    }

    function create_meta_box() {      
        global $theme_name;      
        if ( function_exists('add_meta_box') ) {      
            add_meta_box( 'link', '视频地址', 'new_meta_boxes', 'post', 'normal', 'high' );      
        }      
    }

    function save_postdata( $post_id ) {      
        global $post, $new_meta_boxes;      
        foreach($new_meta_boxes as $meta_box) {      
            if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {      
                return $post_id;      
            }      
            if ( 'page' == $_POST['post_type'] ) {      
                if ( !current_user_can( 'edit_page', $post_id ))      
                    return $post_id;      
            }       
            else {      
                if ( !current_user_can( 'edit_post', $post_id ))      
                    return $post_id;      
            }      
            $data = $_POST[$meta_box['name'].'_value'];      
         
            if(get_post_meta($post_id, $meta_box['name'].'_value') == "")      
                add_post_meta($post_id, $meta_box['name'].'_value', $data, true);      
            elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))      
                update_post_meta($post_id, $meta_box['name'].'_value', $data);      
            elseif($data == "")      
                delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));      
        }      
    }       

 ?>