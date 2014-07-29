<?php
define('VRESION','1.4.03.30');
ini_set('display_errors', 0);

add_filter( 'pre_option_link_manager_enabled', '__return_true' );//开启友情链接功能

	add_theme_support( 'custom-background', apply_filters( 'twentyfourteen_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );


require_once dirname( __FILE__ ) . '/include/small_tools.php';  //加载小工具

if(get_option('themes_fo2_duan_plus'))include_once('include/shortcode.php');  //短代码兼容
if(get_option('themes_fo2_widget_logic'))include_once('include/widget_logic.php');  //挂载widget_logic

if ( ! isset( $content_width ) )
	$content_width = 640;
	
//关闭部分系统默认的小工具
function unregister_rss_widget(){
unregister_widget('WP_Nav_Menu_Widget');
unregister_widget('WP_Widget_Recent_Comments');
}
add_action('widgets_init','unregister_rss_widget');

//自定义feed替换

if ( !function_exists('custom_feed_footer') )
{
        function custom_feed_footer($content)
        {
                if(is_feed())
                $content .= get_option('themes_fo2_feed_type');
                return $content;
        }
        add_filter('the_excerpt_rss', 'custom_feed_footer');
        add_filter('the_content', 'custom_feed_footer');
}


/** Tell WordPress to run frontopen_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'frontopen_setup' );

if ( ! function_exists( 'frontopen_setup' ) ):

function frontopen_setup() {
	
	//去除冗余代码
	remove_action( 'wp_head',   'feed_links_extra', 3 ); 
    remove_action( 'wp_head',   'rsd_link' ); 
    remove_action( 'wp_head',   'wlwmanifest_link' ); 
    remove_action( 'wp_head',   'index_rel_link' ); 
    remove_action( 'wp_head',   'start_post_rel_link', 10, 0 ); 
    remove_action( 'wp_head',   'wp_generator' ); 
	
	 //隐藏admin Bar
	 
	function hide_admin_bar($flag) {
		return false;
	}
	if(!get_option('themes_fo2_admin_bar'))add_filter('show_admin_bar','hide_admin_bar');


	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	/*add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );//相册形式*/
	
	//if(get_option('themes_fo2_focus'))add_theme_support( 'post-formats', array( 'image' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );//日志形式

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'frontopen', get_template_directory() . '/languages' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'frontopen' ),
	) );
	
	//注册FO小工具
	register_widget('catPostsWidget');
	register_widget('readerWidget');
	register_widget('siteInfoWidget');
	register_widget('frontLoginBlock');
}
endif;

if ( ! function_exists( 'frontopen_admin_header_style' ) ) :

function disable_default_dashboard_widgets() {
	remove_action('formatdiv', 'dashboard', 'core');      //形式
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in frontopen_setup().
 *
 * @since Front Open 1.0
 */
function frontopen_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If header-text was supported, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Front Open 1.0
 */
function frontopen_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'frontopen_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Front Open 1.0
 * @return int
 */
function frontopen_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'frontopen_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Front Open 1.0
 * @return string "Continue Reading" link
 */
function frontopen_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'frontopen' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and frontopen_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Front Open 1.0
 * @return string An ellipsis
 */
function frontopen_auto_excerpt_more( $more ) {
	return ' &hellip;' . frontopen_continue_reading_link();
}
add_filter( 'excerpt_more', 'frontopen_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Front Open 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function frontopen_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= frontopen_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'frontopen_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Front Open's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since Front Open 1.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 *
 * @since Front Open 1.0
 * @deprecated Deprecated in Front Open 1.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function frontopen_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'frontopen_remove_gallery_css' );

if ( ! function_exists( 'frontopen_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own frontopen_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Front Open 1.0
 */

function frontopen_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'frontopen' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'frontopen' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'frontopen' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'frontopen' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'frontopen' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'frontopen' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override frontopen_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Front Open 1.0
 * @uses register_sidebar
 */
function frontopen_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'frontopen' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'frontopen' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

//	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
//	register_sidebar( array(
//		'name' => __( 'Secondary Widget Area', 'frontopen' ),
//		'id' => 'secondary-widget-area',
//		'description' => __( 'The secondary widget area', 'frontopen' ),
//		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
//		'after_widget' => '</li>',
//		'before_title' => '<h3 class="widget-title">',
//		'after_title' => '</h3>',
//	) );
//
//	// Area 3, located in the footer. Empty by default.
//	register_sidebar( array(
//		'name' => __( 'First Footer Widget Area', 'frontopen' ),
//		'id' => 'first-footer-widget-area',
//		'description' => __( 'The first footer widget area', 'frontopen' ),
//		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
//		'after_widget' => '</li>',
//		'before_title' => '<h3 class="widget-title">',
//		'after_title' => '</h3>',
//	) );
//
//	// Area 4, located in the footer. Empty by default.
//	register_sidebar( array(
//		'name' => __( 'Second Footer Widget Area', 'frontopen' ),
//		'id' => 'second-footer-widget-area',
//		'description' => __( 'The second footer widget area', 'frontopen' ),
//		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
//		'after_widget' => '</li>',
//		'before_title' => '<h3 class="widget-title">',
//		'after_title' => '</h3>',
//	) );
//
//	// Area 5, located in the footer. Empty by default.
//	register_sidebar( array(
//		'name' => __( 'Third Footer Widget Area', 'frontopen' ),
//		'id' => 'third-footer-widget-area',
//		'description' => __( 'The third footer widget area', 'frontopen' ),
//		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
//		'after_widget' => '</li>',
//		'before_title' => '<h3 class="widget-title">',
//		'after_title' => '</h3>',
//	) );
//
//	// Area 6, located in the footer. Empty by default.
//	register_sidebar( array(
//		'name' => __( 'Fourth Footer Widget Area', 'frontopen' ),
//		'id' => 'fourth-footer-widget-area',
//		'description' => __( 'The fourth footer widget area', 'frontopen' ),
//		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
//		'after_widget' => '</li>',
//		'before_title' => '<h3 class="widget-title">',
//		'after_title' => '</h3>',
//	) );
}
/** Register sidebars by running frontopen_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'frontopen_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using Front Open 1.2 in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default Front Open styling.
 *
 * @since Front Open 1.0
 */
function frontopen_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'frontopen_remove_recent_comments_style' );

if ( ! function_exists( 'frontopen_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Front Open 1.0
 */
function frontopen_posted_on() {
	printf( __( ' %2$s  %3$s', 'frontopen' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'frontopen' ), get_the_author() ) ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'frontopen_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Front Open 1.0
 */
function frontopen_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'frontopen' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'frontopen' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'frontopen' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

//分页函数
function par_pagenavi($range = 9){ global $paged, $wp_query; if ( !$max_page ) {$max_page = $wp_query->max_num_pages;} if($max_page > 1){if(!$paged){$paged = 1;} if($max_page > $range){ if($paged < $range){for($i = 1; $i <= ($range + 1); $i++) {echo "<a href='" . get_pagenum_link($i) ."'"; if($i==$paged)echo " class='current'";echo ">$i</a>";}} elseif($paged >= ($max_page - ceil(($range/2)))){ for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'"; if($i==$paged)echo " class='current'";echo ">$i</a>";}} elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){ for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++) {echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}} else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'"; if($i==$paged)echo " class='current'";echo ">$i</a>";}}} }  

//面包屑
function wheatv_breadcrumbs() {
  $delimiter = ' > ';
  $name = '首页'; 
 
  if ( !is_home() ||!is_front_page() || is_paged() ) {
 
    global $post;
    $home = home_url();
    echo '<a href="' . $home . '"  class="gray">' . $name . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo single_cat_title();
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '"  class="gray">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '"  class="gray">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo get_the_time('d');
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '"  class="gray">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo get_the_time('F');
 
    } elseif ( is_year() ) {
      echo get_the_time('Y');
 
    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo the_title();
 
    } elseif ( is_page()||!$post->post_parent ) {
      the_title();
 
    } elseif ( is_page()||$post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="admin_url() . get_permalink($page->ID) . "  class="gray">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      the_title();
 
    } elseif ( is_search() ) {
      echo get_search_query();
 
    } elseif ( is_tag() ) {
      echo single_tag_title();
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo '由'.$userdata->display_name.'发表';
 
    } elseif ( is_404() ) {
      echo '404 错误';
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo '第' . ' ' . get_query_var('paged').' 页';
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
  }else{
    echo $name;
  }
}

remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );  


/*下面是新增加部分*/

//自定义后台，移除不需要的widget
function remove_dashboard_widgets(){
  global$wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); 
}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets');


// 设置挂载空间中的输出内容

function example_dashboard_widget_function() {
	// Display whatever it is you want to show
	include dirname( __FILE__ ) . '/admin_board.php';
} 

// 添加挂件

function example_add_dashboard_widgets() {
	wp_add_dashboard_widget('example_dashboard_widget', 'Frontopen主题相关消息', 'example_dashboard_widget_function');	
} 


add_action('wp_dashboard_setup', 'example_add_dashboard_widgets' ); // 挂载example_dashboard_widget


function themeoptions_page()
{
// 设置选项页面的主要功能
	require_once dirname(__FILE__) . "/include/themes_options.php";
}


//通过隐藏的提交数据来判断是否需要运行插入数据库的函数动作
if ( $_POST['update_themeoptions'] == 'true' ) { themeoptions_update(); }

function themeoptions_update()
{
// 数据更新验证

//搜索栏文字
//$options = array(
//	'themes_fo2_search_type' => $_POST['fo2_search_type'],
//	"themes_fo2_search_btn" => $_POST['fo2_search_btn']	
//);

update_option('themes_fo2_search_type', $_POST['fo2_search_type']);
update_option('themes_fo2_search_btn', $_POST['fo2_search_btn']);
if ($_POST['fo2_topbtn_display']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_topbtn_display', $display);
if ($_POST['fo2_search_display']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_search_display', $display);
if ($_POST['fo2_lateload']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_lateload', $display);


//网站标题
update_option('themes_fo2_logo', $_POST['fo2_logo']);
update_option('themes_fo2_small_title', $_POST['fo2_small_title']);
update_option('themes_fo2_logo_img', $_POST['fo2_logo_img']);

//是否禁用RSS按钮
if ($_POST['fo2_btn_rss2']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_btn_rss2', $display);
update_option('themes_fo2_rss_key', $_POST['fo2_rss_key']);

//订阅右侧按钮设置
update_option('themes_fo2_top_right_btn_text', $_POST['fo2_top_right_btn_text']);
update_option('themes_fo2_top_right_btn_url', $_POST['fo2_top_right_btn_url']);
update_option('themes_fo2_top_right_btn_title', $_POST['fo2_top_right_btn_title']);
update_option('themes_fo2_top_right_btn_rel', $_POST['fo2_top_right_btn_rel']);
update_option('themes_fo2_top_right_btn_target', $_POST['fo2_top_right_btn_target']);

//右边栏跟随滚动的模块id
update_option('themes_fo2_sider_roll', $_POST['fo2_sider_roll']);

//view判定值
update_option('themes_fo2_view_num', $_POST['fo2_view_num']);
if ($_POST['fo2_view_time']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_view_time', $display);


//支付宝收款地址
update_option('themes_fo2_zhifu_url', $_POST['fo2_zhifu_url']);
if ($_POST['fo2_author_jz']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_author_jz', $display);

//短代码启用设置
if ($_POST['fo2_duan_plus']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_duan_plus', $display);
if ($_POST['fo2_TimThumb']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_TimThumb', $display);

//widget_logic禁用设置
if ($_POST['fo2_widget_logic']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_widget_logic', $display);

//admin_bar启用设置
if ($_POST['fo2_admin_bar']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_admin_bar', $display);

//移动设备响应开关
if ($_POST['fo2_mobile']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_mobile', $display);

//摘要链接禁用设置
if ($_POST['fo2_dis_href']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_dis_href', $display);

//首行缩进
if ($_POST['fo2_page_suo']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_page_suo', $display);


//是否开启页面加载耗时
if ($_POST['fo2_load_time']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_load_time', $display);

//禁用自动摘要功能
if ($_POST['fo2_auto_zhaiyao']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_auto_zhaiyao', $display);
update_option('themes_fo2_page_width', $_POST['fo2_page_width']);
update_option('themes_fo2_dis_num', $_POST['fo2_dis_num']);

//标签云设置
update_option('themes_fo2_tag_num', $_POST['fo2_tag_num']);


//自定义信息
update_option('themes_fo2_readmore', $_POST['fo2_readmore']);
update_option('themes_fo2_juankuan', $_POST['fo2_juankuan']);
update_option('themes_fo2_zhuanzai', stripslashes($_POST['fo2_zhuanzai']));
update_option('themes_fo2_feed_type', stripslashes($_POST['fo2_feed_type']));
update_option('themes_fo2_fenxiang', stripslashes($_POST['fo2_fenxiang']));
update_option('themes_fo2_image_height', $_POST['fo2_image_height']);
update_option('themes_fo2_image_width', $_POST['fo2_image_width']);
update_option('themes_fo2_con_height', $_POST['fo2_con_height']);



//主题特效参数设置
if(!$_POST['fo2_load_speed']){$load_speed = 1000;}else{$load_speed = $_POST['fo2_load_speed'];}
update_option('themes_fo2_load_speed', $load_speed);
update_option('themes_fo2_not_category',($_POST['fo2_not_category']));


//广告位代码管理
update_option('themes_fo2_ad_1', stripslashes($_POST['fo2_ad_1']));
update_option('themes_fo2_ad_2', stripslashes($_POST['fo2_ad_2']));
update_option('themes_fo2_mobile_ad_2', stripslashes($_POST['fo2_mobile_ad_2']));


//网站底部信息
update_option('themes_fo2_icp', $_POST['fo2_icp']);
update_option('themes_fo2_copyright', stripslashes($_POST['fo2_copyright']));
update_option('themes_fo2_sitemap', $_POST['fo2_sitemap']);
update_option('themes_fo2_tongji', stripslashes($_POST['fo2_tongji']));

//主题版权信息链接开关
if ($_POST['fo2_banquan']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_banquan', $display);

//SEO三标签
if ($_POST['fo2_seo_on']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_seo_on', $display);

update_option('themes_fo2_seo_ht', $_POST['fo2_seo_ht']);
update_option('themes_fo2_seo_hk', $_POST['fo2_seo_hk']);
update_option('themes_fo2_seo_hd', $_POST['fo2_seo_hd']);

//自定义css
update_option('themes_fo2_css', stripslashes($_POST['fo2_css']));

//启用幻灯片
if ($_POST['fo2_focus']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_focus', $display);
}


//通过隐藏的提交数据来判断是否需要运行插入数据库的函数动作
if ( $_POST['update_themeoptions_btn'] == 'true' ) { themeoptions_update_btn(); }

function themeoptions_update_btn()
{
// 数据更新验证
	$num = get_option('themes_fo2_btn_num');
	for($i=1; $i<=$num; $i++){
		update_option('themes_fo2_top_btn' . $i . '_img', $_POST['fo2_top_btn' . $i . '_img']);
		update_option('themes_fo2_top_btn' . $i . '_url', $_POST['fo2_top_btn' . $i . '_url']);
		update_option('themes_fo2_top_btn' . $i . '_text', $_POST['fo2_top_btn' . $i . '_text']);
		update_option('themes_fo2_top_btn' . $i . '_title', $_POST['fo2_top_btn' . $i . '_title']);
		update_option('themes_fo2_top_btn' . $i . '_rel', $_POST['fo2_top_btn' . $i . '_rel']);
		update_option('themes_fo2_top_btn' . $i . '_target', $_POST['fo2_top_btn' . $i . '_target']);
		if ($_POST['fo2_top_btn' . $i . '_display']=='on') { $display1 = "checked"; } else { $display1 = ""; }
		update_option('themes_fo2_top_btn' . $i . '_display', $display1);
	}
	update_option('themes_fo2_btn_num', $_POST['fo2_btn_num']);

}

function themeoptions_page_btn()
{
// 设置选项页面的主要功能
	require_once dirname(__FILE__) . "/include/themes_nav.php";
}


//站点公告的插入函数
if ( $_POST['update_themeoptions_ac'] == 'true' ) { themeoptions_update_ac(); }

function themeoptions_update_ac()
{
// 数据更新验证
	$num = get_option('themes_fo2_ac_num');
	for($i=1; $i<=$num; $i++){
		update_option('themes_fo2_top_ac' . $i . '_text', stripslashes($_POST['fo2_top_ac' . $i . '_text']));
		if ($_POST['fo2_top_ac' . $i . '_display']=='on') { $display1 = "checked"; } else { $display1 = ""; }
		update_option('themes_fo2_top_ac' . $i . '_display', $display1);
	}
	update_option('themes_fo2_ac_num', $_POST['fo2_ac_num']);

}

//调色板的插入函数
if ( $_POST['update_themeoptions_color'] == 'true' ) { themeoptions_update_color(); }

function themeoptions_update_color()
{
	update_option('themes_fo2_colbg', $_POST['fo2_colbg']);

	for($i=1; $i<=10; $i++){
		update_option('themes_fo2_col' . $i . '', $_POST['fo2_col' . $i . '']);
	}
	for($n=1; $n<=6; $n++){
		update_option('themes_fo2_colnav' . $n . '', $_POST['fo2_colnav' . $n . '']);
	}
}



//自动摘要函数
function dm_strimwidth($str ,$start , $width ,$trimmarker ){
    $output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start.'}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$width.'}).*/s','\1',$str);
    return $output.$trimmarker;
}


//截取第一长图片函数
function catch_that_image() { 
 global $post, $posts; 
 $first_img = ''; 
 ob_start(); 
 ob_end_clean(); 
 $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches); 
 $first_img = $matches [1] [0]; 
if(empty($first_img)){  
 $first_img = ''; 
 } 
 return $first_img; 
 }  
 //end
 
//timthumb缩略图函数
function post_thumbnail( $width,$height,$dataSrc){
    global $post;
	$blogUrl = 'http://'.$_SERVER['HTTP_HOST'];
	$isTimThumb = get_option('themes_fo2_TimThumb');
	$first_img_src = catch_that_image();
	$timthumbFlod = str_replace($blogUrl,'',get_bloginfo("template_url"));;
    if( has_post_thumbnail() ){    //如果有缩略图，则显示缩略图
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$timthumb_src = str_replace($blogUrl,'',$timthumb_src[0]);
		if(isset($dataSrc)){
        	if(!$isTimThumb){
				$post_timthumb = '<img '.$dataSrc.'="'.$timthumbFlod.'/timthumb.php?src='.$timthumb_src.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" />';}
				else{
				$post_timthumb = '<img '.$dataSrc.'="'.$timthumb_src.'" height="'.$height.'" width="'.$width.'" alt="'.$post->post_title.'" />';
			}
		}else{
			if(!$isTimThumb){
        $post_timthumb = '<img src='.$timthumbFlod.'/timthumb.php?src='.$timthumb_src.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" />';
			}else{
        $post_timthumb = '<img src="'.$timthumb_src.'" height="'.$height.'" width="'.$width.'" alt="'.$post->post_title.'" />';
			}
		}
		if(isset($timthumb_src{5})){
        echo $post_timthumb;
		}
    } else {
		$first_img_src = str_replace($blogUrl,'',$first_img_src);
        if( !empty($first_img_src) ){    //如果日志中有图片
			if(isset($dataSrc)){
				if(!$isTimThumb){
     		       $post_timthumb = '<img '.$dataSrc.'="'.$timthumbFlod.'/timthumb.php?src='.$first_img_src.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" />';
				}else{
           			$post_timthumb = '<img '.$dataSrc.'="'.$first_img_src.'" height="'.$height.'" width="'.$width.'" alt="'.$post->post_title.'" />';
				}
			}else{
				if(!$isTimThumb){
          			$post_timthumb = '<img src="'.$timthumbFlod.'/timthumb.php?src='.$first_img_src.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" />';
				}else{
            		$post_timthumb = '<img src="'.$first_img_src.'" height="'.$height.'" width="'.$width.'" alt="'.$post->post_title.'" />';
				}
			}
        } else {    //如果日志中没有图片，则显示默认
			if(isset($dataSrc)){
            $post_timthumb = '<img '.$dataSrc.'="'.get_bloginfo("template_url").'/images/default_thumb.gif" alt="'.$post->post_title.'" />';
			}else{
            $post_timthumb = '<img src="'.get_bloginfo("template_url").'/images/default_thumb.gif" alt="'.$post->post_title.'" />';
			}
        }
        echo $post_timthumb;
    }
} 


//懒人加载开关
function lateLoad($tag){
	if(!get_option('themes_fo2_lateload')){
		return $tag;
	}
}
 
//统计浏览次数 post_views_count
function getPostViews($postID){
  $count_key = 'post_views_count';
  $count = get_post_meta($postID, $count_key, true);
  if($count==''){
	  delete_post_meta($postID, $count_key);
	  add_post_meta($postID, $count_key, '0');
	  return 0;
  }
  return $count;
}

function setPostViews($postID) {
  $count_key = 'post_views_count';
  $focount = get_post_meta($postID, $count_key, true);
  $other = get_post_meta($postID, 'views', true);
  $count = max($focount,$other);
  if($count==''){
	  $count = 0;
	  delete_post_meta($postID, $count_key);
	  add_post_meta($postID, $count_key, '0');
  }else{
	  $count++;
	  update_post_meta($postID, $count_key, $count);
  }
}





//图片上传类
class upphoto{  
 public $previewsize=0.125  ;   //预览图片比例  
 public $preview=0;   //是否生成预览，是为1，否为0 
    public $datetime;   //随机数  
    public $ph_name;   //上传图片文件名  
   public $ph_tmp_name;    //图片临时文件名  
//    public $ph_path="../userimg/";    //上传文件存放路径  
  public $ph_path;    //上传文件存放路径  
 public $ph_type;   //图片类型  
    public $ph_size;   //图片大小  
    public $imgsize;   //上传图片尺寸，用于判断显示比例  
    public $al_ph_type=array('image/jpg','image/jpeg','image/png','image/pjpeg','image/gif','image/bmp','image/x-png','image/x-icon');    //允许上传图片类型  
    public $al_ph_size=2000000;   //允许上传文件大小  
  function __construct(){  
    $this->set_datatime();  
  }  
  function set_datatime(){  
   $this->datetime=date("YmdHis");  
  }  
   //获取文件类型  
  function get_ph_type($phtype){  
     $this->ph_type=$phtype;  
  }  
  //获取文件大小  
  function get_ph_size($phsize){  
     $this->ph_size=$phsize."<br>";  
  }  
  //获取上传临时文件名  
  function get_ph_tmpname($tmp_name){  
    $this->ph_tmp_name=$tmp_name;  
    $this->imgsize=getimagesize($tmp_name);  
  }  
  //获取原文件名  
  function get_ph_name($phname){  
    $this->ph_name=$this->ph_path.$this->ph_name; //strrchr获取文件的点最后一次出现的位置  
 //$this->ph_name=$this->datetime.strrchr($phname,"."); //strrchr获取文件的点最后一次出现的位置  
 return $this->ph_name;  
 }  
 //判断上传文件存放目录  
  function check_path(){  
    if(!file_exists($this->ph_path)){  
    mkdir($this->ph_path);  
   }  
  }  
  //判断上传文件是否超过允许大小  
  function check_size(){  
    if($this->ph_size>$this->al_ph_size){  
     $this->showerror("上传图片超过2000KB");  
    }  
  }  
  //判断文件类型  
  function check_type(){  
   if(!in_array($this->ph_type,$this->al_ph_type)){  
         $this->showerror("上传图片类型错误");  
   }  
  }  
  //上传图片  
   function up_photo(){  
   if(!move_uploaded_file($this->ph_tmp_name,$this->ph_name)){  
    $this->showerror("上传文件出错");  
   }  
  }  
  //图片预览  
   function showphoto(){  
     if($this->preview==1){  
      if($this->imgsize[0]>2000){  
        $this->imgsize[0]=$this->imgsize[0]*$this->previewsize;  
             $this->imgsize[1]=$this->imgsize[1]*$this->previewsize;  
      }  
         echo("<img src=\"{$this->ph_name}\" width=\"{$this->imgsize['0']}\" height=\"{$this->imgsize['1']}\">");  
     }  
   }  
  //错误提示  
  function showerror($errorstr){  
    echo "<script language=javascript>alert('$errorstr');location='javascript:history.go(-1);';</script>";  
   exit();  
  }  
  function save(){  
   $this->check_path();  
   $this->check_size();  
   $this->check_type();  
   $this->up_photo();  
   $this->showphoto();  
  }  
}  

//读者墙
function zsofa_most_active_friends($friends_num = 10) {
    global $wpdb;
    $counts = $wpdb->get_results("SELECT COUNT(comment_author) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 1 MONTH ) AND user_id='0' AND comment_author != 'zwwooooo' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author ORDER BY cnt DESC LIMIT $friends_num");
    foreach ($counts as $count) {
    $c_url = $count->comment_author_url;
    if ($c_url == '') $c_url = get_bloginfo('url');
    $mostactive .= '<li class="read_li">' . '<a href="'. $c_url . '" title="' . $count->comment_author . ' ('. $count->cnt . '条评论)">' . get_avatar($count->comment_author_email, 32) . '</a></li>';
    }
    return $mostactive;
}

//日志归档
	class hacklog_archives
{
	function GetPosts() 
	{
		global  $wpdb;
		if ( $posts = wp_cache_get( 'posts', 'ihacklog-clean-archives' ) )
			return $posts;
		$query="SELECT DISTINCT ID,post_date,post_date_gmt,comment_count,comment_status,post_password FROM $wpdb->posts WHERE post_type='post' AND post_status = 'publish' AND comment_status = 'open'";
		$rawposts =$wpdb->get_results( $query, OBJECT );
		foreach( $rawposts as $key => $post ) {
			$posts[ mysql2date( 'Y.m', $post->post_date ) ][] = $post;
			$rawposts[$key] = null; 
		}
		$rawposts = null;
		wp_cache_set( 'posts', $posts, 'ihacklog-clean-archives' );;
		return $posts;
	}
	function PostList( $atts = array() ) 
	{
		global $wp_locale;
		global $hacklog_clean_archives_config;
		$atts = shortcode_atts(array(
			'usejs'        => $hacklog_clean_archives_config['usejs'],
			'monthorder'   => $hacklog_clean_archives_config['monthorder'],
			'postorder'    => $hacklog_clean_archives_config['postorder'],
			'postcount'    => '1',
			'commentcount' => '1',
		), $atts);
		$atts=array_merge(array('usejs'=>1,'monthorder'   =>'new','postorder'    =>'new'),$atts);
		$posts = $this->GetPosts();
		( 'new' == $atts['monthorder'] ) ? krsort( $posts ) : ksort( $posts );
		foreach( $posts as $key => $month ) {
			$sorter = array();
			foreach ( $month as $post )
				$sorter[] = $post->post_date_gmt;
			$sortorder = ( 'new' == $atts['postorder'] ) ? SORT_DESC : SORT_ASC;
			array_multisort( $sorter, $sortorder, $month );
			$posts[$key] = $month;
			unset($month);
		}
		$html = '<div class="car-container';
		if ( 1 == $atts['usejs'] ) $html .= ' car-collapse';
		$html .= '">'. "\n";
		if ( 1 == $atts['usejs'] ) $html .= '<a href="#" class="car-toggler">折叠所有月份'."</a>\n\n";
		$html .= '<ul class="car-list">' . "\n";
		$firstmonth = TRUE;
		foreach( $posts as $yearmonth => $posts ) {
			list( $year, $month ) = explode( '.', $yearmonth );
			$firstpost = TRUE;
			foreach( $posts as $post ) {
				if ( TRUE == $firstpost ) {
                    $spchar = $firstmonth ? '<span class="car-toggle-icon car-minus">-</span>' : '<span class="car-toggle-icon car-plus">-</span>'; //the tow is +
					$html .= '	<li><span class="car-yearmonth" style="cursor:pointer;">'.$spchar.' ' . sprintf( __('%1$s %2$d'), $wp_locale->get_month($month), $year );
					if ( '0' != $atts['postcount'] ) 
					{
						$html .= ' <span title="文章数量">(共' . count($posts) . '篇文章)</span>';
					}
                    if ($firstmonth == FALSE) {
					$html .= "</span>\n		<ul class='car-monthlisting'>\n";  //style='display:none;'
                    } else {
                    $html .= "</span>\n		<ul class='car-monthlisting'>\n";
                    }
					$firstpost = FALSE;
                     $firstmonth = FALSE;
				}
				$html .= '			<li>' .  mysql2date( 'd', $post->post_date ) . '日: <a target="_blank" href="' . get_permalink( $post->ID ) . '">' . get_the_title( $post->ID ) . '</a>';
				if ( '0' != $atts['commentcount'] && ( 0 != $post->comment_count || 'closed' != $post->comment_status ) && empty($post->post_password) )
					$html .= ' <span title="评论数量">(' . $post->comment_count . '条评论)</span>';
				$html .= "</li>\n";
			}
			$html .= "		</ul>\n	</li>\n";
		}
		$html .= "</ul>\n</div>\n";
		return $html;
	}
	function PostCount() 
	{
		$num_posts = wp_count_posts( 'post' );
		return number_format_i18n( $num_posts->publish );
	}
}
if(!empty($post->post_content))
{
	$all_config=explode(';',$post->post_content);
	foreach($all_config as $item)
	{
		$temp=explode('=',$item);
		$hacklog_clean_archives_config[trim($temp[0])]=htmlspecialchars(strip_tags(trim($temp[1])));
	}
}
else
{
	$hacklog_clean_archives_config=array('usejs'=>1,'monthorder'   =>'new','postorder'    =>'new');	
}
$hacklog_archives=new hacklog_archives();

//自定义用户资料
add_filter('user_contactmethods','custom_contactmethods');
function custom_contactmethods($user_contactmethods ){
    $user_contactmethods  = array(
	  'aim' => __( '支付宝收款地址' ),
	  'addres' => __( '所在地' ),
	  'job' => __( '职业' ),
	  'qq' => __( 'QQ' ),
	  'touxiang' => __( '头像url' ),
	  'tengxunweibo' => __( '腾讯微博' ),
	  'sinaweibo' => __( '新浪微博' ),
	  'juanzeng' => __( '捐赠宣言' )
    );
    return $user_contactmethods ;
}

//标签云滤镜
add_filter( 'widget_tag_cloud_args', 'theme_tag_cloud_args' );
function theme_tag_cloud_args( $args ){
if(get_option('themes_fo2_tag_num')){$tagNum = get_option('themes_fo2_tag_num');}else{$tagNum = 45;}
$newargs = array(
'smallest'    => 14,  //最小字号
'largest'     => 14, //最大字号
'unit'        => 'px',   //字号单位，可以是pt、px、em或%
'number'      => $tagNum,     //显示个数
'format'      => 'flat',//列表格式，可以是flat、list或array
'separator'   => "\n",   //分隔每一项的分隔符
'orderby'     => 'count',//排序字段，可以是name或count
'order'       => 'DESC', //升序或降序，ASC或DESC
'exclude'     => null,   //结果中排除某些标签
'include'     => null,  //结果中只包含这些标签
'link'        => 'view', //taxonomy链接，view或edit
'taxonomy'    => 'post_tag', //调用哪些分类法作为标签云
);
$return = array_merge( $args, $newargs);
return $return;
}

//标签tag所包含的文章数量
function Tagno($text) {
$text = preg_replace_callback('|<a (.+?)</a>|i', 'tagnoCallback', $text);
return $text;
}
function tagnoCallback($matches) {
$text=$matches[1];
preg_match('|title=(.+?)style|i',$text ,$a);
preg_match("/\d+/",$a[1],$a);
return "<a ".$text ." (".$a[0].")</a> ";
}
add_filter('wp_tag_cloud', 'Tagno', 1);



//文章索引目录功能
function article_index($content) {
   $matches = array();
   $ul_li = '';
   $r = "/<cite>([^<]+)<\/cite>/im";

   if(preg_match_all($r, $content, $matches)) {
       foreach($matches[1] as $num => $title) {
           $content = str_replace($matches[0][$num], '<cite id="title-'.$num.'">'.$title.'</cite>', $content);
           $ul_li .= '<li><a href="#title-'.$num.'" title="跳转段落至 - '.$title.'">'.$title."</a></li>\n";
       }
       if(is_single()){$content = "\n<div id=\"article-index\">
               <p class=\"title_lt\"><a href=\"javascript:void(0)\" class=\"gotop\" onclick=\"goRoll(0,300)\">BACK TOP</a>文章索引</p>
               <ul id=\"index-ul\">\n" . $ul_li . "<li><a href=\"#comments\" title=\"查看本文评论\">共".get_post($id)->comment_count."条评论</a></li></ul>
           </div>\n" . $content;}
   }
   return $content;
}
add_filter( "the_content", "article_index" );


// 增加文章编辑器按钮
function appthemes_add_quicktags() {
?> 
<script type="text/javascript"> 
QTags.addButton( '添加索引', '添加索引', '<cite>', '</cite>' ); //快捷输入h3标签 
QTags.addButton( '文章分页', '文章分页', '<!--nextpage-->', '' ); //快捷输入h3标签 
</script>
<?php
}
add_action('admin_print_footer_scripts', 'appthemes_add_quicktags' );


//首页屏蔽分类
if(get_option('themes_fo2_not_category')){
	function exclude_category_home( $query ) {
	if ($query->is_home) {//判断是否首页
	$query->set( 'cat', get_option('themes_fo2_not_category') );
	//屏蔽指定分类ID，有其他要屏蔽的用英文逗号分隔，并在ID前加"-"号
	}
	return $query;
	}
	add_filter( 'pre_get_posts', 'exclude_category_home' );
}

//调用所有的分类id
function show_category_id() {
	global $wpdb;
	$request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
	$request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
	$request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
	$request .= " ORDER BY term_id asc";
	$categorys = $wpdb->get_results($request);
	foreach ($categorys as $category) { //调用菜单
		$output = $category->term_id.',';
		$category_id .= $output;
	};
	return $category_id;
}

//lightbox 自动对图片链接添加rel=lightbox属性
add_filter('the_content', 'pirobox_gall_replace');
function pirobox_gall_replace ($content)
{ global $post;
$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)><img(.*?)src=(.*?)><\/a>/i";
if(!is_feed()){$replacement = '<a$1href=$2$3.$4$5 data-lightbox="image_lg"$6><img $7 '.lateLoad('data-').'src=$8></a>';
}else{$replacement = '<a$1href=$2$3.$4$5><img $7 src=$8></a>';
}
$content = preg_replace($pattern, $replacement, $content);
return $content;
}

//菜单回调函数
function Bing_nav_fallback(){
	echo '<div class="menu-header"><ul><li>'.__( '<a href="/wp-admin/nav-menus.php?action=locations">请在 "后台 - 外观 -菜单" 设置导航菜单</a>','Bing' ).'</ul></li></div>';
}


function frontopen_admin_menu()
{	
	add_menu_page('FO主题控制台', 'FO控制台', 'administrator', 'theme_config' ,'themeoptions_page', '' . get_bloginfo('template_url') .'/images/fo_tm.png', 59);
    add_submenu_page('theme_config','头部导航按钮设置','导航按钮','administrator','themes_btn','themeoptions_page_btn');
    add_submenu_page('theme_config','站点公告设置','站点公告','administrator','themes_ac','themeoptions_page_ac');
    add_submenu_page('theme_config','主题调色板','调色板','administrator','themes_color','themeoptions_page_color');
	add_submenu_page('theme_config','FO主题更新工具','主题更新','administrator','themes_get','themeoptions_page_get');
}

//载入公告设置页面函数
function themeoptions_page_ac()
{
	require_once dirname(__FILE__) . "/include/themes_ac.php";
}

//载入调色板
function themeoptions_page_color()
{
	require_once dirname(__FILE__) . "/include/themes_color.php";
}

//载入更新程序
function themeoptions_page_get()
{
	require_once dirname(__FILE__) . "/include/themes_get.php";
}


add_action('admin_menu','frontopen_admin_menu');

//定义登陆logo
if(get_option('themes_fo2_logo_img')){
function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_bloginfo('url').''.get_option('themes_fo2_logo_img').') !important; background-size:320px auto !important; width:320px !important;}
    </style>';
}
add_action('login_head', 'my_custom_login_logo');
}
add_filter('login_headerurl', create_function(false,"return get_bloginfo('url');"));


if(get_option('themes_fo2_seo_on')){
	//关键字
	function page_keywords() {
	  global $s, $post;
	  $keywords = '';
	  if ( is_single() ) {
		if ( get_the_tags( $post->ID ) ) {
		  foreach ( get_the_tags( $post->ID ) as $tag ) $keywords .= $tag->name . ', ';
		}
		//foreach ( get_the_category( $post->ID ) as $category ) $keywords .= $category->cat_name . ', ';
		//$keywords = substr_replace( $keywords , '' , -2);
	  } elseif ( is_home () )    { $keywords = get_option('themes_fo2_seo_hk');
	  } elseif ( is_tag() )      { $keywords = single_tag_title('', false);
	  } elseif ( is_category() ) { $keywords = single_cat_title('', false);
	  } elseif ( is_search() )   { $keywords = esc_html( $s, 1 );
	  } else { $keywords = trim( wp_title('', false) );
	  }
	  if ( $keywords ) {
		echo "<meta name=\"keywords\" content=\"$keywords\">\n";
	  }
	}
	
	add_action('wp_head','page_keywords');   
	
	
	//网站描述
	function page_description() {
	  global $s, $post;
	  $description = '';
	  $blog_name = get_bloginfo('name');
	  if ( is_singular() ) {
		if( !empty( $post->post_excerpt ) ) {
		  $text = $post->post_excerpt;
		} else {
		  $text = $post->post_content;
		}
		$description = trim( str_replace( array( "\r\n", "\r", "\n", "　", " "), " ", str_replace( "\"", "'", strip_tags( $text ) ) ) );
		if ( !( $description ) ) $description = $blog_name . "-" . trim( wp_title('', false) );
	  } elseif ( is_home () )    { $description = get_option('themes_fo2_seo_hd');
	  } elseif ( is_tag() )      { $description = $blog_name . "'" . single_tag_title('', false) . "'";
	  } elseif ( is_category() ) { $description = $blog_name . "'" . single_cat_title('', false) . "'";
	  } elseif ( is_archive() )  { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
	  } elseif ( is_search() )   { $description = $blog_name . ": '" . esc_html( $s, 1 ) . "' 的搜索結果";
	  } else { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
	  }
	  $description = mb_substr( $description, 0, 220, 'utf-8' );
	  echo "<meta name=\"description\" content=\"$description\">\n";
	}
	 
	add_action('wp_head','page_description');   
}

//最近浏览文章
/* 可选参数: */
$zg_cookie_expire = 360; // cookie过期时间，默认值是360天
$zg_number_of_posts = 5; // 显示篇数，默认值是10。
$zg_recognize_pages = true;
/* 此行后不要编辑 */
function zg_lwp_header() {
if (is_single()) {
zg_lw_setcookie();
} elseif (is_page()) {
global$zg_recognize_pages;
if ($zg_recognize_pages === true) {
zg_lw_setcookie();
}
}
}
function zg_lw_setcookie() {
global$wp_query;
$zg_post_ID = $wp_query->post->ID;
if (! isset($_COOKIE["WP-LastViewedPosts"])) {
$zg_cookiearray = array($zg_post_ID);
} else {
$zg_cookiearray = unserialize(preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", stripslashes($_COOKIE["WP-LastViewedPosts"])));
if (! is_array($zg_cookiearray)) {
$zg_cookiearray = array($zg_post_ID);
}
}
if (in_array($zg_post_ID, $zg_cookiearray)) {
$zg_key = array_search($zg_post_ID, $zg_cookiearray);
array_splice($zg_cookiearray, $zg_key, 1);
}
array_unshift($zg_cookiearray, $zg_post_ID);
global$zg_number_of_posts;
while (count($zg_cookiearray) > $zg_number_of_posts) {
array_pop($zg_cookiearray);
}
$zg_blog_url_array = parse_url(get_bloginfo('url'));
$zg_blog_url = $zg_blog_url_array['host'];
$zg_blog_url = str_replace('www.', '', $zg_blog_url);
$zg_blog_url_dot = '.';
$zg_blog_url_dot .= $zg_blog_url;
$zg_path_url = $zg_blog_url_array['path'];
$zg_path_url_slash = '/';
$zg_path_url .= $zg_path_url_slash;
global$zg_cookie_expire;
setcookie("WP-LastViewedPosts", serialize($zg_cookiearray), (time()+($zg_cookie_expire*86400)), $zg_path_url, $zg_blog_url_dot, 0);
}
function zg_recently_viewed() {
echo '<ul class="viewed_posts">';
if (isset($_COOKIE["WP-LastViewedPosts"])) {
$zg_post_IDs = unserialize(preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", stripslashes($_COOKIE["WP-LastViewedPosts"])));
foreach ($zg_post_IDs as $value) {
global$wpdb;
$zg_get_title = $wpdb->get_results("SELECT post_title FROM $wpdb->posts WHERE ID = '$value+0' LIMIT 1");
foreach($zg_get_title as $zg_title_out) {
echo"<li><a href=\"". get_permalink($value+0) . "\" title=\"". $zg_title_out->post_title . "\">". $zg_title_out->post_title . "</a></li>\n";
}
}
} else {
}
echo '</ul>';
}
add_action('get_header','zg_lwp_header');


//为文章添加字段
add_action( 'add_meta_boxes', 'fo_add_custom_box' );
add_action( 'save_post', 'fo_save_postdata' );

function fo_add_custom_box() {
  add_meta_box(
    'fo_sectionid',
    '[FO] 扩展设置', // 可自行修改标题文字
    'fo_inner_custom_box',
    'post'
  );
}
//add_action( 'load-themes.php', 'my_table_install' );   //主题激活时插入新的字段

function fo_inner_custom_box( $post ) {
  global $wpdb;
   
  wp_nonce_field( plugin_basename( __FILE__ ), 'fo_noncename' );
  
  $flag = getNewKeys($post->ID,'flag');
  $flashPic = getNewKeys($post->ID,'flashPic');
  
  echo '
  <script type="text/javascript">
  TB_Height = window.screen.height * 0.7;
function TB_on(inputKey) {		
	window.send_to_editor = function(html) 		
	{
		imgurl = jQuery(\'img\',html).attr(\'src\');
		jQuery(\'#\'+inputKey).val(imgurl);
		tb_remove();
	}	 
	tb_show(\'\', \'media-upload.php?type=image&amp;TB_iframe=true&width=670&height=\'+TB_Height);
	return false;		
};
jQuery(function($){
	$("#flag-1").click(function(){
		$(".flash_con_box").show(300);
	})
	
	$("#flag-0").click(function(){
		$(".flash_con_box").hide(300);
	})
	
	var fis = setInterval(flashImgShow,1000)
	function flashImgShow(){
		var src = $("#flashPic_new_field").val();
		$("#flash_image").attr("src",src)
	}
});
</script>';

		//推送类型框架
  echo '<p>设置为：';
  echo '<input type="radio" name="flag_new_field" class="post-format" id="flag-0" value="." '.is_radio_flag('',$flag).'>
  		<label for="flag-0" class="post-format-standard">默认</label> 
		<input type="radio" name="flag_new_field" class="post-format" id="flag-1" value="f" '.is_radio_flag('f',$flag).'> 		
		<label for="flag-1" class="post-format-standard">幻灯</label></p>';
		
		//幻灯缩略图框架开始
  if(is_radio_flag('f',$flag)){ echo '<div class="flash_con_box">';}else{ echo '<div class="flash_con_box" style="display:none;">';}
  echo '<p><label for="description_new_field">幻灯图片：</label> ';
  echo '<input type="text" id="flashPic_new_field" name="flashPic_new_field" value="'.$flashPic.'" size="28" /><input type="button" value="调用图像" class="button-secondary" onclick="TB_on(\'flashPic_new_field\')"><br/></p><img id="flash_image" width="254" src="'.$flashPic.'"/></div>';//幻灯缩略图框架结束
  		
}

//flag选中判断处理函数
function is_radio_flag($flag,$getVal){
	if($getVal == $flag) return 'checked="checked"';
}


/* 文章提交更新后，保存固定字段的值 */
function fo_save_postdata( $post_id ) {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;

  if ( !wp_verify_nonce( $_POST['fo_noncename'], plugin_basename( __FILE__ ) ) )
      return;
 
  // 权限验证
  if ( 'post' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }
  // 获取编写文章时填写的固定字段的值，多个字段依此类推
  $blogUrl = 'http://'.$_SERVER['HTTP_HOST'];
  
  $flag = $_POST['flag_new_field'];
  $flashPic = str_replace($blogUrl,'',$_POST['flashPic_new_field']);
  setNewKeys($post_id,'flag',$flag);
  setNewKeys($post_id,'flashPic',$flashPic);
}


//创建数据表的函数
//function my_table_install () {   
//    global $wpdb;
//    $table_name = $wpdb->prefix . "posts";
//    if($wpdb->get_var("show tables like $table_name") != $table_name) {
//        $sql = "CREATE TABLE " . $table_name . " (
//		  flag VARCHAR(55) NOT NULL,
//		  flashPic VARCHAR(255) NOT NULL
//          );";
//    
//        require_once(ABSPATH . "wp-admin/includes/upgrade.php");
// 
//        dbDelta($sql);
//    }
//}


function getNewKeys($postID,$count_key){
  $count = get_post_meta($postID, $count_key, true);
  if($count ==''){
	  delete_post_meta($postID, $count_key);
	  add_post_meta($postID, $count_key, '.');
	  return '';
  }
  return $count;
}

function setNewKeys($postID,$count_key,$countinput) {
  $count = get_post_meta($postID, $count_key, true);
  if($count ==''){
	  delete_post_meta($postID, $count_key);
	  add_post_meta($postID, $count_key, '.');
  }else{
	  update_post_meta($postID, $count_key,$countinput);
  }
}

/**********文章***********/
add_filter('manage_posts_columns', 'add_new_posts_columns');
function add_new_posts_columns($book_columns) {
	$new_columns['cb'] = '<input type="checkbox" />';
	$new_columns['title'] = _x( 'Title', 'column name' );
	$new_columns['author'] = __('Author');
	$new_columns['categories'] = __('Categories');
	$new_columns['tags'] = __('Tags');
	$new_columns['flag'] = __('推送');
	$new_columns['date'] = _x('Date', 'column name');
	return $new_columns;
}

add_action('manage_posts_custom_column', 'manage_posts_columns', 10, 2);

function manage_posts_columns($column_name, $id){
	$flagShow = array('f'=>'幻灯');
	$flag = getNewKeys($id,'flag');

	switch ($column_name){
		case 'flag':
		echo $flagShow[$flag];
		break;
		default:
		break;
	}
}

//查找postmeta特定值，获取文章ID
function select_postmeta_key($key,$value){
	global $wpdb;
	$table_name = $wpdb->prefix;
	$object_id = $wpdb->get_col("SELECT post_id FROM ".$table_name."postmeta WHERE `meta_key` = '".$key."' AND `meta_value` ='".$value."'");
	return $object_id;
}

	//调用自定义的函数，在wp-helper目录的custom-fields.php文件中
	register_field();

//自定义PHP页面加载调用wordpress的API函数(仅限固定链接下使用)
function loadCustomTemplate($template) {
    global $wp_query;
    if(!file_exists($template))return;
    $wp_query->is_page = true;
    $wp_query->is_single = false;
    $wp_query->is_home = false;
    $wp_query->comments = false;
    // if we have a 404 status
    if ($wp_query->is_404) {
    // set status of 404 to false
        unset($wp_query->query["error"]);
        $wp_query->query_vars["error"]="";
        $wp_query->is_404=false;
    }
    // change the header to 200 OK
    header("HTTP/1.1 200 OK");
    //load our template
    include($template);
    exit;
}
 
function templateRedirect() {
    $basename = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
    loadCustomTemplate(TEMPLATEPATH.'/custom/'."$basename.php");
}
  
add_action('template_redirect', 'templateRedirect');
	


?>