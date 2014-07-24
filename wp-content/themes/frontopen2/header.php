<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Front_Open
 * @since Front Open 1.0
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'frontopen' ), max( $paged, $page ) );

	?></title>
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/jquery.js"></script>
<script type="text/javascript">$(function(){mod_txt = '#<?php echo get_option('themes_fo2_sider_roll'); ?>';});</script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/frontopen.js"></script>
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php if(get_option('themes_fo2_page_width')){?>
<style type="text/css">body{max-width:<?php echo get_option('themes_fo2_page_width') ?>px; _width:<?php echo get_option('themes_fo2_page_width') ?>px; margin:auto;}<?php if(get_option('themes_fo2_page_width') < 1366){echo ".post_box {width:95%; height:auto;}";} ?>@media screen and (max-width:960px){body{width:100%; margin:auto;}.post_box {width:100%; height:auto;}.main {width:100% !important;}.side {width:25%;} .page_php {width:72% !important;} #content {width: 75%;}}
<?php if(get_option('themes_fo2_page_width') <= 1000){echo ".main {width:70%;}.side {width:30%;} .page_php {width: 67% !important;} #content {width: 70%;}";}?>
</style>
<?php }?>
</head>

<body <?php body_class(); ?> class="home">
<div class="loading"></div>
<div class="header marauto">
    	<span class="logo">
        <?php if(get_option('themes_fo2_logo_img')){?>
            <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_option('themes_fo2_logo_img'); ?>" alt="<?php if(get_option('themes_fo2_logo')){ echo get_option('themes_fo2_logo');}else{echo bloginfo('name');} ?>" /></a>
        <?php }else{?>
            <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><b class="bclass"><?php if(get_option('themes_fo2_logo')){ echo get_option('themes_fo2_logo');}else{echo bloginfo('name');} ?></b></a>
        <?php }?>
            <i><?php if(get_option('themes_fo2_small_title')){echo get_option('themes_fo2_small_title');}else{echo bloginfo('description');} ?></i></span>
  
  <?php if(!get_option('themes_fo2_search_display')){ ?>
  <form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
      <span class="search">
        <input name="s" id="s" type="text"  class="input" value="<?php echo get_option('themes_fo2_search_type') ?>" onclick="this.value = '';" style="color:#999" onkeypress="javascript:if(event.keyCode == 13){query(this.value);}" x-webkit-speech=""/>
        <button id="searchsubmit" class="btn"><?php if(get_option('themes_fo2_search_btn')){ echo get_option('themes_fo2_search_btn');}else{echo "SEARCH";} ?></button>
      </span>
  </form>
  <?php }?>
  <p class="m960tips"><a id="tclose">X 我知道了</a>TIPS:左右滑动导航栏可以查看更多栏目<img class="csan" src="<?php bloginfo('template_url'); ?>/images/csan.gif" width="27" height="14" /><div id="bakg"></div></p>
  <div class="cls"></div>
</div>
<?php if(!get_option('themes_fo2_topbtn_display')) {?>
<div class="nav marauto">
    	<div class="tig">
        <?php if(get_option('themes_fo2_top_right_btn_text')){?>
        	<a href="<?php echo get_option('themes_fo2_top_right_btn_url'); ?>" target="<?php echo get_option('themes_fo2_top_right_btn_target'); ?>" rel="<?php echo get_option('themes_fo2_top_right_btn_rel'); ?>" title="<?php echo get_option('themes_fo2_top_right_btn_title'); ?>"><span class="sub"><?php echo get_option('themes_fo2_top_right_btn_text'); ?></span></a>
            <?php } ?>
            <?php if(get_option('themes_fo2_btn_rss2') != "checked"){ ?>
            <a href="/feed" rel="alternate" type="application/rss+xml" target="_blank" title="rss Feed"><span class="rrs">订阅RSS</span></a>
            <?php }?>
        </div>
        
        <div class="navlist">
<?php $num = get_option('themes_fo2_btn_num');	for($i=1; $i<=$num; $i++){  ?>
		<?php if(get_option('themes_fo2_top_btn' . $i . '_display')=='checked') : ?>
			<dl>
			    <dt><a href="<?php echo get_option('themes_fo2_top_btn' . $i . '_url'); ?>" title="<?php echo get_option('themes_fo2_top_btn' . $i . '_title'); ?>" target="<?php echo get_option('themes_fo2_top_btn' . $i . '_target'); ?>" class="nav_button" style="opacity: 0.7;" rel="<?php echo get_option('themes_fo2_top_btn' . $i . '_rel'); ?>"><img src="<?php echo get_option('themes_fo2_top_btn' . $i . '_img'); ?>" width="45" height="45"></a></dt>
                <dd><?php echo get_option('themes_fo2_top_btn' . $i . '_text'); ?></dd>
            </dl>
			<?php endif; ?>
<?php }?>
        
            <div class="cls"></div>
        </div>
        
    </div>
<?php }?>
<div class="navcon marauto">
	<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
    <?php wp_nav_menu( array( 'container_class' => 'menu-header-m mIco', 'theme_location' => 'primary' , 'depth' => 1 , 'menu_class'  => 'menu-header-m', 'menu_id' => 'remen_ul',) ); ?>
    </div>
    
    <div class="conter marauto">