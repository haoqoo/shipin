<?php

if(get_option('themes_fo2_dis_num')){
	$dis_num = get_option('themes_fo2_dis_num');
	}
	else{
		$dis_num = 150;
	};
	
//缩略图高宽
if(get_option('themes_fo2_image_width')){$imgW = intval(get_option('themes_fo2_image_width'));}else{if(!get_option('themes_fo2_TimThumb')){$imgW = 205;}else{$imgW = 'auto';}};
intval(get_option('themes_fo2_image_height')) ? $imgH = intval(get_option('themes_fo2_image_height')) : $imgH = 140;

?>  
<?php if(get_option('themes_fo2_focus') && is_home() && !is_paged())get_template_part('focus');?>
  <div class="top_box">
  <?php 
      if(is_home() && get_option('sticky_posts')){
      $sticky = get_option('sticky_posts'); 
      rsort( $sticky );//对数组逆向排序，即大ID在前 
      $sticky = array_slice( $sticky, 0, 3);//输出置顶文章数，请修改5，0不要动，如果需要全部置顶文章输出，可以把这句注释掉 
      query_posts( array( 'post__in' => $sticky, 'caller_get_posts' => 1 ) ); 
      if (have_posts()) :while (have_posts()) : the_post();
  ?>
    <div class="top_post">
      <div class="title">置 顶</div><article class="ulist">
      <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><i class="icon-eject icon-large"></i><?php the_title(); ?></a> 
    <?php $t1=$post->post_date;
          $t2=date("Y-m-d H:i:s");
          $diff=(strtotime($t2)-strtotime($t1))/3600;
          if($diff<24){echo "<span class='title_new'>NEW</span>";} 
          if(get_option('themes_fo2_view_time') && getPostViews(get_the_ID())){echo "<span class='title_hot'>" . getPostViews(get_the_ID()) . " VIEW</span>";}else{if(get_option('themes_fo2_view_num')){if(getPostViews(get_the_ID()) > get_option('themes_fo2_view_num')){echo " <span class='title_hot'>HOT</span>";};}}
           ?>
  <span><?php the_time('Y-m-d') ?></span></h2>
    </article>
    </div>
  <?php endwhile; endif; wp_reset_query();}?>
</div>
<?php $ifpic = get_option('themes_fo2_auto_zhaiyao'); 
	if($ifpic == 'checked'){
	  echo "<style type='text/css'>.c-con img{height: auto !important;width: 100% !important; margin:0px !important;} .c-con iframe{width: 100% !important; margin:0px !important;}</style>\n";
	}
?>
<?php
  global $query_string;
  query_posts( $query_string . '&ignore_sticky_posts=1' );
?>

<?php while ( have_posts() ) : the_post(); ?>
<article class="post_box" <?php if($ifpic == 'checked'){ echo "style='float:right'" ;}?>>
    <div class="c-top" id="post-<?php the_ID(); ?>">
        <div class="datetime"><?php the_time('Y') ?><br /><?php the_time('m-d') ?></div>	
            <header class="tit">
                <h2 class="h1"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'frontopen' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a><?php 
					  $t1=$post->post_date;
					  $t2=date("Y-m-d H:i:s");
					  $diff=(strtotime($t2)-strtotime($t1))/3600;
					  if($diff<24){echo " <span class='title_new'>NEW</span>";} 
					  if(get_option('themes_fo2_view_time') && getPostViews(get_the_ID())){echo " <span class='title_hot'>" . getPostViews(get_the_ID()) . " VIEW</span>";}else{if(get_option('themes_fo2_view_num')){if(getPostViews(get_the_ID()) > get_option('themes_fo2_view_num')){echo " <span class='title_hot'>HOT</span>";};}}?></h2>
                <aside class="iititle"><span><i class="icon-user icon-large"></i> <?php the_author_posts_link(); ?></span><?php printf( __( '<span><i class="icon-folder-open icon-large"></i> %2$s</span>', 'frontopen' ), 'i1', get_the_category_list( ', ' ) ); ?><?php if(get_option('themes_fo2_view_time') && getPostViews(get_the_ID()));else{ ?><span><i class="icon-eye-open icon-large"></i> 围观<?php echo getPostViews(get_the_ID()); ?>次</span><?php }?><span><i class="icon-comment-alt icon-large"></i> <?php comments_popup_link( __( 'Leave a comment', 'frontopen' ), __( '1 Comment', 'frontopen' ), __( '% Comments', 'frontopen' ) ); ?></span></aside>
            </header>
    </div>
    <div class="c-con" <?php if($ifpic == 'checked'){ echo "style='height:auto'" ;}?>><?php if($ifpic == 'checked') the_post_thumbnail('thumbnail');?>
    <?php if(!get_option('themes_fo2_dis_href')){?><a href="<?php the_permalink(); ?>" class="disp_a" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'frontopen' ), the_title_attribute( 'echo=0' ) ); ?>"><?php } ?><?php if($ifpic != 'checked'){ ?>
	<?php if ( has_post_thumbnail() ) { ?>
    <?php post_thumbnail($imgW,$imgH,lateLoad('data-').'src');
		if(has_excerpt()) the_excerpt();
		else
		echo dm_strimwidth(strip_tags($post->post_content),0,$dis_num,'....');}
		elseif(catch_that_image()){post_thumbnail($imgW,$imgH,lateLoad('data-').'src');?>
		<?php if(has_excerpt()) the_excerpt();
		else
		echo dm_strimwidth(strip_tags($post->post_content),0,$dis_num,'....');}
		else {if(has_excerpt()) the_excerpt();
		else
		echo dm_strimwidth(strip_tags($post->post_content),0,$dis_num+50,'....');}}
		if($ifpic == 'checked'){the_content( 'Read More >' , $strip_teaser, $more_file);}
		wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'frontopen' ), 'after' => '</div>' ) );
		if(!get_option('themes_fo2_dis_href')){?>
        </a><?php }?>
<a href="<?php the_permalink(); ?>" class="more-link"><?php if(get_option('themes_fo2_readmore')){echo get_option('themes_fo2_readmore');}else{echo "Read More >";}?></a><div class="cls"></div>
    </div>
    <div class="c-bot">
    <?php the_tags('<aside class="cb_bq"><i class="icon-tag icon-large"></i> ', '，', '</aside>'); ?><?php edit_post_link('编辑', '<i class="icon-edit icon-large"></i> ', ''); ?>
        <div class="cls"></div>
    </div>
</article>
    
	<?php comments_template( '', true ); ?>
<?php endwhile; // End the loop. Whew. ?>
<?php /* Display navigation to next/previous pages when applicable */ ?>
<div class="cls"></div>
<div class="page_num">
<?php previous_posts_link(); par_pagenavi(); next_posts_link();?>
</div>