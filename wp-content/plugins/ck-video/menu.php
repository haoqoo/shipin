<?php
 //增加ckplayer设置菜单
function ck_add_pages() { 
add_menu_page('播放器设置', '播放器设置', 'manage_options', __FILE__, 'CK_toplevel_page'); 
add_submenu_page(__FILE__,'about','关于插件',8,'about-ck-video','about_ck_video');
} 

function CK_toplevel_page() { 
include 'ckplayercommon_edit.php'; 
} 
function about_ck_video() { 
include 'about_ck_video.htm'; 
} 
// 通过add_action来自动调用ck_add_pages函数 
add_action('admin_menu', 'ck_add_pages');
?>