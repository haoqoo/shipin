<?php
//////////////////////////短代码///////////////////////////
				function warningbox($atts, $content=null, $code="") {
					$return = '<div class="warning shortcodestyle">';
					$return .= $content;
					$return .= '</div>';
					return $return;
				}
				add_shortcode('warning' , 'warningbox' );

				function nowaybox($atts, $content=null, $code="") {
					$return = '<div class="noway shortcodestyle">';
					$return .= $content;
					$return .= '</div>';
					return $return;
				}
				add_shortcode('noway' , 'nowaybox' );
				
				function buybox($atts, $content=null, $code="") {
					$return = '<div class="buy shortcodestyle">';
					$return .= $content;
					$return .= '</div>';
					return $return;
				}
				add_shortcode('buy' , 'buybox' );
		
				function taskbox($atts, $content=null, $code="") {
					$return = '<div class="task shortcodestyle">';
					$return .= $content;
					$return .= '</div>';
					return $return;
				}
				add_shortcode('task' , 'taskbox' );
				
				function infobox($atts, $content=null, $code="") {
					$return = '<div class="info shortcodestyle">';
					$return .= $content;
					$return .= '</div>';
					return $return;
				}
				add_shortcode('info' , 'infobox' );
				
				function notebox($atts, $content=null, $code="") {
					$return = '<div class="note"><div class="noteline">';
					$return .= $content;
					$return .= '</div></div>';
					return $return;
				}
				add_shortcode('note' , 'notebox' );
				
				
				
				
				function doubanplayer($atts, $content=null){
				extract(shortcode_atts(array("auto"=>'0'),$atts));
				return '<embed src="'.get_bloginfo("template_url").'/images/shortcode/doubanplayer.swf?url='.$content.'&amp;autoplay='.$auto.'" type="application/x-shockwave-flash" wmode="transparent" allowscriptaccess="always" width="400" height="30">';
				}
				add_shortcode('music','doubanplayer');
				
				function doubanplayer2($atts, $content=null){
				extract(shortcode_atts(array("auto"=>"0", "title"=>""),$atts));
				return '<div class="aligncenter mplayer" style="width:350px"><embed src="'.get_bloginfo("template_url").'/images/shortcode/mainplayer.swf?url='.$content.'&autoplay='.$auto.'&loop=0&descri='.$title.'" type="application/x-shockwave-flash" allowscriptaccess="always"  wmode="opaque" width="350" height="40"></div>';
				}
				add_shortcode('song','doubanplayer2');
								
				
				function image($atts, $content=null) {
					extract(shortcode_atts(array("height"=>"300","title"=>""),$atts));
					return '<img title="'.$title.'" src="'.get_bloginfo( "template_url" ).'/functions/timthumb.php?src='.$content.'&amp;h='.$height.'&amp;w=620">';
				}
				add_shortcode('image' , 'image' );
				
				
				function toggle($atts, $content=null) {
					extract(shortcode_atts(array("title"=>''),$atts));
					$return ='<div class="toggle"><div class="toggletitle"><span class="toggleimg"></span>'.$title.'</div><div class="togglecon">' ;
					$return .= do_shortcode($content) ;
					$return .='</div></div>' ;
					return $return;
				}
				add_shortcode('toggle' , 'toggle' );
				

				
				
				
				//////////////istudio短代码支持（改良）/////////////
				function downlink($atts,$content=null){
					extract(shortcode_atts(array("href"=>'http://'),$atts));
				return '<div class="but_down"><a href="'.$href.'" target="_blank" rel="nofollow"><span>'.$content.'</span></a><div class="clear"></div></div>';
				}
				add_shortcode('Downlink','downlink');
				function flvlink($atts,$content=null){
				extract(shortcode_atts(array("auto"=>'0'),$atts));
				return'<embed src="'.get_bloginfo("template_url").'/images/shortcode/flvideo.swf?auto='.$auto.'&flv='.$content.'" menu="false" quality="high" wmode="transparent" bgcolor="#ffffff" width="560" height="315" name="flvideo" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer_cn" />';
				}
				add_shortcode('flv','flvlink');
				function mp3link($atts, $content=null){
				extract(shortcode_atts(array("auto"=>'0',"replay"=>'0',),$atts));	
				return '<embed src="'.get_bloginfo("template_url").'/images/dewplayer.swf?mp3='.$content.'&amp;autostart='.$auto.'&amp;autoreplay='.$replay.'" wmode="transparent" height="20" width="240" type="application/x-shockwave-flash" />';
				}
				add_shortcode('mp3','mp3link');
				
				//////////////
				function wp_embed_handler_Deveyouku( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_youku', '<embed src="http://player.youku.com/player.php/sid/' . esc_attr($matches[1]) . '/v.swf" quality="high" width="620" height="390" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
				wp_embed_register_handler( 'youku', '#http://v.youku.com/v_show/id_(.*?).html#i', 'wp_embed_handler_Deveyouku' );
				
				function wp_embed_handler_Devetudou( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_tudou', '<embed src="http://www.tudou.com/v/' . esc_attr($matches[1]) . '/v.swf"  quality="high" width="620" height="390" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr );}
				wp_embed_register_handler( 'tudou', '#http://www.tudou.com/programs/view/(.*?)($|&)#i', 'wp_embed_handler_Devetudou' );
				
				function wp_embed_handler_Deveku6( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_ku6', '<embed src="http://player.ku6.com/refer/' . esc_attr($matches[1]) . '/v.swf" quality="high" width="620" height="390" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
				wp_embed_register_handler( 'ku6', '#http://v.ku6.com/show/(.*?).html#i', 'wp_embed_handler_Deveku6' );
				
				function wp_embed_handler_Deveyoutube( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_youtube', '<embed src="http://www.youtube.com/v/' . esc_attr($matches[1]) . '?&amp;hl=zh_CN&amp;rel=0" width="620" height="390" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
				wp_embed_register_handler( 'youtube', '#http://youtu.be/(.*?)($|&)#i', 'wp_embed_handler_Deveyoutube' );
			
				function wp_embed_handler_Deveyinyuetai( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_yinyuetai', '<embed src="http://www.yinyuetai.com/video/player/' . esc_attr($matches[1]) . '/v_0.swf" quality="high" width="620" height="390" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
				wp_embed_register_handler( 'yinyuetai', '#http://www.yinyuetai.com/video/(.*?)($|&)#i', 'wp_embed_handler_Deveyinyuetai' );
				
				
				function wp_embed_handler_Deve56 ($matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_56', '<embed src="http://player.56.com/v_' . esc_attr($matches[1]) . '.swf" quality="high" width="620" height="390" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
				wp_embed_register_handler( '56', '#http://player.56.com/v_(.*?).swf#i', 'wp_embed_handler_Deve56' );
			
				function wp_embed_handler_Devesohu( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_sohu', '<embed src="http://share.vrs.sohu.com/' . esc_attr($matches[1]) . '/v.swf" quality="high" width="620" height="390" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
				wp_embed_register_handler( 'sohu', '#http://share.vrs.sohu.com/(.*?)/v.swf#i', 'wp_embed_handler_Devesohu' );

				function wp_embed_handler_Deve6cn( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_6cn', '<embed src="http://6.cn/p/' . esc_attr($matches[1]) . '.swf" quality="high" width="480" height="385" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
				wp_embed_register_handler( '6cn', '#http://6.cn/p/(.*?).swf#i', 'wp_embed_handler_Deve6cn' );
				
				function wp_embed_handler_Develetv( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_letv', '<embed src="http://www.letv.com/player/' . esc_attr($matches[1]) . '.swf" quality="high" width="620" height="390" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
				wp_embed_register_handler( 'letv', '#http://www.letv.com/player/(.*?).swf#i', 'wp_embed_handler_Develetv' );
				
				function wp_embed_handler_Devesina( $matches, $attr, $url, $rawattr ) { return apply_filters( 'embed_sina', '<embed src="http://you.video.sina.com.cn/api/sinawebApi/outplayrefer.php/vid=' . esc_attr($matches[1]) . '/s.swf" quality="high" width="620" height="390" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" allowfullscreen="true" wmode="opaque"></embed>', $matches, $attr, $url, $rawattr ); }
				wp_embed_register_handler( 'sina', '#http://you.video.sina.com.cn/api/sinawebApi/outplayrefer.php/vid=(.*?)/s.swf#i', 'wp_embed_handler_Devesina' );
				
				function wp_embed_handler_Devebilibili( $matches, $attr, $url, $rawattr ) { 
				return apply_filters( 'embed_bilibili', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<embed height="452" width="544" quality="high" allowfullscreen="true" type="application/x-shockwave-flash" wmode="opaque" src="http://static.loli.my/miniloader.swf" flashvars="'. esc_attr($matches[1]) .'" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash"></embed>', $matches, $attr, $url, $rawattr ); }
				wp_embed_register_handler( 'bilibili', '#http://static.loli.my/miniloader.swf\?(.*?)($|&)#i', 'wp_embed_handler_Devebilibili' );
				

				
				//////
				function docsGoogle($atts, $content=null){
				return '<p style="text-align: center;"><iframe style="border: 1px solid #ccc;" src="http://docs.google.com/viewer?url='.$content.'&amp;embedded=true" width="620" height="350"></iframe></p>';}
				add_shortcode('docs','docsGoogle');

				function enable_more_buttons($buttons) { $buttons[] = 'hr'; return $buttons; }  
				add_filter("mce_buttons", "enable_more_buttons");
				
				//////////
				
				function googleMaps($atts, $content = null) {
					extract(shortcode_atts(array(
					"width" => '610',
					"height" => '400',
					"src" => ''
					), $atts));
				 return '<iframe style="display:block;margin:auto;border: 1px solid #ccc;padding:5px;background:#FFF" width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src. '&amp;output=embed" ></iframe>';}
				add_shortcode("googlemap", "googleMaps");
				
				
				
				function baidumap_shortcode( $atts ) {
					extract(shortcode_atts(array(
						'width' => '610',
						'height' => '400',
						'center' => '',
						'zoom' => '13'
					), $atts));
 
						return '<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>

						<div style="width:'.$width.'px;height:'.$height.'px;display:block;margin:auto;border:1px solid #ccc;padding:5px;background:#FFF"><div style="width:'.$width.'px;height:'.$height.'px" id="dituContent"></div></div>
							<script type="text/javascript">
								function initMap(){createMap(); setMapEvent();addMapControl();}function createMap(){ var map = new BMap.Map("dituContent");var point = new BMap.Point('.$center.'); map.centerAndZoom(point,'.$zoom.'); window.map = map; }function setMapEvent(){ map.enableDragging();map.enableScrollWheelZoom(); map.enableDoubleClickZoom(); map.enableKeyboard();} function addMapControl(){var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_SMALL});map.addControl(ctrl_nav);}initMap();
							</script>';
					}
				add_shortcode('baidumap', 'baidumap_shortcode');

				////////
				add_filter('widget_text', 'do_shortcode');
				function one_half( $atts, $content = null ) {
					return '<div class="one_half">' . do_shortcode($content) . '</div>';}
				add_shortcode('one_half', 'one_half');
				
				function one_half_last( $atts, $content = null ) {
					return '<div class="one_half halfend">' . do_shortcode($content) . '</div><div class="clear"></div>';}
				add_shortcode('one_half_last', 'one_half_last');
				
				include_once('googlemapsv3.php');
				
		
function deve_Shortpage(){?>
<style type="text/css">
.wrap{padding:10px; font-size:12px; line-height:24px;color:#383838;}
.devetable td{vertical-align:top;text-align: left;border:none  }
.devetable2{line-height:16px;border:none}
.top td{vertical-align: middle;text-align: left; border:none}
table{border:none}
pre{white-space: pre;overflow: auto;padding:0px;line-height:19px;font-size:12px;color:#898989;}
strong{ color:#666}
.none{/*display:none;*/}
fieldset{ border:1px solid #ddd;margin:5px 0 10px;padding:10px 10px 20px 10px;-moz-border-radius:5px;-khtml-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;}
fieldset:hover{border-color:#bbb;}
fieldset legend{padding:0 5px;color:#777;font-size:14px;font-weight:700;cursor:pointer}
fieldset .line{border-bottom:1px solid #e5e5e5;padding-bottom:15px;}
</style>

<script type="text/javascript">
jQuery(document).ready(function($){  
$(".toggle").click(function(){$(this).next().slideToggle('slow')});
});
</script>

<div class="wrap">
<div id="icon-themes" class="icon32"><br></div>
<h2>短代码标签</h2>

 
    <div style="padding-left:20px;">
	
	<p>写文章时如果需要可以加入下列短代码（虽然编辑时“可视化”与“HTML”两种模式均可直接加入，但还是推荐在“HTML”模式下插入）</p>
	
    <p><span style="color: #993300;">*切换至HTML模式，编辑器有相应的按钮方便插入。</span></p>
    
<fieldset>
<legend class="toggle">各种短代码面板</legend>
	<div class="none">
      <table width="800" border="1" class="devetable">
      	<tr><td width="120">灰色项目面板：</td><td width="464"><code>[task]文字内容[/task]</code></td></tr>
  		<tr><td width="120">红色禁止面板：</td><td width="464"><code>[noway]文字内容[/noway]</code></td></tr>
        <tr><td width="120">黄色警告面板：</td><td width="464"><code>[warning]文字内容[/warning]</code></td></tr>
        <tr><td width="120">绿色购买面板：</td><td width="464"><code>[buy]文字内容[/buy]</code></td></tr>
        <tr><td width="120">蓝色信息面板：</td><td width="464"><code>[info]文字内容[/info]</code></td></tr>
        <tr><td width="120">Doc、Pdf文件查看器：</td><td width="464"><code>[docs]http://www.xxx.com/xxx.doc[/docs]</code> (后缀文件名可为.doc或.pdf)</td></tr>
        <tr><td width="120">双栏版块</td><td width="464"><code>[one_half]左栏内容[/one_half]</code> <code>[one_half_last]右栏内容[/one_half_last]</code> </td></tr>
		<tr><td width="120">收缩栏</td><td width="464"><code>[toggle title="标题"]请在此输入内容[/toggle]</code> </td></tr>
       </table>
       <p><span style="color: #808000;">注意：收缩栏和双栏版块的内容可以插入其他的短代码。（双栏版块的单栏宽度为295px）</span></p>
      </div>
</fieldset>
    
<fieldset>
<legend class="toggle">视频网站Flash嵌入</legend>
	<div class="none">
    <br>
      <table width="600" border="1" class="devetable">
      	<tr><td width="100"><span style="color: #993300;"> &nbsp;&nbsp;通用代码：</span></td><td width="504"><code>[embed]视频播放页面网址或Flash地址[/embed]</code></td></tr>
      </table>
       <br>
       
        <fieldset>
        <legend>使用视频播放页面网址的网站</legend>
        
            <p><span style="color: #808000;">以下网站中的视频，直接复制浏览器中的地址，粘贴到短代码中即可 </span></p>
            
              <table width="810" border="1" class="devetable">
               <tr><td width="80">优酷网：</td><td width="714"><code>[embed]http://v.youku.com/v_show/id_XMjgyNDk1NTYw.html[/embed]</code></td></tr>
               
               <tr><td width="80">土豆网：</td><td width="714"><code>[embed]http://www.tudou.com/programs/view/tFny-0UbTEM[/embed]</code></td></tr>
               <tr><td width="80">酷6网：</td><td width="714"><code>[embed]http://v.ku6.com/show/7eenXUV4xNfiUsSu.html[/embed]</code></td></tr>
               <tr><td width="80">Youtube：</td><td width="714"><code>[embed]http://youtu.be/vtjJe4elifI[/embed]</code></td></tr>
              <tr><td width="80">音乐台：</td><td width="714"><code>[embed]http://www.yinyuetai.com/video/32046[/embed]</code></td></tr>

              </table>
               
        </fieldset>  
           <br>   
       <fieldset>
        <legend>使用Flash地址的网站</legend>
        
            <p><span style="color: #808000;">以下网站中的视频，需要复制视频给出的分享中的flash地址，粘贴到短代码中即可 </span></p>
            
              <table width="810" border="1" class="devetable">
               <tr><td width="80">56.com：</td><td width="714"><code>[embed]http://player.56.com/v_NTM4ODY0NjY.swf[/embed]</code></td></tr>
               
               <tr><td width="80">搜狐视频：</td><td width="714"><code>[embed]http://share.vrs.sohu.com/374302/v.swf[/embed]</code> </td></tr>
               <tr><td width="80">6房间：</td><td width="714"><code>[embed]http://6.cn/p/1/n4WbeuI_Gn7GBxCVccLQ.swf[/embed]</code></td></tr>
               <tr><td width="80">乐视网：</td><td width="714"><code>[embed]http://www.letv.com/player/x725792.swf [/embed]</code></td></tr>
               <tr><td width="80">新浪视频：</td><td width="714"><code>[embed]http://you.video.sina.com.cn/api/sinawebApi/outplayrefer.php/vid=XXX/s.swf[/embed]</code></td></tr>
			   <tr><td width="80">bilibili：</td><td width="714"><code>[embed]http://static.loli.my/miniloader.swf?vid=32480745[/embed]</code></td></tr>

              </table>
               
        </fieldset>  
       
       
       
      </div>
</fieldset>   

<fieldset>
<legend class="toggle">嵌入地图</legend>
	<div class="none">
  
      <table width="850" border="1" class="devetable">
          <tr><td width="120"><strong>百度地图</strong></td><td>&nbsp;<a href="http://openapi.baidu.com/map/createMap.html" title="百度地图" target="_blank">到百度创建地图</a> (注意：文章中只能插入1个百度地图)</td></tr>
          <tr><td width="120">默认使用：</td><td><code>[baidumap zoom="地图级别"  center="X坐标,Y坐标"]</code></td></tr>
          <tr><td width="120">自定义宽度：</td><td><code>[baidumap zoom="地图级别"  center="X坐标,Y坐标" width="400" height="300"]</code></td></tr>
      
       <tr><td width="120">&nbsp;</td><td>&nbsp;</td></tr>
       <tr><td width="120"><strong>谷歌地图</strong></td><td>&nbsp;<a href="http://ditu.google.cn/maps?hl=zh-CN" title="谷歌地图" target="_blank">到谷歌获取地图分享网址</a></td></tr>
        <tr><td width="120">默认使用：</td><td><code>[googlemap src="URL"]</code></td></tr>
        <tr><td width="120">自定义宽度：</td><td><code>[googlemap width="400" height="300" src="URL"]</code></td></tr>
        <tr><td width="120">&nbsp;</td><td>&nbsp;</td></tr>
       <tr><td width="120"><strong>Google Maps v3</strong></td><td>&nbsp;<a href="http://gis.yohman.com/gmaps-plugin/" title="Google Maps v3" target="_blank">学习更多拓展</a> （X,Y坐标等可以套用百度的）</td></tr>
        <tr><td width="120">默认使用：</td><td><code>[map z="地图级别" address="X坐标,Y坐标"]</code></td></tr>
         <tr><td width="120">自定义宽度：</td><td><code>[map  w="400" h="300" z="地图级别" address="X坐标,Y坐标"]</code></td></tr>
        <tr><td width="120">定位文字信息：</td><td><code>[map z="地图级别" address="X坐标,Y坐标" marker="yes" infowindow="文字内容不能太多"]</code></td></tr>
        <tr><td width="120">（信息拓展）</td><td><code>[map z=&quot;地图级别&quot; address=&quot;X坐标,Y坐标&quot;  marker=&quot;yes&quot; infowindow=&quot;&lt;strong&gt;粗体标题&lt;/strong&gt;&lt;br&gt;描述文字&quot;]</code></td></tr>
        
        
       </table>
       
         <p><span style="color:#808000;">注意：地图样式里有上下左右5px的留空宽度，所以设定的宽度最大值为610px （如果应用到双栏版块，设定的宽度最大值为285px）。</span></p>
      </div>
</fieldset>   
    
<fieldset>
<legend class="toggle">音乐播放器</legend>
	<div class="none">
	 <strong>豆瓣播放器</strong>
      <table width="600" border="1" class="devetable">
      	<tr><td width="120">默认不自动播放：</td><td width="463"><code>[music]http://www.xxx.com/xxx.mp3[/music]</code></td></tr>
        <tr><td width="120">自动播放:</td><td><code>[music auto=1]http://www.xxx.com/xxx.mp3[/music]</code></td></tr>
       </table>

	  <br /><strong>豆瓣播放器（含歌名）</strong>
	   <table width="600" border="1" class="devetable">
      	<tr><td width="120">默认不自动播放：</td><td width="463"><code>[song title="音乐名称"]http://www.xxx.com/xxx.mp3[/song]</code></td></tr>
  
        <tr><td width="120">自动播放:</td><td><code>[song auto=1 title="音乐名称"]http://www.xxx.com/xxx.mp3[/song]</code></td></tr>
       </table>
      </div>
</fieldset> 
      
    <fieldset>
<legend class="toggle">兼容iStudio短代码</legend>
	<div class="none">
      <table width="800" border="1" class="devetable">
      	<tr><td width="200"><strong>下载样式</strong></td><td width="584"><code>[Downlink href="http://www.xxx.com/xxx.zip"]download xxx.zip[/Downlink]</code></td></tr>
   		<tr><td width="200">&nbsp;</td><td>&nbsp;</td></tr>
  
        <tr><td width="200"><strong>Mp3播放器</strong></td><td>&nbsp;</td></tr>
        <tr><td width="200">默认不循环不自动播放：</td><td><code>[mp3]http://www.xxx.com/xxx.mp3[/mp3]</code></td></tr>
         <tr><td width="200">自动播放：　</td><td><code>[mp3 auto="1"]http://www.xxx.com/xxx.mp3[/mp3]</code></td></tr>  
         <tr><td width="200">循环播放：	</td><td><code>[mp3 replay="1"]http://www.xxx.com/xxx.mp3[/mp3]</code></td></tr>
         <tr><td width="200">自动及循环播放：</td><td><code>[mp3 auto="1" replay="1"]http://www.xxx.com/xxx.mp3[/mp3]</code></td></tr>
         
         <tr><td width="200">&nbsp;</td><td>&nbsp;</td></tr>
         <tr><td width="200"><strong>Flv播放器</strong></td><td>&nbsp;</td></tr>
         <tr><td width="200">默认不自动播放：</td><td><code>[flv]http://www.xxx.com/xxx.flv[/flv]</code></td></tr>
         <tr><td width="200">自动播放：</td><td><code>[flv auto="1"]http://www.xxx.com/xxx.flv[/flv]</code></td></tr>
       </table>
       <p><span style="color: #808000;">注意：如果要使用这个播放器，一定要添加flv格式的视频文件</span></p>
      </div>
</fieldset> 
    </div>
  
</div>
<?php }
function deve_shortcode_page(){
  add_theme_page("短代码标签","短代码标签",'edit_themes','deve_shortcode_page','deve_Shortpage'); 
}
add_action('admin_menu','deve_shortcode_page');

///////////面板插入代码///////////
add_action( 'admin_print_footer_scripts', 'Deve_shortcode_buttons', 100 );
function Deve_shortcode_buttons() {
	?>
	<script type="text/javascript">
		QTags.addButton( 'deve01', '视频短代码', '[embed]视频网址或者视频flash网址[/embed]');
		QTags.addButton( 'deve02', 'task', '[task]请在此输入内容[/task]');
		QTags.addButton( 'deve03', 'noway', '[noway]请在此输入内容[/noway]');
		QTags.addButton( 'deve04', 'warning', '[warning]请在此输入内容[/warning]');
		QTags.addButton( 'deve05', 'buy', '[buy]请在此输入内容[/buy]');
		QTags.addButton( 'deve06', 'info', '[info]请在此输入内容[/info]');
		QTags.addButton( 'deve07', 'mp3', '[mp3]音乐文件地址[/mp3]');
		QTags.addButton( 'deve08', '下载按钮', '[Downlink href="文件URL"]文件名字[/Downlink]');
		QTags.addButton( 'deve09', 'Doc文件', doc_url );
			function doc_url(e, c, ed) { 
				docurl = prompt('doc或pdf文件地址，如：http://www.xxx.com/xxx.doc');
				if ( docurl === null ) return;
				rtrn = '[docs]' + docurl + '[/docs]';
				this.tagStart = rtrn;
				QTags.TagButton.prototype.callback.call(this, e, c, ed);
			}
		QTags.addButton( 'deve10', '双栏版块', '[one_half]左栏内容[/one_half] [one_half_last]右栏内容[/one_half_last]');
		QTags.addButton( 'deve11', '豆瓣播放器', '[music]音乐文件地址[/music]');
		QTags.addButton( 'deve12', '豆瓣播放器（含歌名）', '[song title="音乐名称"]音乐文件地址[/song]');
		QTags.addButton( 'deve13', 'Flv播放器', '[flv]flv文件地址[/flv]');
		QTags.addButton( 'deve14', '百度地图', '[baidumap zoom="地图级别" center="X坐标,Y坐标"]');
		QTags.addButton( 'deve15', '谷歌地图', '[googlemap src="URL"]');
		QTags.addButton( 'deve16', '谷歌地图（高级）', '[map z="地图级别" address="X坐标,Y坐标"]');
		QTags.addButton( 'deve19', '收缩栏', '[toggle title="标题"]请在此输入内容[/toggle]');
	</script>
	<?php }

?>