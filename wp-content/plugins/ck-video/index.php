<?php
$wpconfig = realpath("../../../wp-config.php");
if (!file_exists($wpconfig))  {
	echo "Could not found wp-config.php. Error in path :\n\n".$wpconfig ;	
	die;	
}
require_once($wpconfig);
//require_once(ABSPATH.'/wp-admin/admin.php');
$ckdata = get_option('ck_video_option');
include_once('./Mobile.php');
include_once('./analy/1/Common/vids.php');
include_once('./analy/1/Common/functions.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_GET["content"];?></title>
</head>

<body>

<script language="javascript">
var ckdata=new Array();
<?php 
foreach($ckdata as $key=>$value){
    if($key!='adprelink'&&$key!='adprelink2'&&$key!='adprelinkp'&&$key!='adprelinkp2'){
	if($key=='jpbut'&&is_user_logged_in()&&$value==2){$value = 1;}elseif($key=='jpbut'&&is_user_logged_in()==false&&$value==2){$value = 0;}
    echo "ckdata['$key'] ='$value';\n";
	}}

?>

</script>

<div id="video" style="position:relative;z-index: 100;width:95%;height:95%;margin:0 auto;">
<div id="a1"></div>
<div id="adv" style="z-index:30;width:100%;height:100%;">
<div id="adv1" style="z-index:30;position:absolute;text-align:center;width:<?php echo $ckdata[adprew];?>px;display:block;height:<?php echo $ckdata[adpreh]?>px;left:50%;top:50%; margin-top: -<?php echo $ckdata[adpreh]/2+$ckdata[adpreud];?>px;margin-left: -<?php echo $ckdata[adprew]/2+$ckdata[adprelr]?>px;" >
<?php if($ckdata[loggedadv]==0&&is_user_logged_in()){}else{?>
<?php echo $ckdata[adprelink]?>
<?php }?>
</div>

<div  id="adv2" style="z-index:30;position:absolute;text-align:center;width:<?php echo $ckdata[adprew2]?>px;display:block;height:<?php echo $ckdata[adpreh2]?>px;left:50%;top:50%; margin-top: <?php echo $ckdata[adpreh]/2-$ckdata[adpreud2]?>px;margin-left: -<?php echo $ckdata[adprew2]/2+$ckdata[adprelr2]?>px;">
<?php if($ckdata[loggedadv]==0&&is_user_logged_in()){}else{?>
<?php echo $ckdata[adprelink2]?>
<?php }?>
</div>

</div>
<div id="advp" style="z-index:25;display:none;width:100%;height:100%;">
<div  id="advp1" style="z-index:25;position:absolute;text-align:center;width:<?php echo $ckdata[adprepw]?>px;display:block;height:<?php echo $ckdata[adpreph]?>px;left:50%;top:50%; margin-top: -<?php echo $ckdata[adpreph]/2+$ckdata[adprepud]?>px;margin-left: -<?php echo $ckdata[adprepw]/2+$ckdata[adpreplr]?>px;">
<?php if($ckdata[loggedadvp]==0&&is_user_logged_in()){}else{?>
<?php echo $ckdata[adprelinkp]?>
<?php }?>
</div>

<div  id="advp2" style="z-index:25;position:absolute;text-align:center;width:<?php echo $ckdata[adprepw2]?>px;display:block;height:<?php echo $ckdata[adpreph2]?>px;left:50%;top:50%;margin-top: <?php echo $ckdata[adpreph]/2-$ckdata[adprepud2]?>px;margin-left: -<?php echo $ckdata[adprepw2]/2+$ckdata[adpreplr2]?>px;">
<?php if($ckdata[loggedadvp]==0&&is_user_logged_in()){}else{?>
<?php echo $ckdata[adprelinkp2]?>
<?php }?>
</div>

</div>

<div id="login" style="z-index:40;position:absolute;text-align:center;width:600px;display:none;height:400px;left:50%;top:50%; background-color:#FFF;margin-top: -200px;margin-left: -300px;">
<div>登陆后才能继续播放</div>
	<!-- if not logged -->
	<form action="<?php echo wp_login_url( get_permalink() ); ?>" method="post" id="loginform">
		<div class="loginblock">

			<p class="login"><input type="text" name="log" id="log" size="" tabindex="11" /></p>
			<p class="password"><input type="password" name="pwd" id="pwd"  size="" tabindex="12" /></p>
			<p class="lefted"><button value="Submit" id="submit_t" type="submit" tabindex="13">登&nbsp;录</button></p>
			
		</div>
		<input type="hidden" name="redirect_to" value="<?php echo $_SERVER[ 'REQUEST_URI' ]; ?>" />
		<input type="checkbox" name="rememberme" id="modlogn_remember" value="yes"  checked="checked" alt="Remember Me" />下次自动登录
	</form>
</div>

</div>
<script type="text/javascript" src="ckplayer/ckplayer.js" charset="utf-8"></script>
<script type="text/javascript">
function Extension(str){
        var ext='';
        if(str){
                var file=str.toLowerCase();        
                var filearr=file.split('.');
                var exten=filearr[filearr.length-1];
                if(exten=='flv' || exten=='f4v' || exten=='mp4' || exten=='rmov'){
                        ext='video';        
                }
        }
        return ext;
}
var _f='';//定义调用视频的f值
var _a='';//同上，定义a值
var _s=0;//同上，定义s值

var _flv="<?php echo $_GET["url"];?>";
if(Extension(_flv)){//如果是普通视频的话
        _f=_flv;
        _s=0;
}
else{//如果不是的话就使用另一种调用方式
        _f='<?php if($ckdata[analynum]==0){echo $ckdata[analyapi];}else{ $siturl=get_option('siteurl');echo $siturl.'/wp-content/plugins/ck-video/analy/'.$ckdata[analynum].'/video.php?url=[$pat]';}?>';
        _a=encodeURIComponent(_flv);
        _s=2;
}
	//如果你不需要某项设置，可以直接删除，注意var flashvars的最后一个值后面不能有逗号
function ckvplay(){
	var flashvars={
        f:_f,
        a:_a,
        s:_s,
		c:'0',//是否读取文本配置,0不是，1是
		x:'',//调用xml风格路径，为空的话将使用ckplayer.js的配置
		i:'',//初始图片地址
		d:'<?php if($ckdata[loggedadvp]==0&&is_user_logged_in()){}else{echo $ckdata[adpau];}?>',//暂停时播放的广告，swf/图片,多个用竖线隔开，图片要加链接地址，没有的时候留空就行
		u:'<?php echo $ckdata[adpauurl]?>',//暂停时如果是图片的话，加个链接地址
		l:'<?php if($ckdata[loggedadv]==0&&is_user_logged_in()){}else{echo $ckdata[adpre];}?>',//前置广告，swf/图片/视频，多个用竖线隔开，图片和视频要加链接地址
		r:'<?php echo $ckdata[adpreurl]?>',//前置广告的链接地址，多个用竖线隔开，没有的留空
		t:'<?php echo $ckdata[adpretime]?>',//视频开始前播放swf/图片时的时间，多个用竖线隔开
		y:'',//这里是使用网址形式调用广告地址时使用，前提是要设置l的值为空
		z:'<?php echo $ckdata[adbuffer]?>',//缓冲广告，只能放一个，swf格式
		e:'<?php echo $ckdata[motion]?>',//视频结束后的动作，0是调用js函数，1是循环播放，2是暂停播放并且不调用广告，3是调用视频推荐列表的插件，4是清除视频流并调用js功能和1差不多，5是暂停播放并且调用暂停广告
		v:'<?php echo $ckdata[volume]?>',//默认音量，0-100之间
		p:'<?php echo $ckdata[ckpause]?>',//视频默认0是暂停，1是播放
		h:'0',//播放http视频流时采用何种拖动方法，=0不使用任意拖动，=1是使用按关键帧，=2是按时间点，=3是自动判断按什么(如果视频格式是.mp4就按关键帧，.flv就按关键时间)，=4也是自动判断(只要包含字符mp4就按mp4来，只要包含字符flv就按flv来)
		q:'',//视频流拖动时参考函数，默认是start
		m:'0',//默认是否采用点击播放按钮后再加载视频，0不是，1是,设置成1时不要有前置广告
		o:'',//当m=1时，可以设置视频的时间，单位，秒
		w:'',//当m=1时，可以设置视频的总字节数
		g:'',//视频直接g秒开始播放
		j:'',//视频提前j秒结束
		k:'',//提示点时间，如 30|60鼠标经过进度栏30秒，60秒会提示n指定的相应的文字
		n:'',//提示点文字，跟k配合使用，如 提示点1|提示点2
		b:'0',
		my_url:encodeURIComponent(window.location.href)//本页面地址
		//调用播放器的所有参数列表结束
		};
	var params={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always'};//这里定义播放器的其它参数如背景色（跟flashvars中的b不同），是否支持全屏，是否支持交互
	var attributes={id:'ckplayer_a1',name:'ckplayer_a1',menu:'false'};
	//下面一行是调用播放器了，括号里的参数含义：（播放器文件，要显示在的div容器，宽，高，需要flash的版本，当用户没有该版本的提示，加载初始化参数，加载设置参数如背景，加载attributes参数，主要用来设置播放器的id）
	swfobject.embedSWF('ckplayer/ckplayer.swf', 'a1', '100%', '100%', '10.0.0','ckplayer/expressInstall.swf', flashvars, params, attributes);
	/*播放器地址，容器id，宽，高，需要flash插件的版本，flashvars,params,attributes
	  如果你因为目前的swfobject和你项目中的存在冲突，不想用swfobject.embedSWF调用，也可以用如下代码进行调用
	  CKobject.embedSWF('ckplayer/ckplayer.swf','a1','ckplayer_a1','600','400',flashvars,params);
	  CKobject.embedSWF(播放器路径,容器id,播放器id/name,播放器宽,播放器高,flashvars的值,其它定义也可省略);
	  此时可以删除ckplayer.js中的最后一行，交互的部分也要改成CKobject.getObjectById('ckplayer_a1')
	*/
	//调用ckplayer的flash播放器结束

	/*
	下面三行是调用html5播放器用到的
	var video='视频地址和类型';
	var support='支持的平台或浏览器内核名称';	
	*/
    var video=['<?php  $Mobileurl = getMobileurl($_GET["url"]); echo $Mobileurl?>'];
	var support=['iPad','iPhone','ios','android+false','msie10+false'];//默认的在ipad,iphone,ios设备中用html5播放,android,ie10上没有安装flash的也调用html5
	CKobject.embedHTML5('video','ckplayer_a1','100%','100%',video,flashvars,support);
	//如果不想使用html5播放器，只要把上面三行去掉就可以了
}


var _islogin=false;
var _ntime=0;
var _ytime=<?php echo $ckdata[logpretime]?>;//当播放到多少秒时提示登陆



var playtrue=false;//视频默认处于暂停状态
var fulltrue=false;//视频默认处于非全屏状态

function ckplayer_status(str){
		if(str.indexOf('nowtime:')>-1){
			_ntime=parseInt(str.replace('nowtime:',''));
		}
		if(_ntime>=_ytime && !_islogin){
			_islogin=true;
			setTimeout(puuse(),500);
			}
		switch(str){
		case '102':
			playtrue=true;
			advshowp();
			advshow();
			break;
		case '103':
			playtrue=false;
			advshowp();
			break;	
		case '104':
			fulltrue=false;
			advshowp();
			advshow();
			break;	
		case '105':
			fulltrue=true;
			advshowp();
			advshow();
			break;	
		case 'video:Official.NetStatusEvent.NetStream.Buffer.Full':
			playtrue=true;
			advshowp();
			advshow();
			break;
		case 'Buffer:0':
			playtrue=false;
			advshowp();
			break;				
		default:
			break;
	}
	}
	function puuse(){
	<?php if($ckdata[logged]==1){ if ( is_user_logged_in()==false) {?> 
		CKobject.getObjectById('ckplayer_a1').ckplayer_pause();
        CKobject._K_('ckplayer_a1').style.display='none';
		CKobject._K_('login').style.display='block';
	<?php } }?> 
	 }
	function ckadjump(){CKobject.getObjectById('ckplayer_a1').ckplayer_advunload();}



function advshow(){
	if(!playtrue && !fulltrue){
		document.getElementById("adv").style.display='block';
	}
	else{
		document.getElementById("adv").style.display='none';
	}
}
function advshowp(){
	if(!playtrue && !fulltrue){
		document.getElementById("advp").style.display='block';
	}
	else{
		document.getElementById("advp").style.display='none';
	}
}

ckvplay();
</script>

</body>
</html>
