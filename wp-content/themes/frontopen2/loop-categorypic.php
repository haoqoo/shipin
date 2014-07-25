<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
<script type="text/javascript">
	$('.loading').animate({'width':'33%'},50);
</script>

		<div id="container">
			<div id="content" role="main" style="width:96%">

				<h1 class="page-title sucai_php"><?php
					printf( __( '分类归档 - %s', 'frontopne' ), '<span>' . single_cat_title( '', false ) . '</span>' );
				?></h1>
				<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '<div class="archive-meta sucai_php">' . $category_description . '</div>';

				/* Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				 */
				?>
                
<?php if ( ! have_posts() ) : ?>
<div id="post-0" class="post error404 not-found">
<h1 class="entry-title"><?php _e( 'Not Found', 'twentyten' ); ?></h1>
<div class="entry-content">
<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyten' ); ?></p>
<?php get_search_form(); ?>
</div><!-- .entry-content -->
</div><!-- #post-0 -->
<?php else : ?>
<div class="page_box">
<?php global $wp_query;
$cat_ID = get_query_var('cat');?>
<?php query_posts('showposts=20&cat='.$cat_ID); while (have_posts()) : the_post(); ?>
<dl class="post_pic_box">
	<dt><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
	<?php /*if ( has_post_thumbnail() ) { 
			 the_post_thumbnail(array(250,200));} 
			 elseif(catch_that_image()){*/
	?>
    <img src="<?php echo catch_that_image() ?>" />
    <?php /*}*/?>
    </a></dt>
    <dd class="info">TYPE : <?php printf(get_the_category_list( ', ' ) ); ?><span class="time"><?php the_time('Y-m-d') ?></span></dd>
    <dd><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></dd>
</dl>
<?php endwhile ?>
<div class="cls"></div>
</div>
<?php endif; ?>
<div class="page_num">
<?php par_pagenavi(); ?>
</div>



			</div><!-- #content -->
		</div><!-- #container -->
<script type="text/javascript">
$('.loading').animate({'width':'55%'},50);
</script>
<?php get_sidebar(); ?>

<script type="text/javascript">
	$('.loading').animate({'width':'78%'},50);
</script>
<?php get_footer(); ?>
<script type="text/javascript">
	$('.loading').animate({'width':'100%'},50);
</script>
