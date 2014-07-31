<?php
$wpconfig = realpath("../wp-config.php");
if (!file_exists($wpconfig))  {
	echo "Could not found wp-config.php. Error in path :\n\n".$wpconfig ;	
	die;	
}
require_once($wpconfig);
require_once(ABSPATH.'/wp-admin/admin.php');
if(current_user_can('level_10')){
 $option = get_option('ck_video_option');//获取选项   
if(isset($_POST['option_save'])){
    //处理数据   
    $option = array(
            	"indate"=>$option[indate],
            	"logo"=>stripslashes($_POST['logo']),
            	"neturl"=>stripslashes($_POST['neturl']),
				"analynum"=>stripslashes($_POST['analynum']),
				"analyapi"=>stripslashes($_POST['analyapi']),
				"choice"=>stripslashes($_POST['choice']),
				"sortrank"=>stripslashes($_POST['sortrank']),
				"logourl"=>stripslashes($_POST['logourl']),
				"adpre"=>stripslashes($_POST['adpre']),
				"adprelink"=>stripslashes($_POST['adprelink']),
				"adprelink2"=>stripslashes($_POST['adprelink2']),
				"adprelinkp"=>stripslashes($_POST['adprelinkp']),
				"adprelinkp2"=>stripslashes($_POST['adprelinkp2']),
				"adprew"=>stripslashes($_POST['adprew']),
				"adpreh"=>stripslashes($_POST['adpreh']),
				"adprew2"=>stripslashes($_POST['adprew2']),
				"adpreh2"=>stripslashes($_POST['adpreh2']),
				"adprepw2"=>stripslashes($_POST['adprew2']),
				"adpreph2"=>stripslashes($_POST['adpreh2']),
				"adprepw"=>stripslashes($_POST['adprepw']),
				"adpreph"=>stripslashes($_POST['adpreph']),
				
				"adprelr"=>stripslashes($_POST['adprelr']),
				"adpreud"=>stripslashes($_POST['adpreud']),
				"adprelr2"=>stripslashes($_POST['adprelr2']),
				"adpreud2"=>stripslashes($_POST['adpreud2']),
				"adpreplr2"=>stripslashes($_POST['adpreplr2']),
				"adprepud2"=>stripslashes($_POST['adprepud2']),
				"adpreplr"=>stripslashes($_POST['adpreplr']),
				"adprepud"=>stripslashes($_POST['adprepud']),
				
				
				"adpreurl"=>stripslashes($_POST['adpreurl']),
				"adpretime"=>stripslashes($_POST['adpretime']),
				"adpau"=>stripslashes($_POST['adpau']),
				"adpauurl"=>stripslashes($_POST['adpauurl']),
				"adbuffer"=>stripslashes($_POST['adbuffer']),
				"admar"=>stripslashes($_POST['admar']),
				"admarurl"=>stripslashes($_POST['admarurl']),
				"motion"=>stripslashes($_POST['motion']),
				"logged"=>stripslashes($_POST['logged']),
				"ckpause"=>stripslashes($_POST['ckpause']),
				"volume"=>stripslashes($_POST['volume']),
				"cthidden"=>stripslashes($_POST['cthidden']),
				"cthidtime"=>stripslashes($_POST['cthidtime']),
				"logpretime"=>stripslashes($_POST['logpretime']),
				"loggedadv"=>stripslashes($_POST['loggedadv']),
				"loggedadvp"=>stripslashes($_POST['loggedadvp']),
				"jindu"=>stripslashes($_POST['jindu']),
				"djzt"=>stripslashes($_POST['djzt']),
				"sjqp"=>stripslashes($_POST['sjqp']),
				"qzggss"=>stripslashes($_POST['qzggss']),
				"jpbut"=>stripslashes($_POST['jpbut']),
				"qzjingyin"=>stripslashes($_POST['qzjingyin']),
				"ztcls"=>stripslashes($_POST['ztcls']),
				"opmarquee"=>stripslashes($_POST['opmarquee']),
				"ckkey"=>stripslashes($_POST['ckkey']),
				"ckname"=>stripslashes($_POST['ckname']),
				"ckurl"=>stripslashes($_POST['ckurl']),
				"ckver"=>stripslashes($_POST['ckver']),
				);  
    update_option('ck_video_option', $option);//更新选项   
};
 $myLink = $option;
 include 'ckplayercommon_edit.htm.php';
}
?>