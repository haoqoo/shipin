<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
			<div id="content" role="main" style="width:96%">

			<?php
			/* Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
			get_template_part( 'loop', 'page' );
			?>

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
