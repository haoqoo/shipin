<?php
/**
 * The template for displaying Tag Archive pages.
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

				<h1 class="page-title"><?php
					printf( __( 'Tag Archives: %s', 'frontopen' ), '<span>' . single_tag_title( '', false ) . '</span>' );
				?></h1>

<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
 get_template_part( 'loop', 'tag' );
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
