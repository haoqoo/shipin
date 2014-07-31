<?php

/*
	name: video.php
	modify and amend: 景 辰
	contact: QQ-240784861
	demo: http://chinase.duapp.com/
	
	(C) 2014 插件定制或后买请联系作者
*/

error_reporting(0);  // 调试错误请将此语句更改为 error_reporting('E_ALL')

include_once('./Common/functions.php');

if (!empty($_GET['url']))
{
	$port = (intval($_SERVER["SERVER_PORT"]) != 80) ? ':'.$_SERVER["SERVER_PORT"] : "";
	$url = 'http://'.$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
	$url = unescape(end(explode('url=',$url)));
	$arr = explode('_', $url);
	$np=2;
	switch($arr[0]){
		case __CQ__:
			$pid='3';
			setcookie("pidcookie", $pid, time()+360000);
			break;
		case __GQ__:
			$pid='2';
			setcookie("pidcookie", $pid, time()+360000);
			break;
		case __BQ__:
			$pid='1';
			setcookie("pidcookie", $pid, time()+360000);
			break;
		default:
			$pid=$np;
			isset($_COOKIE["pidcookie"])&&$pid=$_COOKIE["pidcookie"];
			!$pid&&$pid=$np;
			break;
	}
	if(strstr($url, 'http://')==false){
		if (substr($url, 0, 7) == 'rtmp://'){
			makexml($url);
		}
		/*if(count($arr)==3){
			$id=$arr[1];
		}else{
			$id=$arr[0];
		}*/
		$type=end($arr);
		$id=strtr($url,array(__BQ__."_" => "", __GQ__."_" => "", __CQ__."_" => "", "_".$type => ""));
		if(strpos($url,'_wd')){
			switch($type){
			case 'wd1':
				$type='youku';
				break;
			case 'wd2':
				$type='tudou';
				break;
			case 'wd3':
				$type='letv';
				break;
			case 'wd4':
				$type='56';
				break;
			case 'wd5':
				$type='ku6';
				break;
			case 'wd6':
				$type = 'sina';
				break;
			case 'wd7':
				$type = 'yyt';
				break;
			default:
				break;
			}
		}
	}else{
		if(strpos($url,'_http://')){
			$url=str_replace($arr[0].'_','',$url);
		}
		if (IsMediaFile($url)) {
			makexml($url);
		}
		/*if(count($arr)==2){
			$url=$arr[1];
		}else{
			$url=$arr[0];
		}*/
		include_once('./Common/vids.php');
		$data=getvideoid($url);
		$id=$data['id'];
		$type=$data['type'];
	}
} else if (isset($_GET['vtype']) && isset($_GET['vid'])) {
		$id = $_GET['vid'];
		$type = $_GET['vtype'];
} else if (isset($_GET['u']))
{
	$url = base64_decode($_GET['u']);
		
	if(preg_match("/^[a-zA-Z0-9-_]{4,41}\.[a-z0-9]{2,12}$/", $url)){
		list($id, $type)=explode('.', $url);
	} else {
		include_once('./Common/vids.php');
			
		@extract(getvideoid($url));
			
		if( @$status < 0 ){
			showMsg('无法识别的url');
		}
	}
} else {
		showMsg('欢迎使用CKPlayer视频解析插件，调用方法请移步至：http://www.ckplayer.com/bbs');
}
if(isset($type)){
	if($type){
		$type=ucfirst(strtolower($type));
		$filename='./Models/'.$type.'Model.php';
		if(file_exists($filename)){
			include_once($filename);
		}else{
			include_once('./Models/UrlModel.php');
			
			// Powered by 景 辰
			switch (strtolower($type)) {
				case 'sina':
					$id = "http://video.sina.com.cn/#$id";
					break;
				case 'yyt':
					$id = "http://v.yinyuetai.com/video/$id";
					break;
				default:
					showMsg('暂不支持此资源的解析');
			}
			
		}
	}else{
		include_once('./Models/UrlModel.php');
	}
}else{
	include_once('./Models/UrlModel.php');
}
if(isset($id)){
	if($id){
		!$pid&&$pid=2;
		//isset($_COOKIE["pidcookie"])&&$pid=$_COOKIE["pidcookie"];
		$t=getvideo($id,$pid);
		echo get_xml($t);
		die;
	}else{
		showMsg('错误的调用参数');
	}
}else{
	showMsg('错误的调用参数');
}
?>