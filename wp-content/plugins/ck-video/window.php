<?php
$wpconfig = realpath("../../../wp-config.php");
if (!file_exists($wpconfig))  {
	echo "Could not found wp-config.php. Error in path :\n\n".$wpconfig ;	
	die;	
}
require_once($wpconfig);
require_once(ABSPATH.'/wp-admin/admin.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>视频</title>
<!-- 	<meta http-equiv="Content-Type" content="<?php// bloginfo('html_type'); ?>; charset=<?php //echo get_option('blog_charset'); ?>" /> -->
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo WP_PLUGIN_URL."/".dirname(plugin_basename(__FILE__)); ?>/js/tinymce.js"></script>
	<base target="_self" />
</head>
		<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';docopyContent();" style="display: none">
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
<form id="ckvideo" action="#">
<table width="100%" border="0" cellpadding="4" cellspacing="5">
	<tr>
    <td width="14%">视频名称</td>
    <td width="86%"><textarea title="输入视频名称." class="java" id="cvname" style="width: 100%" name="cvname" rows="1"></textarea></td>
  </tr>
  <tr>
    <td>视频地址</td>
    <td><textarea title="输入视频地址或视频ID." class="java" id="cvurl" style="width: 100%" name="cvurl" rows="1"></textarea></td>
  </tr>
  <tr>
    <td></td>
    <td><div id="moreurldiv"  style="display:none">
				起始集数<input title="输入起始集数." class="java" id="startnum"  name="startnum" type="text" size="2" value="1"/>
				每行集数<input title="输入每行." class="java" id="linenum"  name="linenum" type="text" size="2" value="8"/>
                <b>两集中间使用“||”作为分隔符。</b>
				</div></td>	
  </tr>	
  <tr>
    <td>视频宽度</td>
    <td><input title="输入视频宽度." class="java" id="cvwidth"  name="cvwidth" type="text" size="5" value="100%"/></td>
  </tr>              
  <tr>
    <td>视频高度</td>
    <td><input title="输入视频高度." class="java" id="cvheight"  name="cvheight" type="text" size="5" value="460"/></td>
  </tr>	
  <tr>
    <td>播放类型</td>
    <td><label for="autono">不自动播放</label><input type="radio" name="autovideo" id="autono" value="0" checked="checked">&nbsp;&nbsp;&nbsp;&nbsp; <label for="auto">自动播放</label><input type="radio" name="autovideo" id="auto" value="1" > </td>
  </tr>
  <tr>
    <td>多集视频</td>
    <td><input type="checkbox" name="moreurl" id="moreurl" onchange="moreURLdiv()" /></td>
  </tr>	
    

				

				
  <tr>
    <td></td>
    <td><span class="render"><INPUT id="cancel"  type="button" value="清&nbsp;&nbsp;除" name="cancel" runat="server" onclick="clearText()">
					<INPUT id="insert"  type="button" value="插&nbsp;&nbsp;入" name="insert" runat="server" onclick="insertCK_Videocode()">
		</span>
	</td>
  </tr>	
				
				



        </table>
</form>








 
</body>
</html>