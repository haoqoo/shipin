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
		<body id="link" onload="" style="display: none">
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
<form id="ckvideo" action="#">
<table width="100%" border="0" cellpadding="4" cellspacing="5">
	
  <tr>
    <td width="20%">视频地址</td>
    <td width="80%">
      
    <input type="text" style="width: 100%; height:30px;" id="cvurl" name="cvurl">
    </td>
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