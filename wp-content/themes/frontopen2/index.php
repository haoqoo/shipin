<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Front_Open
 * @since Front Open 1.0
 */

get_header(); ?>
<script type="text/javascript">
	$('.loading').animate({'width':'33%'},50);
</script>

     		<div class="main">

			<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			 get_template_part( 'loop', 'index' );
			?>
            <div class="cls"></div>
			</div><!-- #main -->
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
