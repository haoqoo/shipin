<?php 

//随机分类文章调用
class catPostsWidget extends WP_Widget {
	 function catPostsWidget(){
	  $widget_ops = array('classname'=>'widget_random_posts','description'=>'随机显示你博客中的文章');
	  $control_ops = array('width'=>250,'height'=>300);
	  $this->WP_Widget(false, '[FO]随机&分类文章调用', $widget_ops, $control_ops);
	 }
	 
	 function form($instance){
	 $instance = wp_parse_args((array)$instance,array('title'=>'随机文章','title_en'=>'Title','showPosts'=>10,'cat'=>0));//默认值
	  $title = htmlspecialchars($instance['title']);
	  $title_en = htmlspecialchars($instance['title_en']);
	  $showPosts = htmlspecialchars($instance['showPosts']);
	  $cat = htmlspecialchars($instance['cat']);
	 echo '<p style="text-align:left;"><label for="'.$this->get_field_name('title').'">标题:<input style="width:200px;" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></label></p>';
	 echo '<p style="text-align:left;"><label for="'.$this->get_field_name('showPosts').'">文章数量:<input style="width:200px;" id="'.$this->get_field_id('showPosts').'" name="'.$this->get_field_name('showPosts').'" type="text" value="'.$showPosts.'" /></label></p>';
	 echo '<p style="text-align:left;"><label for="'.$this->get_field_name('cat').'">分类ID:<input style="width:200px" id="'.$this->get_field_id('cat').'" name="'.$this->get_field_name('cat').'" type="text" value="'.$cat.'" /></label></p>';
	}
	
	function update($new_instance,$old_instance){
	 $instance = $old_instance;
	 $instance['title'] = strip_tags(stripslashes($new_instance['title']));
	 $instance['showPosts'] = strip_tags(stripslashes($new_instance['showPosts']));
	 $instance['cat'] = strip_tags(stripslashes($new_instance['cat']));
	 return $instance;
	}
	
	function widget($args, $instance){
	 extract($args);
	 $title = apply_filters('widget_title', empty($instance['title']) ? __('随机文章','yang') : $instance['title']);//小工具前台标题
	 $title = $title;
	 $showPosts = empty($instance['showPosts']) ? 10 : $instance['showPosts'];
	 $cat = empty($instance['cat']) ? 0 : $instance['cat'];  
	 echo $before_widget;
	 if( $title ) echo $before_title . $title . $after_title;  $query = new WP_Query("cat=$cat&showposts=$showPosts&orderby=rand");
	 if($query->have_posts()){
	  echo '<ul>';
	  while($query->have_posts()){
	   $query->the_post();
	   echo '<li><a href="'.get_permalink().'" title="阅读 ' . get_the_title() . ' 详细内容">'.get_the_title().'</a></li>';
	  }
	  echo '</ul>';
	 }  
	 echo $after_widget;
	}
}


//读者墙reader
class readerWidget extends WP_Widget {
	 function readerWidget(){
	  $widget_ops = array('classname'=>'widget_reader','description'=>'侧边栏显示读者墙');
	  $control_ops = array('width'=>250,'height'=>300);
	  $this->WP_Widget(false, '[FO]读者墙', $widget_ops, $control_ops);
	 }
	 
	 function form($instance){
	 $instance = wp_parse_args((array)$instance,array('title'=>'读者墙','readerNum'=>'24'));//默认值
	 $title = htmlspecialchars($instance['title']);
	 $readerNum = htmlspecialchars($instance['readerNum']);
	 echo '<p style="text-align:left;"><label for="'.$this->get_field_name('title').'">标题:<input style="width:200px;" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></label></p>';
	 echo '<p style="text-align:left;"><label for="'.$this->get_field_name('readerNum').'">显示读者数量:<input style="width:200px;" id="'.$this->get_field_id('readerNum').'" name="'.$this->get_field_name('readerNum').'" type="text" value="'.$readerNum.'" /></label></p>';
	}
	
	function update($new_instance,$old_instance){
	 $instance = $old_instance;
	 $instance['title'] = strip_tags(stripslashes($new_instance['title']));
	 $instance['readerNum'] = strip_tags(stripslashes($new_instance['readerNum']));
	 return $instance;
	}
		
	function widget($args, $instance){
	 extract($args);
	 $title = apply_filters('widget_title', empty($instance['title']) ? __('活跃读者','yang') : $instance['title']);//小工具前台标题
	 $title = $title;
	 $readerNum = $instance['readerNum'];
	 echo $before_widget;  //id开始框
	 if( $title ) echo $before_title . $title . $after_title; //标题
     if (function_exists('zsofa_most_active_friends')) { echo "<ul class='read_ul'>" . zsofa_most_active_friends($readerNum) . "</ul>";} ;
	 echo $after_widget;  //框架结束
	}
	

}



//网站统计工具
class siteInfoWidget extends WP_Widget {
	 function siteInfoWidget(){
	  $widget_ops = array('classname'=>'widget_links','description'=>'显示站点的统计信息');
	  $control_ops = array('width'=>250,'height'=>300);
	  $this->WP_Widget(false, '[FO]站点信息', $widget_ops, $control_ops);
	 }
	 
	 function form($instance){
	 $instance = wp_parse_args((array)$instance,array('title'=>'','title_en'=>'Title'));//默认值
	  $title = htmlspecialchars($instance['title']);
	  $title_en = htmlspecialchars($instance['title_en']);
	  $buildDate = htmlspecialchars($instance['buildDate']);
	 echo '<p style="text-align:left;"><label for="'.$this->get_field_name('title').'">标题:<input style="width:200px;" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></label></p>';
	 echo '<p style="text-align:left;"><label for="'.$this->get_field_name('buildDate').'">建站日期:<input style="width:200px;" id="'.$this->get_field_id('buildDate').'" name="'.$this->get_field_name('buildDate').'" type="text" value="'.$buildDate.'" /></label><br/><p style="color:#999">默认格式为：2012-12-12</p></p>';
	}
	
	function update($new_instance,$old_instance){
	 $instance = $old_instance;
	 $instance['title'] = strip_tags(stripslashes($new_instance['title']));
	 $instance['buildDate'] = strip_tags(stripslashes($new_instance['buildDate']));
	 return $instance;
	}
	
	function widget($args, $instance){
	 extract($args);
	 $title = apply_filters('widget_title', empty($instance['title']) ? __('站点信息','yang') : $instance['title']);//小工具前台标题
	 $title = $title;
	 $buildDate = empty($instance['buildDate']) ? date("Y-m-d") : $instance['buildDate'];
	 echo $before_widget;
	 if( $title ) echo $before_title . $title . $after_title;
	 ?>
     <ul class="xoxo siteInfo">
      <li>文章总数：<?php $count_posts = wp_count_posts();echo $published_posts = $count_posts->publish;?>篇</li>
      <li>分类总数：<?php echo $count_categories = wp_count_terms('category'); ?>个</li>
      <li>标签总数：<?php echo $count_tags = wp_count_terms('post_tag'); ?>个</li> 
      <li>评论总数：<?php $count_comments = get_comment_count();echo $count_comments['approved'];?>条</li>
      <li>页面总数：<?php $count_pages = wp_count_posts('page'); echo $page_posts = $count_pages->publish; ?>个</li> 
      <li>网站已运行：<?php echo floor((time()-strtotime($buildDate))/86400); ?>天</li>
      </ul>
	<?php echo $after_widget;
	}
}

//前台登录小工具
class frontLoginBlock extends WP_Widget {
	function frontLoginBlock(){
	  $widget_ops = array('classname'=>'widget_login','description'=>'用户可以通过侧边栏的模块登录网站');
	  $control_ops = array('width'=>250,'height'=>300);
	  $this->WP_Widget(false, '[FO]前台登录模块', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance){
	 extract($args);
	 echo $before_widget;
	 ?>
	 <div class="front_login_box">
      <?php if(is_user_logged_in()){ ?>
      <div class="is_login">
      <?php 
	  global $current_user;
      get_currentuserinfo();
      $username =  $current_user->user_login;
      $display_name = $current_user->display_name;
	  $adminurl = admin_url();
	  $userId = $current_user->ID;
	  ?>
        <div class="user_info">
        	<p class="avatar"><a href="<?php echo bloginfo('url')."?author=".$userId?>"><?php echo get_avatar($current_user->ID); ?></a></p>
            <p>欢迎，<?php echo $display_name?></p>
            <p style="color:#999"><?php echo $username;?> [<?php 
			if(current_user_can( 'manage_options' )){echo "管理员";}
			elseif(current_user_can( 'publish_pages' )){echo "编辑者";}
			elseif(current_user_can( 'publish_posts' )){echo "作者";}
			elseif(current_user_can( 'edit_posts' )){echo "投稿者";}
			elseif(current_user_can( 'read' )){echo "订阅者";}
			?>]</p>
            <p><a class="iframe" href="<?php echo $adminurl.'profile.php';?>" title="编辑个人资料" target="_blank">编辑个人资料</a></p>
        </div>
        <div class="link_tools">
        	<a href="<?php echo $adminurl?>" target="_blank"><i class="icon-dashboard"></i> 仪表盘</a>
            <?php if( current_user_can( 'read' ) && !current_user_can( 'edit_posts' )){}else{?>
            <a href="<?php echo $adminurl?>post-new.php" target="_blank" class="iframe" title="发布新文章"><i class="icon-plus-sign-alt"></i> 发表文章</a>
            <a href="<?php echo $adminurl?>edit-comments.php" target="_blank" class="iframe" title="查看<?php echo bloginfo('name')?>中的所有评论"><i class="icon-comments"></i> 查看评论</a>
            <a href="<?php echo $adminurl?>edit.php" target="_blank" class="iframe" title="查看<?php echo bloginfo('name')?>中的所有文章"><i class="icon-book"></i> 所有文章</a>
            <a href="<?php echo bloginfo('url')."?author=".$userId?>" target="_blank"><i class="icon-home"></i> 我的文章</a>
            <?php }?>
          <div class="cls"></div>
        </div>
        <div class="last_read">
        	<?php if (function_exists('zg_recently_viewed')): if (isset($_COOKIE["WP-LastViewedPosts"])) { ?>
            <p style="margin-bottom:10px;"><i class="icon-time"></i> 您最近浏览过的5篇文章</p>
            <?php zg_recently_viewed(); ?>
            <?php } endif; ?>
        </div>
        <p class="logout"><?php echo "<a href='".wp_logout_url()."'>注 销</a>";?></p>
        <div class="cls"></div>
      </div>
      <?php }else{?>
      	<div class="from_box">
      <form name="loginform" id="loginform" action="<?php echo wp_login_url()?>" method="post">
            <p class="p1"><span><i class="icon-user icon-2x"></i></span><input onfocus="this.value = '';" name="log" id="user_login" type="text" class="user_name" value="User Name" /></p>
          <p class="p1" style="margin-bottom:30px;"><span><i class="icon-lock icon-2x"></i></span><input onfocus="this.value = '';this.type = 'password';" name="pwd" id="user_pass" type="text" class="password" value="Your Password" /></p>
          <p class="p2"><input name="提交" type="submit" class="submit_button" value="登 录" /></p>
          <p class="p3"><span style="float:right"><i class="icon-signin"></i> <?php echo wp_register('','','注册帐号');?></span><span class="keep_me"><label style="display:none;" for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"></label><i class="icon-check-empty"></i> 记住我的登录信息</span></p>
          <input type="hidden" name="redirect_to" value="<?php if(is_page() || is_single()){the_permalink();}else{echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];}?>">
          </form>
        </div>
        <script type="text/javascript">
		jQuery(function($){
			$('.keep_me').click(function(){
				var nowSet = $(this).find('i').attr('class');
				if(nowSet == "icon-check-empty"){
					$(this).find('i').attr('class','icon-check');
					$(this).find('#rememberme').attr('checked','')
				}else{
					$(this).find('i').attr('class','icon-check-empty');
					$(this).find('#rememberme').removeAttr('checked')
				}
			})
		});
        </script>
      <?php }?>
      </div>
     <?php echo $after_widget;
	}

}

//近期评论小工具

//* 继承WP_Widget_Recent_Comments
//* 这样就只需要重写widget方法就可以了
class My_Widget_Recent_Comments extends WP_Widget_Recent_Comments {
/*构造方法，主要是定义小工具的名称，介绍*/
function My_Widget_Recent_Comments() {
$widget_ops = array('classname' => 'my_widget_recent_comments', 'description' => __('显示最新评论内容'));
$this->WP_Widget('my-recent-comments', __('[FO]近期评论', 'my'), $widget_ops);
}
/*小工具的渲染方法，这里就是输出评论*/
function widget($args, $instance) {
global $wpdb, $comments, $comment; $cache = wp_cache_get('my_widget_recent_comments', 'widget'); if (!is_array($cache))
$cache = array(); if (!isset($args['widget_id']))
$args['widget_id'] = $this->id; if (isset($cache[$args['widget_id']])) {
echo $cache[$args['widget_id']];
return;
} extract($args, EXTR_SKIP);
$output = '';
$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Comments') : $instance['title'], $instance, $this->id_base);
if (empty($instance['number']) || !$number = absint($instance['number']))
$number = 5;
//获取评论，过滤掉管理员自己
$comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE user_id !=2 and comment_approved = '1' and comment_type not in ('pingback','trackback') ORDER BY comment_date_gmt DESC LIMIT $number");
$output .= $before_widget;
if ($title)
$output .= $before_title . $title . $after_title; $output .= '<ul id="myrecentcomments">';
if ($comments) {
// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
$post_ids = array_unique(wp_list_pluck($comments, 'comment_post_ID'));
_prime_post_caches($post_ids, strpos(get_option('permalink_structure'), '%category%'), false); foreach ((array) $comments as $comment) {
//头像
$avatar = get_avatar($comment, 40);
//作者名称
$author = get_comment_author();
//评论内容
$content = apply_filters('get_comment_text', $comment->comment_content);
$content = mb_strimwidth(strip_tags($content), 0, '65', '...', 'UTF-8');
$content = convert_smilies($content);
//评论的文章
//$post = '<a href="' . esc_url(get_comment_link($comment->comment_ID)) . '">' . get_the_title($comment->comment_post_ID) . '</a>'; //这里就是输出的html，可以根据需要自行修改
$href = esc_url(get_comment_link($comment->comment_ID));
$posttitle = get_the_title($comment->comment_post_ID);
$Posttime = human_time_diff( get_comment_time('U') , current_time('timestamp'));
$output .= '<li class="cuscomment" style="padding-bottom: 5px; ">
<table class="tablayout"><tbody>
<tr>
<td class="tdleft" style="width:55px;vertical-align:top;">' . $avatar . '</td>
<td class="tdleft" style="vertical-align:top;">
<p class="comment-author"><strong><span class="fn">' . $author . '</span></strong> <span class="says">' . $Posttime . '之前说：</span></p>
<p><a href="'.$href.'" title="查看文章 '.$posttitle.' 的评论">'. $content . '</a></p>
</td>
</tr></tbody></table>
</li>';
}
}
$output .= '</ul>';
$output .= $after_widget; echo $output;
$cache[$args['widget_id']] = $output;
wp_cache_set('my_widget_recent_comments', $cache, 'widget');
}}//注册小工具
register_widget('My_Widget_Recent_Comments');

?>
