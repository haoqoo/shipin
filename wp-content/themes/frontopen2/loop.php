<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content. See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Front_Open
 * @since Front Open 1.0
 */
?>

<div class="top_box">
<?php 
	if(is_home() && get_option('sticky_posts')){
//	echo '<div class="top_post"><div class="title">置 顶</div><ul class="ulist">';	
    $sticky = get_option('sticky_posts'); 
    rsort( $sticky );//对数组逆向排序，即大ID在前 
    $sticky = array_slice( $sticky, 0, 3);//输出置顶文章数，请修改5，0不要动，如果需要全部置顶文章输出，可以把这句注释掉 
    query_posts( array( 'post__in' => $sticky, 'caller_get_posts' => 1 ) ); 
    if (have_posts()) :while (have_posts()) : the_post();     
?> 
<div class="top_post"><div class="title">置 顶</div><div class="ulist">
<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a> 

<?php $t1=$post->post_date;
	  $t2=date("Y-m-d H:i:s");
	  $diff=(strtotime($t2)-strtotime($t1))/3600;
	  if($diff<24){echo "<span class='title_new'>NEW</span>";} 
	  if(get_option('themes_fo2_view_time') && getPostViews(get_the_ID())){echo "<span class='title_hot'>" . getPostViews(get_the_ID()) . " VIEW</span>";}else{if(get_option('themes_fo2_view_num')){if(getPostViews(get_the_ID()) > get_option('themes_fo2_view_num')){echo " <span class='title_hot'>HOT</span>";};}else{if(getPostViews(get_the_ID()) > 10){echo " <span class='title_hot'>VIEW</span>";}}}
	   ?>

 <span><?php the_time('Y-m-d') ?></span></h2>
</div></div>
<?php  endwhile; endif; wp_reset_query();?> 
<?php /*echo '</ul><div class="cls"></div></div>';*/}?>
</div>




 
<?php $ifpic = get_option('themes_fo2_auto_zhaiyao'); 
	if($ifpic == 'checked'){
	  echo "<style type='text/css'>.c-con img {height: auto !important;width: auto !important}</style>\n";
	}
?>


<?php
  global $query_string;
  query_posts( $query_string . '&ignore_sticky_posts=1' );
?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'frontopen' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'frontopen' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php
	/* Start the Loop.
	 *
	 * In Front Open we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */ ?>
 
<?php while ( have_posts() ) : the_post(); ?>

<?php /* How to display posts of the Gallery format. The gallery category is the old way. */ ?>

	<?php if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) || in_category( _x( 'gallery', 'gallery category slug', 'frontopen' ) ) ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'frontopen' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php frontopen_posted_on(); ?>
			</div><!-- .entry-meta -->

			<div class="entry-content">
<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
<?php else : ?>
				<?php
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>
						<div class="gallery-thumb">
							<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
						</div><!-- .gallery-thumb -->
						<p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'frontopen' ),
								'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'frontopen' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
								number_format_i18n( $total_images )
							); ?></em></p>
				<?php endif; ?>
						<?php the_excerpt(); ?>
<?php endif; ?>
			</div><!-- .entry-content -->

			<div class="entry-utility">
			<?php if ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) : ?>
				<a href="<?php echo get_post_format_link( 'gallery' ); ?>" title="<?php esc_attr_e( 'View Galleries', 'frontopen' ); ?>"><?php _e( 'More Galleries', 'frontopen' ); ?></a>
				<span class="meta-sep">|</span>
			<?php elseif ( in_category( _x( 'gallery', 'gallery category slug', 'frontopen' ) ) ) : ?>
				<a href="<?php echo get_term_link( _x( 'gallery', 'gallery category slug', 'frontopen' ), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'frontopen' ); ?>"><?php _e( 'More Galleries', 'frontopen' ); ?></a>
				<span class="meta-sep">|</span>
			<?php endif; ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'frontopen' ), __( '1 Comment', 'frontopen' ), __( '% Comments', 'frontopen' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'frontopen' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->

<?php /* How to display posts of the Aside format. The asides category is the old way. */ ?>

	<?php elseif ( ( function_exists( 'get_post_format' ) && 'aside' == get_post_format( $post->ID ) ) || in_category( _x( 'asides', 'asides category slug', 'frontopen' ) )  ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'frontopen' ) ); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>

			<div class="entry-utility">
				<?php frontopen_posted_on(); ?>
				<span class="meta-sep">|</span>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'frontopen' ), __( '1 Comment', 'frontopen' ), __( '% Comments', 'frontopen' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'frontopen' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->
        <!--自定义部分-->
<?php /* How to display all other posts. */ ?>
	<?php else : ?>

<div class="post_box" <?php if($ifpic == 'checked'){ echo "style='float:right'" ;}?>>
    <div class="c-top" id="post-<?php the_ID(); ?>">
            <div class="datetime"><?php the_time('Y') ?><br /><?php the_time('m-d') ?></div>	
            <div class="tit">
                <h2 class="h1"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'frontopen' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a> 
                <?php $t1=$post->post_date;
					  $t2=date("Y-m-d H:i:s");
					  $diff=(strtotime($t2)-strtotime($t1))/3600;
					  if($diff<24){echo "<span class='title_new'>NEW</span>";} 
					  if(get_option('themes_fo2_view_time') && getPostViews(get_the_ID())){echo "<span class='title_hot'>" . getPostViews(get_the_ID()) . " VIEW</span>";}else{if(get_option('themes_fo2_view_num')){if(getPostViews(get_the_ID()) > get_option('themes_fo2_view_num')){echo " <span class='title_hot'>HOT</span>";};}else{if(getPostViews(get_the_ID()) > 10){echo " <span class='title_hot'>VIEW</span>";}}}
					   ?>
                      
                      
                </h2>
                <p class="iititle"><span class="i2"><?php the_author_posts_link(); ?></span><span class="i1"><?php printf(get_the_category_list( ', ' ) ); ?></span><span class="i3"><?php comments_popup_link( __( 'Leave a comment', 'frontopen' ), __( '1 Comment', 'frontopen' ), __( '% Comments', 'frontopen' ) ); ?></span></p>
            </div>
    </div>
    <div class="c-con" <?php if($ifpic == 'checked'){ echo "style='height:auto'" ;}?>>
    <a href="<?php the_permalink(); ?>" class="disp_a" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'frontopen' ), the_title_attribute( 'echo=0' ) ); ?>"><?php if($ifpic != 'checked'){ ?>
				<?php if ( has_post_thumbnail() ) { ?>
                <?php the_post_thumbnail('thumbnail');?><?php echo dm_strimwidth(strip_tags($post->post_content),0,150,'....');?>
                <?php } elseif(catch_that_image()){?>
                <?php ?><img src="<?php echo catch_that_image() ?>" /><?php echo dm_strimwidth(strip_tags($post->post_content),0,150,'....'); ?>
                <?php } else {echo dm_strimwidth(strip_tags($post->post_content),0,200,'....');} ?>
     <?php }?>                          
				<?php /*?><?php if($ifpic == 'checked' && catch_that_image()){?> <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'frontopen' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php echo "<img width='100%' src='" . catch_that_image() . "'/></a>"; }?><?php */?>
                <?php if($ifpic == 'checked'){the_content( 'Read More >' , $strip_teaser, $more_file);} ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'frontopen' ), 'after' => '</div>' ) ); ?></a>
                <a href="<?php the_permalink(); ?>" class="more-link"><?php if(get_option('themes_fo2_readmore')){echo get_option('themes_fo2_readmore');}else{echo "Read More >";}?></a>
                <div class="cls"></div>
    </div>
    <div class="c-bot">
        <?php the_tags( __('<span class="cb_bq">','frontopen')); ?>
        </span>
		<?php edit_post_link(); ?>
        
        <div class="cls"></div>
    </div>
</div>
    <!--自定义部分-->
    
		<!-- #post-## -->

		<?php comments_template( '', true ); ?>

	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<div class="cls"></div>
<div class="page_num">
<?php previous_posts_link(); par_pagenavi(); next_posts_link();?>
</div>