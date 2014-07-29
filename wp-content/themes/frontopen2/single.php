<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Front_Open
 * @since Front Open 1.0
 */
get_header(); ?>
<script type="text/javascript">loading('33%',<?php echo get_option('themes_fo2_load_speed'); ?>)</script>
  <div id="container">
      <div id="content" role="main" style="width:96%">
      <?php
      /* Run the loop to output the post.
       * If you want to overload this in a child theme then include a file
       * called loop-single.php and that will be used instead.
       */
      get_template_part( 'loop', 'single' );
      ?>
      </div><!-- #content -->
  </div><!-- #container -->
<script type="text/javascript">loading('55%',<?php echo get_option('themes_fo2_load_speed'); ?>)</script>
<?php get_sidebar(); ?>
<script type="text/javascript">loading('78%',<?php echo get_option('themes_fo2_load_speed'); ?>)</script>
<?php get_footer(); ?>
<script type="text/javascript">loading('100%',<?php echo get_option('themes_fo2_load_speed'); ?>)</script>
