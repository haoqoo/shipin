<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Front_Open
 * @since Front Open 1.0
 */

get_header(); ?>
<script type="text/javascript">loading('33%',<?php echo get_option('themes_fo2_load_speed'); ?>)</script>
<div class="mbx"><i class="icon-home icon-large" style="font-size:14px;"></i>
		<?php wheatv_breadcrumbs();?>
        </div>
  <div id="container">
    <div id="content" role="main">
      <h1 class="page-title"><?php
          printf( __( 'Category Archives: %s', 'frontopen' ), '<span>' . single_cat_title( '', false ) . '</span>' );
      ?></h1>
        <?php
            $category_description = category_description();
            if ( ! empty( $category_description ) )
                echo '<div class="archive-meta">' . $category_description . '</div>';
		?>
		<?php get_template_part('loop'); ?>
    </div><!-- #content -->
  </div><!-- #container -->
<script type="text/javascript">loading('55%',<?php echo get_option('themes_fo2_load_speed'); ?>)</script>
<?php get_sidebar(); ?>
<script type="text/javascript">loading('78%',<?php echo get_option('themes_fo2_load_speed'); ?>)</script>
<?php get_footer(); ?>
<script type="text/javascript">loading('100%',<?php echo get_option('themes_fo2_load_speed'); ?>)</script>
