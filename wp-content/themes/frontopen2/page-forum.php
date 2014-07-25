<?php
/**
   Template Name: bbs模板
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
<script type="text/javascript">loading('33%',<?php echo get_option('themes_fo2_load_speed'); ?>)</script>
  <div id="container" class="bbs_body">
      <div id="content" role="main">
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>
      </div><!-- #content -->
  </div><!-- #container -->
<script type="text/javascript">loading('55%',<?php echo get_option('themes_fo2_load_speed'); ?>)</script>
<?php get_sidebar(); ?>
<script type="text/javascript">loading('78%',<?php echo get_option('themes_fo2_load_speed'); ?>)</script>
<?php get_footer(); ?>
<script type="text/javascript">loading('100%',<?php echo get_option('themes_fo2_load_speed'); ?>)</script>
