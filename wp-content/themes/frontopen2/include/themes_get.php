<?php $FOvison = str_replace('.','',VRESION)?>
<?php wp_enqueue_script("jquery")?>
<script language="javascript" type="text/javascript"> 
function check(){
jQuery.get("<?php bloginfo('template_url');?>/include/getAjax.php", function(result){
	getArr = result.split('|');
	var vs = parseInt(getArr[0]);
	if(vs > 0){
	if(<?php echo $FOvison;?> < vs){
		jQuery('#newvison').text('v'+getArr[0]);
		jQuery('#updata').val('现在更新');
		}else{
			jQuery('#newvison').text("当前已是最新版");
			jQuery('#updata').val('重新安装');
		};
	jQuery('#urlinput').val(getArr[1]);
	jQuery('#updata').fadeIn('300');
	jQuery('#newVS').fadeIn(300)
	}else{
		jQuery('#newvison').text("查询失败");
		jQuery('#newVS').fadeIn(300)
	}
  });
}

</script>

<?php
require_once('pclzip.lib.php'); 

header("content-Type: text/html; charset=utf-8");  //定义编码
set_time_limit (0);//不限时   24 * 60 * 60
//语言包数组
$lang_cn = array (
  '0' => '文件地址',
  '1' => '更新密码',
  '2' => '下载耗时',
  '3' => '微秒,文件大小',
  '4' => '字节',
  '5' => '下载成功',
  '6' => '无效密码',
  '7' => '请重新输入',
  '8' => '远程文件下载',
  '9' => '不能打开文件',
  '10'=> '不能写入文件',
  '11'=> '文件地址',
  '12'=> '下载时间',
  '13'=> '文件不可写入',
  '14'=> '成功地将',
  '15'=> '操作记录成功写入!',
  '16'=> '系统已将此次操作写入日志记录!',
  '17'=> '写入失败',
  '18'=> '文件不存在,试图创建,',
  '19'=> '创建失败！',
  '20'=>'文件大小',
  '21'=>'未知',
  '22'=>'已经下载',
  '23'=>'完成进度',
  '24'=>'必须为绝对地址，且前面要加http://'
);
//China,中文

$twodir = str_replace("http://".$_SERVER['HTTP_HOST'],'',get_bloginfo('url')); //支持二级目录
$Language = $lang_cn;	     //切换语言
$Archives = $_SERVER['DOCUMENT_ROOT'].$twodir.'/wp-content/uploads/FOThemes/log.txt';	     //Log文件
$Folder   = $_SERVER['DOCUMENT_ROOT'].$twodir.'/wp-content/uploads/FOThemes/';     //下载目录
$password = file_get_contents("http://www.frontopen.com/FO_updata.php?key=get");         //管理密码
?>
<!--简单控制地址长度-->
<SCRIPT language=javascript>
function CheckPost()
{
	if (myform.url.value.length<10)
	{
		alert("没有获取到下载地址");
		myform.url.focus();
		return false;
	}
}
</SCRIPT>

<div class="wrap">

<h2>frontopen2主题在线更新</h2>

<form method="post"  name="myform" onSubmit="return CheckPost();">
<div class="login">
<p class="message">当前版本：v<?php echo $FOvison ?></p>
<br />
<p class="message" id="newVS" style="display:none;">最新版本：<span id="newvison">请点击“获取更新”按钮</span></p>
</div>
<br />
<p style="display:none;"><?php echo $Language[0]; ?>: <input name="url" type="text" value="" size="50%"/ id="urlinput"> <font color="red"><?php echo $Language[24]; ?></font></p>
<p><span>frontopen2主题每周六固定更新，请至<a href="http://www.frontopen.com/1378.html" target="_blank">官网</a>获取更新密码。</span><br /></p>
<p><?php echo $Language[1]; ?>: <input value="" name="password" type="password"size="15" /></p>
<input name="" type="button" class="button" onclick="check()" value="获取更新" /> <input style="display:none;" name="submit" type="submit" class="button button-primary" id="updata" value="现在更新" />
</form><br />
<p><span>提示：如果您无法通过后台自动更新进行升级，请手动<a href="http://www.frontopen.com/1378.html" target="_blank">下载最新版本</a>主题通过FTP进行覆盖升级。</span><br /></p>
<div id="result"></div>
<hr />
<br />
<table class="wp-list-table widefat fixed pages">
	<tr>
		<td width="100"><b><?php echo $Language[20]; ?></b></td>
		<td><div id="filesize"><font color="red"><?php echo $Language[21]; ?></font> <?php echo $Language[4]; ?></div></td>
	</tr>
	<tr>
		<td><b><?php echo $Language[22]; ?></b></td><td><div id="downloaded"><font color="red">0</font> <?php echo $Language[4]; ?></div></td>
	</tr>
	<tr>
		<td><b><?php echo $Language[23]; ?></b></td><td><font color="red"><div id="progressbar" style="float:left;width:1px; text-align:center; color:#FFFFFF; background-color:#0066CC"></div><div id="progressText" style=" float:left">0%</div></font></td>
	</tr>
</table>
<!--文件计算、进度显示-->
<script type="text/javascript">
   //文件长度
    var filesize=0;
    function $(obj)
	{
        return document.getElementById(obj);
    }
	//设置文件长度
   function setFileSize(fsize)
   {
     filesize=fsize;
     $("filesize").innerHTML=fsize;
   }
	//设置已经下载的,并计算百分比
   function setDownloaded(fsize)
   {
		$("downloaded").innerHTML=fsize;
		if(filesize>0)
		{
			var percent=Math.round(fsize*100/filesize);
			$("progressbar").style.width=(percent+"%");
			if(percent>0)
			{
				$("progressbar").innerHTML=percent+"%";
				$("progressText").innerHTML="";
			}
			else
			{
				$("progressText").innerHTML=percent+"%";
			}
    
		}
   }

</script>


<?php
//密码验证
if ($_POST['password'] == $password) 
{
	class runtime 
	{
		var $StartTime = 0;
		var $StopTime = 0;
		function get_microtime()
		{
			list($usec, $sec) = explode(' ', microtime());
			return ((float)$usec + (float)$sec);
		}
		function start() 
		{
			$this->StartTime = $this->get_microtime();
		}
		function stop()  
		{
			$this->StopTime = $this->get_microtime();
		}
		function spent() 
		{ 
			return round(($this->StopTime - $this->StartTime) * 1000, 1);
		}
	}

//消耗时间
$runtime= new runtime;
$runtime->start();

// 下载
if (!isset($_POST['submit'])) die();
	$destination_folder = $Folder;
	if(!is_dir($destination_folder))
		mkdir($destination_folder,0777);
$url = $_POST['url'];
$file = fopen ($url, "rb");
if ($file)
{
	// 获取文件大小
	$filesize=-1;
	$headers = get_headers($url, 1);
	if ((!array_key_exists("Content-Length", $headers)))
	{
		 $filesize=0; 
	}
	$filesize= $headers["Content-Length"];
    $newfname = $destination_folder . basename($url);

  //不是所有的文件都会先返回大小的，
  //有些动态页面不先返回总大小，这样就无法计算进度了

	if($filesize != -1)
	{
		echo "<script>setFileSize($filesize);</script>";	//在前台显示文件大小
	}
    $newf = fopen ($newfname, "wb");
    $downlen=0;
    if ($newf)
		while(!feof($file)) {
        $data=fread($file, 1024 * 8 );	//默认获取8K
        $downlen+=strlen($data);	// 累计已经下载的字节数
        fwrite($newf, $data, 1024 * 8 );
        echo "<script>setDownloaded($downlen);</script>";	//在前台显示已经下载文件大小
        ob_flush();
        flush();
    }
}
if ($file) 
{
  fclose($file);
}

if ($newf) 
{
  fclose($newf);
}
    
$runtime->stop();//停止计算

//乱七八糟的东西 -0-；
	$downtime =  '<p>'.$Language[2].':<font color="blue"> '.$runtime->spent().' </font>'.$Language[3].'<font color="blue"> '.$headers["Content-Length"].' </font>'.$Language[4].'.</p><br>';
	$downok  =   '<p><font color="red">'.$Language[5].'！'.date("Y-m-d H:i:s").'</font></p><br>';
}
elseif(isset($_POST['password']))
{
	$passerror = $Language[6].'！'.$Language[7];
	echo "<script>alert('".$passerror."')</script>";
}

//$Export = $downtime.$downok.$passerror;
if(isset($_POST['url']) && ($_POST['password'] == $password)) 
{
	$filename = $Archives;
	$somecontent = $Language[11].': '.$url."\r\n".$Language[2].": ".$runtime->spent().$Language[3].": ".$headers["Content-Length"].$Language[4]."\r\n".$Language[12].': '.date("Y-m-d H:i:s")."\r\n"."\r\n";  
	if (!file_exists($filename))
	{
		$echo_1 = $Language[18];
		if (!fopen($filename, 'w'))
		{
			$echo_2 = $Language[19];
		}
	}
// 文件操作

if (is_writable($filename)) //判断是否可写
{
    if (!$handle = fopen($filename, 'a+')) //打开文件
    {
        $echo_3 = $Language[9].$filename; //当打不开时
    } 
	else
    {
        if (fwrite($handle, $somecontent) === false)//写入
        {
            $echo_4 = $Language[10].$filename;
        } else
        {
			$archive = new PclZip($_SERVER['DOCUMENT_ROOT'].$twodir.'/wp-content/uploads/FOThemes/'.basename($url));
			$themesUrl = $_SERVER['DOCUMENT_ROOT'] . str_replace('http://'.$_SERVER['HTTP_HOST'],'',get_bloginfo('template_url'));
				if ($archive->extract(PCLZIP_OPT_PATH, $themesUrl,
					PCLZIP_OPT_REMOVE_PATH, 'install/release') == 0) {
					die("Error : ".$archive->errorInfo(true));
			}else{echo '<br /><div class="login"><p class="message"><font color="red">升级完成,请手动刷新页面以确认是否升级为最新版本。</font></p></div>';}
        }
        fclose($handle);//关闭连接
    }
} 
else
{
    $echo_6 = $Language[17];
}
}
//$echo = $echo_1.$echo_2.$echo_3.$echo_4.$echo_5.$echo_6;
?>
<br />
<?php $contents = file_get_contents("http://www.frontopen.com/themes_news.html"); echo $contents;?>
<br />

<?php //echo $Export; ?>
<p><font color="blue"><?php //echo $echo; ?></font></p>
</div>


