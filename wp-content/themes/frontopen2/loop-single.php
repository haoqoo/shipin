<?php
/**
 * The loop that displays a single post.
 *
 * The loop displays the posts and the post content. See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-single.php.
 *
 * @package WordPress
 * @subpackage Front_Open
 * @since Front Open 1.2
 */
?>
<div class="mbx">
<?php wheatv_breadcrumbs(); ?>
</div>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="c-top2" id="post-55">
                <div class="datetime"><?php the_time('Y') ?><br /><?php the_time('m-d') ?></div>
					<div class="tit"><h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-meta iititle2">
                        <span class="i2"><?php the_author_posts_link(); ?></span><span class="i1"><?php printf(get_the_category_list( ', ' ) ); ?></span><span class="i3"><?php comments_popup_link( __( 'Leave a comment', 'frontopen' ), __( '1 Comment', 'frontopen' ), __( '% Comments', 'frontopen' ) ); ?></span>
					</div>
                    </div>
                    <div class="cls"></div>
		    </div>
                    <!-- .entry-meta -->

					<div class="entry-content">
                    <?php if(get_option('themes_fo2_ad_1')){?>
						<div class="ad_1">
						<?php echo get_option('themes_fo2_ad_1') ?>
                        </div>
					<?php }?>

						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'frontopen' ), 'after' => '</div>' ) ); ?>
                        <?php if(get_option('themes_fo2_fenxiang')){?>
							<div style="height:38px;">
							<?php echo get_option('themes_fo2_fenxiang');?>
							</div>
							<?php }?>
                        <div class="loc_link"><p>&gt;&gt; 本文固定链接: <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_permalink() ?></a></p>
                        <p>&gt;&gt; 转载请注明: <?php the_author_posts_link(); ?> <?php the_time('Y年m月d日') ?> 于 <a href="<?php echo home_url(); ?>/" title="访问<?php bloginfo('name');?>"><?php bloginfo('name');?></a> 发表</p>
                        </div>
                        <div style="display:none"><?php $if_author_ami =  the_author_aim()?></div>
                        <?php if( $if_author_ami || get_option('themes_fo2_zhifu_url')) {?>
                        <div class="j_zeng">
                        	<a href="<?php if(get_option('themes_fo2_author_jz')){the_author_aim();}else{echo get_option('themes_fo2_zhifu_url');} ?>" target="_blank" class="jz_bt" rel="external nofollow">捐  赠</a><span><?php if(get_option('themes_fo2_juankuan')){echo get_option('themes_fo2_juankuan');}else{echo "如果您觉得这篇文章有用处，请支持作者！鼓励作者写出更好更多的文章！";}?></span>
                        </div>
                        <?php }?>
					</div>
                    
                    <!-- .entry-content -->

					<!-- .entry-utility -->
				</div><!-- #post-## -->
<div class="c-bot">
        <?php the_tags( __('<span class="cb_bq">','frontopen')); ?>
        </span>
		<?php edit_post_link(); ?>
        <div class="cls"></div>
    </div>
    <br />
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&lArr;', 'Previous post link', 'frontopen' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rArr;', 'Next post link', 'frontopen' ) . '</span>' ); ?></div>
				</div><!-- #nav-below -->
<div class="cls"></div>
				<?php if(get_option('themes_fo2_ad_2')) {?>
                    <div class="ad_2">
						<?php echo get_option('themes_fo2_ad_2'); ?>
                    </div>
                <?php }?>
                <div class="relatedposts">
<h3 class="widget-title">您可能还会对这些文章感兴趣！</h3>
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
<?php setPostViews(get_the_ID());?>
<?php endwhile; // end of the loop. ?>
