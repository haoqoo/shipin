<?php
ini_set('display_errors', false);

add_filter( 'pre_option_link_manager_enabled', '__return_true' );//开启友情链接功能

add_image_size('thumbnail', 210, 150, true);
add_image_size('large',600,500);
add_image_size('medium',300,260);

require_once dirname( __FILE__ ) . '/include/small_tools.php';  //加载小工具

include_once('include/shortcode.php');  //短代码兼容
include_once('include/widget_logic.php');  //挂载widget_logic

if ( ! isset( $content_width ) )
	$content_width = 640;
	
//关闭部分系统默认的小工具
function unregister_rss_widget(){
unregister_widget('WP_Nav_Menu_Widget');
}
add_action('widgets_init','unregister_rss_widget');


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
	add_filter('show_admin_bar','hide_admin_bar');


	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'frontopen', get_template_directory() . '/languages' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'frontopen' ),
	) );
		
	register_widget('catPostsWidget');
	register_widget('readerWidget');
	
}
endif;

if ( ! function_exists( 'frontopen_admin_header_style' ) ) :
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
        $breadcrumbs[] = '<a href="http://www.frontopen.com/wp-admin/ . get_permalink($page->ID) . "  class="gray">' . get_the_title($page->ID) . '</a>';
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


//后台设置页面加载 主题选项
function themeoptions_admin_menu()
{
// 在控制面板的侧边栏添加设置选项页链接
add_theme_page("主题设置", "主题选项", 'edit_themes', 'themes_config', 'themeoptions_page');
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
if ($_POST['fo2_search_display']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_search_display', $display);


//网站标题
update_option('themes_fo2_logo', $_POST['fo2_logo']);
update_option('themes_fo2_small_title', $_POST['fo2_small_title']);
update_option('themes_fo2_logo_img', $_POST['fo2_logo_img']);

//是否禁用RSS按钮
if ($_POST['fo2_btn_rss2']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_btn_rss2', $display);


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

//是否开启页面加载耗时
if ($_POST['fo2_load_time']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_load_time', $display);

//禁用自动摘要功能
if ($_POST['fo2_auto_zhaiyao']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_auto_zhaiyao', $display);
update_option('themes_fo2_page_width', $_POST['fo2_page_width']);


//自定义信息
update_option('themes_fo2_readmore', $_POST['fo2_readmore']);
update_option('themes_fo2_juankuan', $_POST['fo2_juankuan']);
update_option('themes_fo2_fenxiang', stripslashes($_POST['fo2_fenxiang']));

//广告位代码管理
update_option('themes_fo2_ad_1', stripslashes($_POST['fo2_ad_1']));
update_option('themes_fo2_ad_2', stripslashes($_POST['fo2_ad_2']));


//网站底部信息
update_option('themes_fo2_icp', $_POST['fo2_icp']);
update_option('themes_fo2_copyright', $_POST['fo2_copyright']);
update_option('themes_fo2_sitemap', $_POST['fo2_sitemap']);
update_option('themes_fo2_tongji', stripslashes($_POST['fo2_tongji']));

//主题版权信息链接开关
if ($_POST['fo2_banquan']=='on') { $display = "checked"; } else { $display = ""; }
update_option('themes_fo2_banquan', $display);

}

function themeoptions_page()
{
// 设置选项页面的主要功能
	require_once dirname(__FILE__) . "/include/themes_options.php";
}
add_action('admin_menu', 'themeoptions_admin_menu');




//后台设置页面加载 导航按钮配置
function themeoptions_btn_admin_menu()
{
// 在控制面板的侧边栏添加设置选项页链接
add_theme_page("头部按钮设置", "按钮设置", 'edit_themes', 'themes_btn', 'themeoptions_page_btn');
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
add_action('admin_menu', 'themeoptions_btn_admin_menu');


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
 
//统计浏览次数
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
  $count = get_post_meta($postID, $count_key, true);
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

//文章索引目录功能
function article_index($content) {
   $matches = array();
   $ul_li = '';
   $r = "/<h3>([^<]+)<\/h3>/im";

   if(preg_match_all($r, $content, $matches)) {
       foreach($matches[1] as $num => $title) {
           $content = str_replace($matches[0][$num], '<h4 id="title-'.$num.'">'.$title.'</h4>', $content);
           $ul_li .= '<li><a href="#title-'.$num.'" title="跳转段落至 - '.$title.'">'.$title."</a></li>\n";
       }
       $content = "\n<div id=\"article-index\">
               <p class=\"title_lt\"><a href=\"javascript:void(0)\" class=\"gotop\" onclick=\"goRoll(0,300)\">BACK TOP</a>文章索引</p>
               <ol id=\"index-ul\">\n" . $ul_li . "<li><a href=\"#comments\" title=\"查看本文评论\">共".get_post($id)->comment_count."条评论</a></li></ol>
           </div>\n" . $content;
   }
   return $content;
}
add_filter( "the_content", "article_index" );

//自定义用户资料
add_filter('user_contactmethods','custom_contactmethods');
function custom_contactmethods($user_contactmethods ){
    $user_contactmethods  = array(
	  'aim' => __( '支付宝收款地址' ),
	  'addres' => __( '所在地' ),
	  'job' => __( '职业' ),
	  'qq' => __( 'QQ' ),
	  'touxiang' => __( '头像url' )
    );
    return $user_contactmethods ;
}

//标签云滤镜
add_filter( 'widget_tag_cloud_args', 'theme_tag_cloud_args' );
function theme_tag_cloud_args( $args ){
$newargs = array(
'smallest'    => 14,  //最小字号
'largest'     => 14, //最大字号
'unit'        => 'px',   //字号单位，可以是pt、px、em或%
'number'      => 45,     //显示个数
'format'      => 'flat',//列表格式，可以是flat、list或array
'separator'   => "\n",   //分隔每一项的分隔符
'orderby'     => 'name',//排序字段，可以是name或count
'order'       => 'ASC', //升序或降序，ASC或DESC
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
preg_match("/[0-9]/",$a[1],$a);
return "<a ".$text ." (".$a[0].")</a> ";
}
add_filter('wp_tag_cloud', 'Tagno', 1);