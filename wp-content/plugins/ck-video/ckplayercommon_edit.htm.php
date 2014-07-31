<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $cfg_soft_lang; ?>">
<title>ckplayer播放器配置</title>
<link href="css/base.css" rel="stylesheet" type="text/css">
<script language="javascript">
var searchconfig = false;
function Nav()
{
	if(window.navigator.userAgent.indexOf("MSIE")>=1) return 'IE';
	else if(window.navigator.userAgent.indexOf("Firefox")>=1) return 'FF';
	else return "OT";
}
function $Obj(objname)
{
	return document.getElementById(objname);
}
function ShowConfig(em,allgr)
{
	if(searchconfig) location.reload();
	for(var i=1;i<=allgr;i++)
	{
		if(i==em) $Obj('td'+i).style.display = (Nav()=='IE' ? 'block' : 'table');
		else $Obj('td'+i).style.display = 'none';
	}
	$Obj('addvar').style.display = 'none';
}

function ShowHide(objname)
{
	var obj = $Obj(objname);
	if(obj.style.display != "none") obj.style.display = "none";
	else obj.style.display = (Nav()=='IE' ? 'block' : 'table-row');
}

function backSearch()
{
	location.reload();
}
function getSearch()
{
	var searchKeywords = $Obj('keywds').value;
	var myajax = new DedeAjax($Obj('_search'));
	myajax.SendGet('sys_info.php?dopost=search&keywords='+searchKeywords)
	$Obj('_searchback').innerHTML = '<input name="searchbackBtn" type="button" value="返回" id="searchbackBtn" onclick="backSearch()"/>'
	$Obj('_mainsearch').innerHTML = '';
	searchconfig = true;
}
</script>



</head>
<body leftmargin='8' topmargin='8'>
<table width="98%" border="0" cellpadding="2" cellspacing="1" bgcolor="#D6D6D6" align="center">
  <tr>
   <td height="28" background="images/tbg.gif" style="padding-left:10px;"><b>CKplayer视频播放器参数配置：</b></td>
  </tr>
  <tr>
   <td height="24" bgcolor="#ffffff" align="center"> <a href='javascript:ShowConfig(1,5)'>基本参数</a>  | <a href='javascript:ShowConfig(2,5)'>前置广告</a>  | <a href='javascript:ShowConfig(3,5)'>暂停广告</a>  | <a href='javascript:ShowConfig(4,5)'>滚动文字广告</a>  | <a href='javascript:ShowConfig(5,5)'>右键版权</a></td>
  </tr>
</table>



<table width="98%" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px" bgcolor="#D6D6D6" align="center">
  <tr>
   <td height="28" align="right" background="images/tbg.gif" style="border:1px solid #D6D6D6;border-bottom:none;">
   </td>
  </tr>
  <tr>
   <td bgcolor="#FFFFFF" width="100%">
   <form  method="post" enctype="multipart/form-data" name="form1">
	<input type="hidden" name="id" value="<?php echo $myLink['id']?>">
    <input name="sortrank" type="hidden" id="sortrank" value="<?php echo $myLink['sortrank']?>" />
	<input type="hidden" name="dopost" value="saveedit">
    <input name="logo" type="hidden" id="logo" value="<?php echo $myLink['logo']?>" />
     <table width="100%" style='' id="td1" border="0" cellspacing="1" cellpadding="1" bgcolor="#D6D6D6">
      <tr align="center" bgcolor="#F6F6F6" height="25">
       <td width="200">参数名称</td>
       <td>参数值</td>
       <td width="310">参数说明</td>
      </tr>
      <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">自动播放：</td>
       <td align="left" style="padding:3px;">
         <input type='radio' name='ckpause' value="1" <?php if($myLink['ckpause']=="1") echo " checked='checked' "?>/> 是
         <input type='radio' name='ckpause' value="0" <?php if($myLink['ckpause']=="0") echo " checked='checked' "?>/> 否</td>
       <td></td>
      </tr>
            <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">默认音量：</td>
       <td align="left" style="padding:3px;"><input type="text" name="volume" id="volume" value="<?php echo $myLink['volume']?>" /></td>
       <td></td>
      </tr>
      <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">视频播放完成后：</td>
       <td align="left" style="padding:3px;">
         <input type='radio' name='motion' value="1" <?php if($myLink['motion']=="1") echo " checked='checked' "?>/> 重新播放
         <input type='radio' name='motion' value="2" <?php if($myLink['motion']=="2") echo " checked='checked' "?>/> 停止播放
         <input type='radio' name='motion' value="5" <?php if($myLink['motion']=="5") echo " checked='checked' "?>/> 显示暂停广告
         <input type='radio' name='motion' value="3" <?php if($myLink['motion']=="3") echo " checked='checked' "?>/>        	 显示推荐视频</td>
       <td></td>
      </tr>
      <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">自动隐藏控制栏：</td>
       <td align="left" style="padding:3px;">
         <input type='radio' name='cthidden' value="0" <?php if($myLink['cthidden']=="0") echo " checked='checked' "?>/> 不自动隐藏
         <input type='radio' name='cthidden' value="1" <?php if($myLink['cthidden']=="1") echo " checked='checked' "?>/> 仅全屏时自动隐藏
         <input type='radio' name='cthidden' value="2" <?php if($myLink['cthidden']=="2") echo " checked='checked' "?>/> 都自动隐藏</td>
       <td></td>
      </tr>
            <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">控制栏隐藏延时（毫秒）：</td>
       <td align="left" style="padding:3px;">
         <input type="text" name="cthidtime" id="cthidtime" value="<?php echo $myLink['cthidtime']?>" /></td>
       <td></td>
      </tr>
      <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">控制栏隐藏后显示简单进度条：</td>
       <td align="left" style="padding:3px;">
         <input type='radio' name='jindu' value="1" <?php if($myLink['jindu']=="1") echo " checked='checked' "?>/> 是
         <input type='radio' name='jindu' value="0" <?php if($myLink['jindu']=="0") echo " checked='checked' "?>/> 否</td>
       <td></td>
      </tr>
      <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">是否支持单击暂停：</td>
       <td align="left" style="padding:3px;"><input type='radio' name='djzt' value="1" <?php if($myLink['djzt']=="1") echo " checked='checked' "?>/> 是
         <input type='radio' name='djzt' value="0" <?php if($myLink['djzt']=="0") echo " checked='checked' "?>/> 否</td>
       <td></td>
      </tr>
      <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">是否支持双击全屏：</td>
       <td align="left" style="padding:3px;"><input type='radio' name='sjqp' value="1" <?php if($myLink['sjqp']=="1") echo " checked='checked' "?>/> 是
         <input type='radio' name='sjqp' value="0" <?php if($myLink['sjqp']=="0") echo " checked='checked' "?>/> 否</td>
       <td></td>
      </tr>
	  <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">Logo名称：</td>
       <td align="left" style="padding:3px;">
         <input name="logourl" type="text" id="logourl" value="<?php echo $myLink['logourl']?>" style='width:95%;' class='pubinputs' /></td>
       <td>需按ckpalyer要求放入指定位置。</td>
      </tr>	  
      <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">是否登陆才能完全播放：</td>
       <td align="left" style="padding:3px;"><input type='radio' name='logged' value="1" <?php if($myLink['logged']=="1") echo " checked='checked' "?>/> 是
         <input type='radio' name='logged' value="0" <?php if($myLink['logged']=="0") echo " checked='checked' "?>/> 否</td>
       <td></td>
      </tr>
	  <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">非登陆可预览秒数：</td>
       <td align="left" style="padding:3px;">
         <input type="text" name="logpretime" id="logpretime" value="<?php echo $myLink['logpretime']?>" /></td>
       <td>设置"登陆才能播放"后有效</td>
      </tr>
      <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">登陆后是否显示广告：</td>
       <td align="left" style="padding:3px;">前置广告：<input type='radio' name='loggedadv' value="1" <?php if($myLink['loggedadv']=="1") echo " checked='checked' "?>/> 是
         <input type='radio' name='loggedadv' value="0" <?php if($myLink['loggedadv']=="0") echo " checked='checked' "?>/> 否
		  || 暂停广告：<input type='radio' name='loggedadvp' value="1" <?php if($myLink['loggedadvp']=="1") echo " checked='checked' "?>/> 是
         <input type='radio' name='loggedadvp' value="0" <?php if($myLink['loggedadvp']=="0") echo " checked='checked' "?>/> 否
		 </td>
       <td></td>
      </tr>
	  <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">视频网站地址：</td>
       <td align="left" style="padding:3px;">
         <input type="text" name="neturl" id="neturl" size="80" value="<?php echo $myLink['neturl']?>" /></td>
       <td>主体网站和视频网站分开放时，设置主体网站的本参数为视频网站wordpress的wp-content地址。例如：http://plugins.jd-app.com/wp-content</td>
      </tr>
	  <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">解析插件选择：</td>
       <td align="left" style="padding:3px;">
        冰冷聚星<input type='radio' name='analynum' value="1" <?php if($myLink['analynum']=="1") echo " checked='checked' "?>/>   
        海洋发布<input type='radio' name='analynum' value="2" <?php if($myLink['analynum']=="2") echo " checked='checked' "?>/>    
        其他解析API<input type='radio' name='analynum' value="0" <?php if($myLink['analynum']=="0") echo " checked='checked' "?>/> 
		 <input type="text" name="analyapi" id="analyapi" size="80" value="<?php echo $myLink['analyapi']?>" />
		<td>及时更新插件，api填写类似：http://www.*******.com/api/***/***.php?url=[$pat]</td>
      </tr>
	  <tr align="center" height="25" bgcolor="#Ffffff">
       <td width="200">是否显示官方视频播放选择：</td>
       <td align="left" style="padding:3px;">
        显示<input type='radio' name='choice' value="black" <?php if($myLink['choice']=="black") echo " checked='checked' "?>/>   
        隐藏<input type='radio' name='choice' value="none" <?php if($myLink['choice']=="none") echo " checked='checked' "?>/>    
		<td></td>
      </tr>     </table>
     
     
     
     <table width="100%" style='display:none' id="td2" border="0" cellspacing="1" cellpadding="1" bgcolor="#D6D6D6">
      <tr align="center" bgcolor="#F6F6F6" height="25">
       <td width="200">参数名称</td>
       <td>参数值</td>
       <td width="310">参数说明</td>
      </tr>
      <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">前置广告内容：</td>
       <td align="left" style="padding:3px;">
         <input name="adpre" type="text" id="adpre" value="<?php echo $myLink['adpre']?>" style='width:95%;' class='pubinputs' /></td>
       <td>图片、flash或视频地址，多个用“|”隔开。</td>
      </tr>
	  <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">前置联盟广告（居中）：</td>
       <td align="left" style="padding:3px;"><textarea name="adprelink" class='pubinputs' id="adprelink" style="width: 95%"  rows="8"><?php echo $myLink['adprelink']?></textarea></td>
       <td>复制联盟广告js代码。<br />覆盖前置广告。</td>
      </tr>
	  <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">前置联盟广告大小位置：</td>
       <td align="left" style="padding:3px;">宽：<input name="adprew" type="text" id="adprew" size="3" value="<?php echo $myLink['adprew']?>" class='pubinputs' />px
	   ||  高：<input name="adpreh" type="text" id="adpreh" size="3" value="<?php echo $myLink['adpreh']?>" class='pubinputs' />px
   	   ||  左右：<input name="adprelr" type="text" id="adprelr" size="3" value="<?php echo $myLink['adprelr']?>" class='pubinputs' />px
	   ||  上下：<input name="adpreud" type="text" id="adpreud" size="3" value="<?php echo $myLink['adpreud']?>" class='pubinputs' />px

	   </td>
       <td>前置联盟广告大小最好大于等于暂停联盟广告大小</td>
      </tr>






	  <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">前置联盟广告（靠下）：</td>
       <td align="left" style="padding:3px;"><textarea name="adprelink2" class='pubinputs' id="adprelink2" style="width: 95%"  rows="8"><?php echo $myLink['adprelink2']?></textarea></td>
       <td>复制联盟广告js代码。</td>
      </tr>
	  <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">前置联盟广告2大小位置：</td>
       <td align="left" style="padding:3px;">宽：<input name="adprew2" type="text" id="adprew2" size="3" value="<?php echo $myLink['adprew2']?>" class='pubinputs' />px  
	   ||  高：<input name="adpreh2" type="text" id="adpreh2" size="3" value="<?php echo $myLink['adpreh2']?>" class='pubinputs' />px
	   ||  左右：<input name="adprelr2" type="text" id="adprelr2" size="3" value="<?php echo $myLink['adprelr2']?>" class='pubinputs' />px
	   ||  上下：<input name="adpreud2" type="text" id="adpreud2" size="3" value="<?php echo $myLink['adpreud2']?>" class='pubinputs' />px
	   </td>
       <td>前置联盟广告2大小最好大于等于暂停联盟广告2大小</td>
      </tr>









      <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">前置广告链接：</td>
       <td align="left" style="padding:3px;"><input name="adpreurl" type="text" id="adpreurl" value="<?php echo $myLink['adpreurl']?>" class='pubinputs' style='width:95%;' /></td>
       <td>当前置广告的连接，多个请按广告的顺序用“|”隔开。</td>
      </tr>
      <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">前置广告时间：</td>
       <td align="left" style="padding:3px;"><input name="adpretime" type="text" id="adpretime" size="10" value="<?php echo $myLink['adpretime']?>" class='pubinputs' /> (前置广告显示的时间[单位：秒]，多个用“|”隔开。)</td>
       <td>cfg_backup_dir</td>
      </tr>
      <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">前置广告播放方式：</td>
       <td align="left" style="padding:3px;"><input type='radio' name='qzggss' value="1" <?php if($myLink['qzggss']=="1") echo " checked='checked' "?>/> 随机播放
         <input type='radio' name='qzggss' value="0" <?php if($myLink['qzggss']=="0") echo " checked='checked' "?>/> 顺序播放</td>
       <td></td>
      </tr>
      <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">前置广告跳过按钮：</td>
       <td align="left" style="padding:3px;"><input type='radio' name='jpbut' value="1" <?php if($myLink['jpbut']=="1") echo " checked='checked' "?>/> 显示
         <input type='radio' name='jpbut' value="0" <?php if($myLink['jpbut']=="0") echo " checked='checked' "?>/> 不显示
		 <input type='radio' name='jpbut' value="2" <?php if($myLink['jpbut']=="2") echo " checked='checked' "?>/> 仅登陆显示
		 </td>
       <td></td>
      </tr>
      <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">前置广告静音按钮：</td>
       <td align="left" style="padding:3px;"><input type='radio' name='qzjingyin' value="1" <?php if($myLink['qzjingyin']=="1") echo " checked='checked' "?>/> 显示
         <input type='radio' name='qzjingyin' value="0" <?php if($myLink['qzjingyin']=="0") echo " checked='checked' "?>/> 不显示</td>
       <td></td>
      </tr>
      </table>
      
      
      
      <table width="100%" style='display:none' id="td3" border="0" cellspacing="1" cellpadding="1" bgcolor="#D6D6D6">
      <tr align="center" bgcolor="#F6F6F6" height="25">
       <td width="200">参数名称</td>
       <td>参数值</td>
       <td width="310">参数说明</td>
      </tr>
      <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">暂停广告内容：</td>
       <td align="left" style="padding:3px;"><input name="adpau" type="text" id="adpau"  value="<?php echo $myLink['adpau']?>" class='pubinputs' style='width:95%;' /></td>
       <td>图片或flash地址，不支持视频，多个请用“|”隔开。</td>
      </tr>
      <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">暂停广告链接：</td>
       <td align="left" style="padding:3px;"><input name="adpauurl" type="text" id="adpauurl" style='width:95%;' class='pubinputs' value="<?php echo $myLink['adpauurl']?>" /></td>
       <td>暂停广告的连接，多个请按广告的顺序用“|”隔开。</td>
      </tr>
	  <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">暂停联盟广告（居中）：</td>
       <td align="left" style="padding:3px;"><textarea name="adprelinkp" class='pubinputs' id="adprelinkp" style="width: 95%"  rows="8"><?php echo $myLink['adprelinkp']?></textarea></td>
       <td>复制联盟广告js代码。<br />覆盖暂停广告。<br />兼作缓冲广告。</td>
      </tr>
	  <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">暂停联盟广告大小位置：</td>
       <td align="left" style="padding:3px;">宽：<input name="adprepw" type="text" id="adprepw" size="3" value="<?php echo $myLink['adprepw']?>" class='pubinputs' />px  
	   ||  高：<input name="adpreph" type="text" id="adpreph" size="3" value="<?php echo $myLink['adpreph']?>" class='pubinputs' />px
	   ||  左右：<input name="adpreplr" type="text" id="adpreplr" size="3" value="<?php echo $myLink['adpreplr']?>" class='pubinputs' />px
	   ||  上下：<input name="adprepud" type="text" id="adprepud" size="3" value="<?php echo $myLink['adprepud']?>" class='pubinputs' />px
	   </td>
       <td></td>
      </tr>

	  
	  
	  <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">暂停联盟广告（靠下）：</td>
       <td align="left" style="padding:3px;"><textarea <?php $today = date(time());if(($myLink['indate']+604800) >= $today ){ echo "readOnly";} ?> name="adprelinkp2" class='pubinputs' id="adprelinkp2" style="width: 95%"  rows="8"><?php echo $myLink['adprelinkp2']?></textarea></td>
       <td>请大家支持下作者，<br />将本段广告代码放在您网站1周，<br />插件启用1周后可自由修改，谢谢！。</td>
      </tr>
	  <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">暂停联盟广告2大小位置：</td>
       <td align="left" style="padding:3px;">宽：<input name="adprepw2" type="text" id="adprepw2" size="3" value="<?php echo $myLink['adprepw2']?>" class='pubinputs' />px  
	   ||  高：<input name="adpreph2" type="text" id="adpreph2" size="3" value="<?php echo $myLink['adpreph2']?>" class='pubinputs' />px
	   ||  左右：<input name="adpreplr2" type="text" id="adpreplr2" size="3" value="<?php echo $myLink['adpreplr2']?>" class='pubinputs' />px
	   ||  上下：<input name="adprepud2" type="text" id="adprepud2" size="3" value="<?php echo $myLink['adprepud2']?>" class='pubinputs' />px	   
	   </td>
       <td>前置联盟广告2大小最好大于等于暂停联盟广告2大小</td>
      </tr>
      <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">暂停广告关闭按钮：</td>
       <td align="left" style="padding:3px;"><input type='radio' name='ztcls' value="1" <?php if($myLink['ztcls']=="1") echo " checked='checked' "?>/> 显示
         <input type='radio' name='ztcls' value="0" <?php if($myLink['ztcls']=="0") echo " checked='checked' "?>/> 不显示</td>
       <td></td>
      </tr>
      </table>
      
      
      <table width="100%" style='display:none' id="td4" border="0" cellspacing="1" cellpadding="1" bgcolor="#D6D6D6">
      <tr align="center" bgcolor="#F6F6F6" height="25">
       <td width="200">参数名称</td>
       <td>参数值</td>
       <td width="310">参数说明</td>
      </tr>
      <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">是否开启滚动文字广告：</td>
       <td align="left" style="padding:3px;"><input type='radio' name='opmarquee' value="2" <?php if($myLink['opmarquee']=="2") echo " checked='checked' "?>/> 是
         <input type='radio' name='opmarquee' value="0" <?php if($myLink['opmarquee']=="0") echo " checked='checked' "?>/> 否</td>
       <td></td>
      </tr>
      <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">滚动文字广告内容：</td>
       <td align="left" style="padding:3px;"><textarea  name="admar" id="admar" class='pubinputs' class='textarea_info' row='4' style='width:98%;height:50px'><?php echo $myLink['admar']?></textarea>
       </td>
       <td>播放器顶部滚动显示的文字，限250字。</td>
      </tr>
      <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">滚动文字广告链接：</td>
       <td align="left" style="padding:3px;"><input name="admarurl" type="text" id="admarurl" style='width:95%;' class='pubinputs' value="<?php echo $myLink['admarurl']?>" /></td>
       <td>滚动文字广告的链接。</td>
      </tr>
      <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">缓冲广告内容：</td>
       <td align="left" style="padding:3px;"><input name="adbuffer" type="text" id="adbuffer" style='width:95%;' class='pubinputs' value="<?php echo $myLink['adbuffer']?>" />
       </td>
       <td>图片或flash，但是图片没有链接。</td>
      </tr>
      </table>
      
      
      
      <table width="100%" style='display:none' id="td5" border="0" cellspacing="1" cellpadding="1" bgcolor="#D6D6D6">
      <tr align="center" bgcolor="#F6F6F6" height="25">
       <td width="200">参数名称</td>
       <td>参数值</td>
       <td width="310">参数说明</td>
      </tr>
      <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">版权密钥：</td>
       <td align="left" style="padding:3px;"><input name="ckkey" type="text" id="ckkey" style='width:95%;' class='pubinputs' value="<?php echo $myLink['ckkey']?>" /></td>
       <td>32位版权密钥（<a href="http://www.ckplayer.com/manual.php?id=18" target="_blank">点此查看购买使用说明</a>）</td>
      </tr>
      <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">版权名：</td>
       <td align="left" style="padding:3px;"><input name="ckname" type="text" id="ckname" style='width:95%;' class='pubinputs' value="<?php echo $myLink['ckname']?>" /></td>
       <td>版权密钥对应的版权名</td>
      </tr>
      <tr align="center" height="25" bgcolor="#ffffff">
       <td width="200">版权链接：</td>
       <td align="left" style="padding:3px;"><input name="ckurl" type="text" id="ckurl" style='width:95%;' class='pubinputs' value="<?php echo $myLink['ckurl']?>" /></td>
       <td>右键版权的链接地址</td>
      </tr>
      <tr align="center" height="25" bgcolor="#F6F6F6">
       <td width="200">自定义版本：</td>
       <td align="left" style="padding:3px;"><input name="ckver" type="text" id="ckver" style='width:95%;' class='pubinputs' value="<?php echo $myLink['ckver']?>" /></td>
       <td>自定义播放器版本号</td>
      </tr>
      </table>
      <table width="100%" border="0" cellspacing="1" cellpadding="1"  style="border:1px solid #D6D6D6;border-top:none;">
      <tr bgcolor="#F6F6F6">
        <td width="100" height="51">&nbsp;</td>
        <td>
        	<input type="submit" name="option_save" value=" 提 交 " class="np coolbg" />　 　
          <input type="reset" name="Submit" value=" 返 回 " onClick="location.href='<?php echo $ENV_GOBACK_URL?>';" class="np coolbg" />
         </td>
      </tr>
    </table>
   </form>
   
   </td>
  </tr>
</table>
<script type="text/javascript">
<?php $today = date(time()); if($myLink['indate']+604800 > $today ){ echo "document.getElementById(\"adprelinkp2\").readOnly=true;";}?>
    var text = document.getElementById("volume");
	text.onkeyup = function(){
		this.value=this.value.replace(/\D/g,'');
		if(text.value>100){
			text.value = 100;
		}
    }
</script>
</body>
</html>