<?php
function CK_Video_register() { 
if(current_user_can('level_10')){
 $indate = date(time());
 $option = get_option('ck_video_option');//获取选项   
if($option==''){
//设置默认数据
$option=array(
            	"indate"=>$indate,
            	"logo"=>"",
            	"choice"=>"none",
            	"analynum"=>"1",
            	"analyapi"=>"",
            	"neturl"=>"",
				"sortrank"=>1,
				"adpre"=>"http://blog.qiuxinjiang.cn/wp-content/themes/HotNewspro/images/logo.png",
				"adprelink"=>"<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
<!-- ck-video -->
<ins class=\"adsbygoogle\"
     style=\"display:inline-block;width:336px;height:280px\"
     data-ad-client=\"ca-pub-1495498038472167\"
     data-ad-slot=\"3993915538\"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>",
				"adprelink2"=>"<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
<!-- ck-videodown -->
<ins class=\"adsbygoogle\"
     style=\"display:inline-block;width:468px;height:60px\"
     data-ad-client=\"ca-pub-1495498038472167\"
     data-ad-slot=\"7668418731\"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>",
				"adprelinkp"=>"<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
<!-- ck-video -->
<ins class=\"adsbygoogle\"
     style=\"display:inline-block;width:336px;height:280px\"
     data-ad-client=\"ca-pub-1495498038472167\"
     data-ad-slot=\"3993915538\"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>",
				"adprelinkp2"=>"<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
<!-- ck-videodown -->
<ins class=\"adsbygoogle\"
     style=\"display:inline-block;width:468px;height:60px\"
     data-ad-client=\"ca-pub-1495498038472167\"
     data-ad-slot=\"7668418731\"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>",
				"adpreurl"=>"http://blog.qiuxinjiang.cn/",
				"adpretime"=>"10",
				"adpau"=>"http://blog.qiuxinjiang.cn/wp-content/themes/HotNewspro/images/logo.png",
				"adpauurl"=>"http://blog.qiuxinjiang.cn/",
				"adbuffer"=>"http://blog.qiuxinjiang.cn/wp-content/themes/HotNewspro/images/logo.png",
				"logourl"=>"cklogo.png",
				"admar"=>"欢迎使用ck-video插件，请访问“滴水成江”获取最新版本",
				"admarurl"=>"http://blog.qiuxinjiang.cn/",
				"logged"=>"0",
				"motion"=>"2",
				"ckpause"=>"1",
				"volume"=>80,
				"cthidden"=>"1",
				"cthidtime"=>"3000",
				"logpretime"=>"10",
				"loggedadv"=>"1",
				"loggedadvp"=>"1",
				"jindu"=>"0",
				"adprew"=>"336",
				"adpreh"=>"280",
				"adprelr"=>"0",
				"adpreud"=>"30",
				"adprew2"=>"468",
				"adpreh2"=>"0",
				"adprelr2"=>"0",
				"adpreud2"=>"25",
				"adprepw"=>"336",
				"adpreph"=>"280",
				"adpreplr"=>"0",
				"adprepud"=>"30",				
				"adpreplr2"=>"0",
				"adprepud2"=>"25",				
				"adprepw2"=>"468",
				"adpreph2"=>"60",
				"djzt"=>"1",
				"sjqp"=>"1",
				"qzggss"=>"1",
				"jpbut"=>"1",
				"qzjingyin"=>"1",
				"ztcls"=>"1",
				"opmarquee"=>"2",
				"ckkey"=>"",
				"ckname"=>"",
				"ckurl"=>"",
				"ckver"=>"",
				);
update_option('ck_video_option',$option);//更新选项
}
}
} 

function CK_Video_remove() {   
if(current_user_can('level_10')){
/* 删除 wp_options 表中的对应记录 */
delete_option('ck_video_option');   
}   
}


function CK_Video_addbuttons() {
    if(current_user_can('level_10')){
     //增加设置菜单
	 require( plugin_dir_path(__FILE__ ).'menu.php');
	 // Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
	// add the button for wp25 in a new way
		add_filter("mce_external_plugins", "add_ckvideo_tinymce_plugin", 5);
		add_filter('mce_buttons', 'register_ckvideo_button', 5);
	}
}
}
// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_ckvideo_tinymce_plugin($plugin_array) {
	$plugin_array['ckvideo'] = plugins_url('',__FILE__).'/editor_plugin.js';	
	return $plugin_array;
}
// used to insert button in wordpress 2.5x editor
function register_ckvideo_button($buttons) {
	array_push($buttons, "separator", "ckvideo");
	return $buttons;
}

//视频   
    function CK_Video($atts, $content=null){
	 $option = get_option('ck_video_option');//获取选项   
	if($option[neturl]==""){$neturl = content_url();}else{ $neturl = $option[neturl]; };
    extract(shortcode_atts(array(   
    "vtype" => '视频源',   
          "url" => '视频ID',   
          "auto" => '0', 
          "width" => '610', 
          "height" => '460'
    ), $atts));   
	
         return '<script language="javascript" type="text/javascript" src="'.WP_PLUGIN_URL."/".dirname(plugin_basename(__FILE__)).'/js/tinymce.js"></script>
<p style="text-align: center;"><iframe name="video" id="video" scrolling="no" align="middle" frameborder="0"   width="'.$width.'"  marginwidth="0" marginheight="0" height="'.$height.'"src="'.$neturl.'/plugins/ck-video/?content='. $content .'&auto='.$auto.'&url='.$url.'" ></iframe>   
</p>

<div  style="display:'.$option[choice].';">
<p style="text-align: left;">
若解析视频失败，请选择官方视频播放（广告时间较长）：</p>
<p style="text-align: center;">
解析视频<input type="radio" name="iframeurlcheck" id="iframeurlcheck1" checked="checked"  onmousedown="iframeurl(\''.$neturl.'/plugins/ck-video/?content='. $content .'&auto='.$auto.'&url='.$url.'\')" />
官方视频<input type="radio" name="iframeurlcheck" id="iframeurlcheck2" onmousedown="iframeurl(\''.$neturl.'/plugins/ck-video/direct/?content='. $content .'&auto='.$auto.'&url='.$url.'\')" />
</p>
</div>
<p style="text-align: center;">
' ;
 
          
}

    function CK_Video_Next($atts, $content=null){
	 $option = get_option('ck_video_option');//获取选项   
	if($option[neturl]==""){$neturl = content_url();}else{ $neturl = $option[neturl]; };
    extract(shortcode_atts(array(   
    "vtype" => '视频源',   
          "url" => '视频ID',   
          "auto" => '0', 
    ), $atts));   
         return '<a href="javascript:void(0);" onclick="choice(\''.$neturl.'/plugins/ck-video/?content='. $content .'&auto='.$auto.'&url='.$url.'\',\''.$neturl.'/plugins/ck-video/direct/?content='. $content .'&auto='.$auto.'&url='.$url.'\')" target="video">'. $content .'</a>' ;       
       }  

?>