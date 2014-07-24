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



?>
