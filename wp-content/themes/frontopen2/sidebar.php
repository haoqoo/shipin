<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Front_Open
 * @since Front Open 1.0
 */
//if(!wp_is_mobile()){   //start wp_is_mobile
?>
    <aside id="primary" class="side" role="complementary">
        <ul class="xoxo">
<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll harsd-code in
	 * some default sidebar stuff just in case.
	 */
	if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>

    <li id="search" class="widget-container widget_search">
        <?php get_search_form(); ?>
    </li>

    <li id="archives" class="widget-containefr">
        <h3 class="widget-title"><?php _e( 'Archives', 'frontopen' ); ?></h3>
        <ul>
            <?php wp_get_archives( 'type=monthly' ); ?>
        </ul>
    </li>

    <li id="meta" class="widget-container">
        <h3 class="widget-title"><?php _e( 'Meta', 'frontopen' ); ?></h3>
        <ul>
            <?php wp_register(); ?>
            <li><?php wp_loginout(); ?></li>
            <?php wp_meta(); ?>
        </ul>
    </li>
		<?php endif; // end primary widget area ?>
        </ul>
    </aside><!-- #primary .widget-area -->

<?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>
    <aside id="secondary" class="widget-area" role="complementary">
        <ul class="xoxo">
            <?php dynamic_sidebar( 'secondary-widget-area' ); ?>
        </ul>
    </aside><!-- #secondary .widget-area -->
<?php endif; //}  //end wp_is_mobile?>
