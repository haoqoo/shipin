<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width , initial-scale=1.0 , user-scalable=0 , minimum-scale=1.0 , maximum-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<title><?php 

	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );


	if(get_option('themes_fo2_seo_ht') && get_option('themes_fo2_seo_on') && ( is_home() || is_front_page())){
		echo get_option('themes_fo2_seo_ht');
	}else{
		
	// Add the blog name.
	bloginfo( 'name' );
		
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'frontopen' ), max( $paged, $page ) );

	?></title>
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
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
	wp_enqueue_script("jquery");
	wp_head();
?>
<script type="text/javascript">(function(){mod_txt = '#<?php echo get_option('themes_fo2_sider_roll'); ?>'; adminBar = "<?php if(is_user_logged_in()){echo get_option('themes_fo2_admin_bar');}?>" || 0})();</script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/frontopen.js?ver=<?php echo VRESION?>"></script>
<?php if(!is_home()){?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/include/lightbox-2.6.min.js"></script>
<link href="<?php bloginfo('template_url'); ?>/lightbox.css" rel="stylesheet" type="text/css" />
<?php }?>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?ver=<?php echo VRESION?>" />
<?php if(!get_option('themes_fo2_mobile')){?><link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/mobile.css?ver=<?php echo VRESION?>" /><?php }?>

<style type="text/css">@media screen and (min-width:1366px){.c-con{height:<?php if(get_option('themes_fo2_con_height')){echo get_option('themes_fo2_con_height');}else{echo "140px";} ?>;}}
<?php if(get_option('themes_fo2_page_suo')){echo ".entry-content p{text-indent: 2em;}.entry-content p iframe{margin-left:-2em;}";};?>
<?php 
$bgcoler = get_option('themes_fo2_colbg') ;
$coler1 = get_option('themes_fo2_col1') ;
$coler2 = get_option('themes_fo2_col2') ;
$coler3 = get_option('themes_fo2_col3') ;
$coler4 = get_option('themes_fo2_col4') ;
$coler5 = get_option('themes_fo2_col5') ;
$coler6 = get_option('themes_fo2_col6') ;
$coler7 = get_option('themes_fo2_col7') ;
$coler8 = get_option('themes_fo2_col8') ;
$coler9 = get_option('themes_fo2_col9') ;
$coler10 = get_option('themes_fo2_col10') ;
$colernav1 = get_option('themes_fo2_colnav1') ;
$colernav2 = get_option('themes_fo2_colnav2') ;
$colernav3 = get_option('themes_fo2_colnav3') ;
$colernav4 = get_option('themes_fo2_colnav4') ;
$colernav5 = get_option('themes_fo2_colnav5') ;
$colernav6 = get_option('themes_fo2_colnav6') ;
?>
<?php if($bgcoler){?>body , .tit{background:<?php echo $bgcoler;?>}<?php };?>
<?php if($coler9){?>a , .siteInfo li{color:<?php echo $coler9;?>}<?php };?>
<?php if($coler1){?>.page-link a{color:<?php echo $coler1;?>}.side .widget-container{border-color:<?php echo $coler1;?>}<?php };?>
<?php if($coler2){?>#calendar_wrap th , .nav-previous a , .page-link span , .page-link a:hover span , .nav .tig .sub , .page_num .current,.page_num a:hover , #goTop{background:<?php echo $coler2;?>}<?php };?>
<?php if($coler3){?>.datetime , #wp-calendar td a , .form-submit input:hover , .car-yearmonth , #article-index{background:<?php echo $coler3;?>;}.entry-content a:hover , .logged-in-as a , .gonggao a:hover , .tit .h1 a:hover{color:<?php echo $coler3;?>}<?php };?>
<?php if($coler4){?>a:hover , .header .logo i , .tit .h1 a , .tit .iititle2 span a:hover , .entry-content a , .entry-title , .mbx a:hover , .commentlist .comment-body a , .top_post .ulist a:hover , .gonggao a , .loc_link a , .tit .iititle a:hover{color:<?php echo $coler4;?>}.nav .tig .rrs , #wp-calendar td a:hover , .jz_bt , .loading , .subbtn .btn , .post_pic_box:hover , .title_hot , .top_bar , .car-toggler , .but_down a , .page-link a span , .page-link .t_s_s , .page_num a , .nav-next a{background:<?php echo $coler4;?>;}.j_zeng , .jz_bt:hover , .f_links li{border-color:<?php echo $coler4;?>}<?php };?>
<?php if($coler5){?>#searchsubmit , .side .widget-title{background:<?php echo $coler5;?>}
.side .widget-container > ul,.side .widget-container .tagcloud , #calendar_wrap , .author_da{border-color:<?php echo $coler5;?>;}<?php };?>
<?php if($coler6){?>.archive-meta , .c-con , .form-submit input , .c-con .disp_a , .gonggao , .entry-content , .side ul li , .header .logo b , .c-con p , .comment-author .fn{color:<?php echo $coler6;?>}<?php };?>
<?php if($coler7){?>.tit .iititle span , .post-edit-link , .tit .iititle , .tit .iititle a , .tit .iititle2 span , .tit .iititle2 span a , .cb_bq a , .commentmetadata a , .comment-author .says , .top_post .ulist h2 span , .task , .note , .singlepagestyle span , .mbx{color:<?php echo $coler7;?>}.post_pic_box .info{border-color:<?php echo $coler7;?>}<?php };?>
<?php if($coler8){?>.mbx a , .top_post .ulist a , .togglecon{color:<?php echo $coler8;?>}<?php };?>
<?php if($coler10){?>.top_post{background:<?php echo $coler10;?>;}<?php };?>
<?php if($colernav1){?>.navcon{background:<?php echo $colernav1;?>;}<?php };?>
<?php if($colernav2){?>.navcon ul li{border-color:<?php echo $colernav2;?>;}<?php };?>
<?php if($colernav3){?>.sub-menu , .sub-menu .menu-item{background:<?php echo $colernav3;?>;}<?php };?>
<?php if($colernav4){?>.navcon ul li a:hover, .navcurrent{background:<?php echo $colernav4;?>;}<?php };?>
<?php if($colernav5){?>.navcon ul li a{color:<?php echo $colernav5;?>;}<?php };?>
<?php if($colernav6){?>.navcon ul li a:hover, .navcurrent{color:<?php echo $colernav6;?>;}<?php };?>
</style>

<?php if(get_option('themes_fo2_page_width')){?>
<style type="text/css">body{max-width:<?php echo get_option('themes_fo2_page_width') ?>px; _width:<?php echo get_option('themes_fo2_page_width') ?>px; margin:auto;}<?php if(get_option('themes_fo2_page_width') < 1366){echo ".post_box {width:95%; height:auto;}";} ?>@media screen and (max-width:960px){body{width:100%; margin:auto;}.post_box {width:100%; height:auto;}.main {width:100% !important;}.side {width:25%;} .page_php {width:72% !important;} #content {width: 75%;}}
<?php if(get_option('themes_fo2_page_width') <= 959){echo ".main {width:70%;}.side {width:30%;} .page_php {width: 67% !important;} #content {width: 70%;}";}?>
</style>
<?php }?>
<?php if(get_option('themes_fo2_css')){echo "<style type='text/css'>" . get_option('themes_fo2_css') . "</style>";}?>
<!--[if lt IE 9]><script src="<?php bloginfo('template_url'); ?>/html5.js"></script><![endif]-->
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/font-awesome.min.css?ver=<?php echo VRESION?>">
<!--[if IE 7]>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/font-awesome-ie7.min.css?ver=<?php echo VRESION?>">
<![endif]-->
</head>

<body <?php body_class(); ?>>
<div class="loading"></div>
<div class="web_bod">
<header class="header marauto">
    <span class="logo">
    <?php if(get_option('themes_fo2_logo_img')){?>
    <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_option('themes_fo2_logo_img'); ?>" alt="<?php if(get_option('themes_fo2_logo')){ echo get_option('themes_fo2_logo');}else{echo bloginfo('name');} ?>" /></a>
    <?php }else{?>
    <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><b class="bclass"><?php if(get_option('themes_fo2_logo')){ echo get_option('themes_fo2_logo');}else{echo bloginfo('name');} ?></b></a>
    <?php }?>
    <i><?php if(get_option('themes_fo2_small_title')){echo get_option('themes_fo2_small_title');}else{echo bloginfo('description');} ?></i>
    </span>
  <?php if(!get_option('themes_fo2_search_display')){ ?>
  <form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
      <span class="search">
        <input name="s" id="s" type="text"  class="input" value="<?php echo get_option('themes_fo2_search_type') ?>" onclick="this.value = '';" style="color:#999" onkeypress="javascript:if(event.keyCode == 13){query(this.value);}" x-webkit-speech=""/>
        <button id="searchsubmit" class="btn"><?php if(get_option('themes_fo2_search_btn')){ echo get_option('themes_fo2_search_btn');}else{echo "SEARCH";} ?></button>
      </span>
    </form>
  <?php }?>
  <div class="cls"></div>
</header>
<?php if(!get_option('themes_fo2_topbtn_display')) {?>
<div class="nav marauto">
    <div class="tig">
    <?php if(get_option('themes_fo2_top_right_btn_text')){?>
  <a href="<?php echo get_option('themes_fo2_top_right_btn_url'); ?>" target="<?php echo get_option('themes_fo2_top_right_btn_target'); ?>" rel="<?php echo get_option('themes_fo2_top_right_btn_rel'); ?>" title="<?php echo get_option('themes_fo2_top_right_btn_title'); ?>"><span class="sub"><?php echo get_option('themes_fo2_top_right_btn_text'); ?></span></a><?php }?>
<?php if(get_option('themes_fo2_btn_rss2') != "checked"){ ?>
  <a href="javascript:;"><span id="rss_open" class="rrs">订阅RSS</span></a><div class="rss_box"><a class="close_rss" href="#"></a><span>邮件订阅</span> - 最后更新：<time><?php echo mysql2date('Y-m-d', get_lastpostmodified('GMT'), false); ?></time><br><?php if(get_option('themes_fo2_rss_key')){?><br><form class="subscribe-mail" action="http://list.qq.com/cgi-bin/qf_compose_send" target="_blank" method="post"><input type="hidden" name="t" value="qf_booked_feedback"><input type="hidden" name="id" value="<?php echo get_option('themes_fo2_rss_key')?>"><input class="rss_input" id="to" name="to" type="email" placeholder="Your E-mail"><input class="rss_submit" type="submit" value="订阅"></form><?php }?><div class="ress_btn_box">订阅源：<a target="_blank" href="<?php bloginfo('rss2_url');?>" rel="alternate" type="application/rss+xml" title="rss Feed">RSS</a> <a target="_blank" rel="external nofollow" href="http://mail.qq.com/cgi-bin/feed?u=<?php bloginfo('rss2_url');?>">QQ邮箱</a> <a target="_blank" rel="external nofollow" href="http://www.xianguo.com/subscribe.php?url=<?php bloginfo('rss2_url');?>">鲜果</a> <a target="_blank" rel="external nofollow" href="http://www.zhuaxia.com/add_channel.php?sourceid=102&url=<?php bloginfo('rss2_url');?>">抓虾</a></div></div><?php }?>
      <div class="gonggao">
        <ul id="g_box">
        <?php $acnum = get_option('themes_fo2_ac_num');	for($i=1; $i<=$acnum; $i++){?>
    <?php if(get_option('themes_fo2_top_ac' . $i . '_display')=='checked') : ?><li><span class="gg_tx"><i class="icon-volume-off icon-large"></i> <?php echo get_option('themes_fo2_top_ac'.$i.'_text');?></span></li><?php endif; }?>
        </ul>
      </div>
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


<nav class="navcon marauto">
  <div id="mobile_nav_btn">网站导航</div>
  <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' , 'fallback_cb'=>'Bing_nav_fallback') ); ?>
  
  </nav>   
  <section class="conter marauto">