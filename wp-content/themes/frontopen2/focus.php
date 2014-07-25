    <div class="focus">
          <div class="focus_img">
          <ul>
          <?php
				global $wpdb;
				$table_name = $wpdb->prefix;
				$blogUrl = 'http://'.$_SERVER['HTTP_HOST'];
				//$term_id = $wpdb->get_var("SELECT term_id FROM ".$table_name."terms WHERE name = 'post-format-image'");
		 		//$term_taxonomy_id = $wpdb->get_var("SELECT term_taxonomy_id FROM ".$table_name."term_taxonomy WHERE term_id = $term_id");
		  		$object_id = select_postmeta_key('flag','f');
          		query_posts( array ( 'post__in' => $object_id ,'cat'=>show_category_id()) ); ?>
			<?php if($object_id[0]){while(have_posts()) : the_post(); ?> 
              <li><a href="<?php the_permalink(); ?>"><?php if(get_option('themes_fo2_TimThumb')){?><img <?php echo lateLoad('data-focus-');?>src="<?php echo get_post_meta($post->ID, 'flashPic', true);?>" alt="<?php the_title()?>" /><?php }else{?><img <?php echo lateLoad('data-focus-');?>src="<?php echo str_replace($blogUrl,'',get_bloginfo("template_url"))?>/timthumb.php?src=<?php echo get_post_meta($post->ID, 'flashPic', true);?>&amp;h=504&amp;w=1272&amp;zc=1" alt="<?php the_title()?>" /><?php }?></a><div class="type_text"><p class="title"><?php the_title(); ?></p></div></li>
			<?php endwhile; wp_reset_query();}?>
           </ul>
		  </div>
          <div class="bt_line"></div>
     </div>
    
    <script type="text/javascript">
	jQuery(window).resize(function(){
		FocusSize()
	})
	
    //焦点图
	jQuery(document).ready(function($){
		dn = 0;
		imgNum  = $('.focus_img img').length;
		homeFocus(0)
		
		FocusSize()
		
		for(i=0;i<imgNum;i++){
			$("<a href='javascript:;'></a>").appendTo(".bt_line");
		}
			
		$('.bt_line a').mouseover(function(){
			var btIndex = $(this).index();
			$('.bt_line a').eq(btIndex).addClass('current').siblings().removeClass();
			homeFocus(btIndex)
			dn = btIndex;
		})
		
		$('.bt_line a').eq(0).addClass('current');
		$('.focus_img li').eq(0).show();
		
		$('.focus').hover(function(){
			clearTimeout(clocks);
		},function(){
			clocks = setInterval(clock,5000)
		})
		
		clocks = setInterval(clock,5000)
		
		function clock(){
			if(dn >= imgNum - 1){dn = 0}else{dn++};
			homeFocus(dn)
		}
		
		
		function homeFocus(nub){
			$('.focus_img li').eq(nub).css('z-index','3').siblings().css('z-index','0');
			$('.focus_img li').eq(nub).fadeIn(500).siblings().fadeOut(500);
			$('.bt_line a').eq(nub).addClass('current').siblings().removeClass();
			imgSrc = $('.focus_img li img').eq(nub).attr('data-focus-src');
			$('.focus_img li img').eq(nub).attr('src',imgSrc);
		}
	})
	
	function FocusSize(){
	  defHeight = 380;
	  defWidth  = 960;
	  nowImgWidth = jQuery('.focus').width();
	  biLi = defHeight/defWidth;
	  FocusHeight = nowImgWidth * biLi;
	  jQuery('.focus_img').height(FocusHeight);
	  jQuery('.focus_img li').height(FocusHeight)
	  jQuery('.focus_img img').height(FocusHeight)
	}

	
    </script>
