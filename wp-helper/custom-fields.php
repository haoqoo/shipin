<?php 
	/**
	 * 功能：辅助设置
	 * 说明：发表文章添加固定字段
	 */
	function register_field(){
		//add_action('publish_page', 'add_custom_field');//发布页面时	
		add_action('publish_post', 'add_custom_field');//发布文章时

		//写文章时，添加的固定字段，视频地址
		add_action('add_meta_boxes', 'create_meta_box');      
    	add_action('save_post', 'save_postdata');

    	//add_shortcode('swf','swf_player');
	}

	//发布文章时，添加评分字段，该字段不可见，发表文章时自动添加
	function add_custom_field($post_ID) {		
		if(!wp_is_post_revision($post_ID)) {
			add_post_meta($post_ID, 'like', 0, true);
		}
	}

	$new_meta_boxes = array(        
                        "vlink" => array(      
                            "name" => "vlink",      
                            "std" => "视频地址",      
                            "title" => "视频地址:")      
                    );

    function new_meta_boxes() {      
        global $post, $new_meta_boxes;  

        foreach($new_meta_boxes as $meta_box) {      
            $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);      
            // if($meta_box_value == "")      
            //     $meta_box_value = $meta_box['std'];      
            echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';      
            // 自定义字段标题      
            //echo'<h4>'.$meta_box['title'].'</h4>';      
            // 自定义字段输入框      
            //echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';    
            
            echo '<input style="width:500px;" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" placeholder="'.$meta_box['std'].'">';  
            
        }      
    }

    function create_meta_box() {      
        global $theme_name;      
        if ( function_exists('add_meta_box') ) {   
            
            add_meta_box( 'link', '视频地址', 'new_meta_boxes', 'post', 'normal', 'high' );   
            if( current_user_can( 'manage_options' )){
                add_meta_box( 'ext_field_plguin', '扩展字段','ext_field_box','post');     
            }  
            
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

        //保存数据库表的扩展字段
        if( current_user_can( 'manage_options' )){
            ext_field_save_postdata($post_id);          
        }
        
    }

    function ext_field_box( $post ) {
      global $wpdb;
       
      // Use nonce for verification
      wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );
       
      // 获取固定字段level_value和lock_status的值，用于显示之前保存的值
      // 此处wp_posts新添加的字段为level_value和lock_status，多个用半角逗号隔开
      $pd = $wpdb->get_row( $wpdb->prepare( "SELECT level_value, lock_status FROM $wpdb->posts WHERE ID = %d", $post->ID) );

      // Keywords 字段输入框的HTML代码
      echo '<label for="level_value">等级</label> ';
      echo '<input type="text" id="level_value" name="level_value" value="'.$pd->level_value.'" size="18" />';

      // description 字段输入框的HTML代码，即复制以上两行代码，并将keywords该成description
      echo '<label for="lock_status" style="margin-left:20px;">锁定</label> ';
      if($pd->lock_status == "true"){
        echo '<input style="vertical-align:middle;" type="checkbox" id="lock_status" name="lock_status" checked="checked" onclick="setLock(this)" />';    
      }else{
        echo '<input style="vertical-align:middle;" type="checkbox" id="lock_status" name="lock_status" onclick="setLock(this)" />';    
      }
      echo '<input type="hidden" id="ls" name="ls" ><script>function setLock(ck){if(ck.checked){document.getElementById("ls").value="true";}else{document.getElementById("ls").value="false";}}</script>';
      
      // 多个字段依此类推
    }

    /* 文章提交更新后，保存固定字段的值 */
    function ext_field_save_postdata( $post_id ) {
      // verify if this is an auto save routine.
      // If it is our form has not been submitted, so we dont want to do anything
      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
          return;

      // verify this came from the our screen and with proper authorization,
      // because save_post can be triggered at other times
      if ( !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) )
          return;
     
      // 权限验证
      if ( 'post' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_post', $post_id ) )
            return;
    }

      // 获取编写文章时填写的固定字段的值，多个字段依此类推
      $levelValue = $_POST['level_value'];
      $lockStatus = $_POST['ls'];
       
      // 更新数据库，此处wp_posts新添加的字段为keywords和description，多个根据你的情况修改
      global $wpdb;
      $wpdb->update( "$wpdb->posts",
              // 以下一行代码，多个字段的话参照下面的写法，单引号中是字段名，右边是变量值。半角逗号隔开
              array( 'level_value' => $levelValue, 'lock_status' => $lockStatus ),
              array( 'ID' => $post_id ),
              // 添加了多少个新字段就写多少个%s，半角逗号隔开
              array( '%s', '%s' ),
              array( '%d' )  
      );
    }

    function swf_player2($atts, $content = null) {
		extract(shortcode_atts(array("width"=>'480',"height"=>'360'),$atts));
		//$width = 480;
		//$height = 360;
		return '<embed type="application/x-shockwave-flash" width="'.$width.'" height="'.$height.'" src="'.$content.'"></embed>';
	}
	add_shortcode('myswf','swf_player2');
	 

 ?>