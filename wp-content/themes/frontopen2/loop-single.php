<div class="mbx"><i class="icon-home icon-large" style="font-size:14px;"></i>
<?php wheatv_breadcrumbs();?>
</div>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="c-top2" id="post-55">
                <div class="datetime"><?php the_time('Y') ?><br /><?php the_time('m-d') ?></div>
					<header class="tit" style="position:relative;"><h1 class="entry-title"><?php the_title(); ?></h1>
					<aside class="entry-meta iititle2">
                        <span><i class="icon-user icon-large"></i> <?php the_author_posts_link(); ?></span><?php printf( __( '<span><i class="icon-folder-open icon-large"></i> %2$s</span>', 'frontopen' ), 'i1', get_the_category_list( ', ' ) ); ?><span><i class="icon-eye-open icon-large"></i> 围观<i id="number"><?php echo getPostViews(get_the_ID());if($_SERVER["QUERY_STRING"])setPostViews(get_the_ID())?></i><script type="text/javascript">jQuery(function($){$.get("<?php bloginfo('url')?>/fo_ajax?ajax=getPostViews&postID=<?php echo get_the_ID()?>",function(data){if(data.length < 10)$('#number').text(data)});})</script>次</span><span><i class="icon-comment-alt icon-large"></i> <?php comments_popup_link( __( 'Leave a comment', 'frontopen' ), __( '1 Comment', 'frontopen' ), __( '% Comments', 'frontopen' ) ); ?></span><span><i class="icon-pencil icon-large"></i> 编辑日期：<time><?php the_modified_time('Y-m-d')?></time></span><span><i class="icon-zoom-in icon-large"></i> 字体：<a href="javascript:;" onclick="checkFontSize(18)">大</a> <a href="javascript:;" onclick="checkFontSize(16)">中</a> <a href="javascript:;" onclick="checkFontSize(14)">小</a></span><?php if(function_exists('the_views')) { the_views(); } ?>
						<span><i class="icon-user icon-large"></i>评分: <?php echo get_post_meta(get_the_ID(), "like", $single = true); ?></span>						
					</aside>
					<div style="position:absolute;top:1px;right:1px;">
						<span><img src="<?php echo bloginfo('url').'/wp-helper/images/like.png';?>" /><a href="<?php echo bloginfo('url').'/wp-helper/score.php?oper=like&postID='.get_the_ID(); ?>">喜欢</a></span>
						<span style="margin-left:10px;"><img style="vertical-align:middle;" src="<?php echo bloginfo('url').'/wp-helper/images/nolike.png';?>" /><a href="<?php echo bloginfo('url').'/wp-helper/score.php?oper=nolike&postID='.get_the_ID(); ?>">不喜欢</a></span>
					</div>
                    </header>
                    <div class="cls"></div>
		    </div>
                    <!-- .entry-meta -->

					<article class="entry-content">
                    <?php if(get_option('themes_fo2_ad_1')){?>
						<div class="ad_1">
						<?php echo get_option('themes_fo2_ad_1') ?>
                        </div>
					<?php }?>						
						<?php the_content(); ?> 
 					<?php wp_link_pages(array('before' => '<div class="page-link">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '<span>上一页</span>', 'nextpagelink' => "")); ?><?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>
					<?php wp_link_pages(array('before' => '', 'after' => '<div class="cls"></div></div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => "<span>下一页</span>")); ?>
<!--                         <div class="loc_link"><ul><li>本文固定链接: <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php echo urldecode(get_permalink()) ?></a></li>
                        <li>转载请注明: <?php if(get_option('themes_fo2_zhuanzai')){echo get_option('themes_fo2_zhuanzai');}else{ ?><?php the_author_posts_link(); ?> <time><?php the_time('Y年m月d日')?> </time>于 <a href="<?php echo home_url(); ?>/" title="访问<?php bloginfo('name');?>"><?php bloginfo('name');?></a> 发表<?php }?></li></ul>
                        </div> -->
                        <?php if(get_option('themes_fo2_fenxiang')){?>
							<div style="margin-top:10px">
							<?php echo get_option('themes_fo2_fenxiang');?>
							<div class="cls"></div></div>
							<?php }?>
						<?php
						$curauth = get_userdata(get_the_author_ID());
                        ?>
                        <div class="author_info">
                        	<div class="au_top_bar"><div class="edit_date">最后编辑：<time><?php the_modified_time('Y-m-d')?></time></div><b>作者：<?php the_author()?></b></div>
                            <div class="avatar"><?php echo get_avatar(get_the_author_ID());?></div>
                            <div class="type_out"><span class="ttxx"><?php if(get_the_author_description()){the_author_description();}else{echo "这个作者貌似有点懒，什么都没有留下。";}?></span><div class="au_links"><a href="<?php echo bloginfo('url')."?author=".get_the_author_ID()?>" class="c1"><i class="icon-home"></i> 站内专栏</a><?php if(get_the_author_url()){?> <a href="<?php the_author_url();?>" class="c2" target="_blank" rel="external nofollow"><i class="icon-globe"></i> 站点</a><?php }?><?php if($curauth->qq){?> <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $curauth->qq; ?>&site=qq&menu=yes" class="c4"><i class="icon-comments-alt"></i> QQ交谈</a><?php }?><?php if($curauth->tengxunweibo){?> <a href="<?php echo $curauth->tengxunweibo?>" class="c5" target="_blank" rel="external nofollow"><i class="icon-pinterest-sign"></i> 腾讯微博</a><?php }?><?php if($curauth->sinaweibo){?> <a href="<?php echo $curauth->sinaweibo?>" class="c6" target="_blank" rel="external nofollow"><i class="icon-linkedin-sign"></i> 新浪微博</a><?php }?></div></div>
                        <div class="cls"></div>
                        </div>
                        <?php if( get_the_author_aim() || get_option('themes_fo2_zhifu_url')) {?>
                        <div class="j_zeng">
                        	<a href="<?php if(get_option('themes_fo2_author_jz')){the_author_aim();}else{echo get_option('themes_fo2_zhifu_url');} ?>" target="_blank" class="jz_bt" rel="external nofollow">捐  赠</a><span><?php if($curauth->juanzeng){echo $curauth->juanzeng;}else{if(get_option('themes_fo2_juankuan')){echo get_option('themes_fo2_juankuan');}else{echo "如果您觉得这篇文章有用处，请支持作者！鼓励作者写出更好更多的文章！";}}?></span>
                        </div>
                        <?php }?>
					</article>
                    
                    <!-- .entry-content -->

					<!-- .entry-utility -->
				</div><!-- #post-## -->
<div class="c-bot">
    <?php the_tags('<aside class="cb_bq"><i class="icon-tag icon-large"></i> ', '，', '</aside>'); ?><?php edit_post_link('编辑', '<i class="icon-edit icon-large"></i> ', ''); ?>
        <div class="cls"></div>
    </div>
    <br />
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_post_link( '%link', '<span class="meta-nav">' . _x('<i class="icon-arrow-left"></i>' , 'Next post link', 'frontopen' ) . '</span> %title ' ); ?></div>
					<div class="nav-next"><?php previous_post_link( '%link', '%title ' . _x(' <i class="icon-arrow-right"></i>' , 'Previous post link', 'frontopen' ) . '' ); ?></div>
				</div><!-- #nav-below -->
<div class="cls"></div>
				<?php if(get_option('themes_fo2_ad_2') && !wp_is_mobile()) {?>
                    <div class="ad_2">
						<?php echo get_option('themes_fo2_ad_2'); ?>
                    </div>
                <?php }else{?>
                    <div class="ad_2">
						<?php echo get_option('themes_fo2_mobile_ad_2'); ?>
                    </div>
                <?php }?>
                <div class="relatedposts">
<h3 class="widget-title"><i class="icon-warning-sign"></i> 您可能还会对这些文章感兴趣！</h3>
<ul>
	<?php
	$post_num = 8; 
	global $post;
	$exists_related_ids = array();
	$tmp_post = $post;
	$tags = ''; $i = 0;
	$exists_related_ids[] = $post->ID;
	if ( get_the_tags( $post->ID ) ) {
	foreach ( get_the_tags( $post->ID ) as $tag ) $tags .= $tag->name . ',';
	$tags = strtr(rtrim($tags, ','), ' ', '-');
	$myposts = get_posts('numberposts='.$post_num.'&tag='.$tags.'&exclude='.$post->ID);
	foreach($myposts as $post) {
	setup_postdata($post);
	?>
	<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="详细阅读 <?php the_title(); ?>"><?php the_title(); ?></a></li>
	<?php
	$exists_related_ids[] = $post->ID;
	$i += 1;
	}
	}
	if ( $i < $post_num ) {
	$post = $tmp_post; setup_postdata($post);
	$cats = ''; 
	$post_num -= $i;
	foreach ( get_the_category( $post->ID ) as $cat ) $cats .= $cat->cat_ID . ',';
	$cats = strtr(rtrim($cats, ','), ' ', '-');
	$myposts = get_posts('numberposts='.$post_num.'&orderby=rand&category='.$cats.'&exclude='. implode(",", $exists_related_ids));
	foreach($myposts as $post) {
	setup_postdata($post);
	?>
	<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="详细阅读 <?php the_title(); ?>"><?php the_title(); ?></a></li>
	<?php
	}
	}
	$post = $tmp_post; setup_postdata($post);
	?></ul>
<div class="cls"></div>
</div>

<?php comments_template( '', true ); ?>
<?php endwhile; // end of the loop. ?>
