<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Front_Open
 * @since Front Open 1.0
 */

get_header(); ?>
<script type="text/javascript">
	$('.loading').animate({'width':'33%'},50);
</script>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) : ?>
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'frontopen' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<h2 class="entry-title"><?php _e( 'Nothing Found', 'frontopen' ); ?></h2>
					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'frontopen' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->
<?php endif; ?>
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
