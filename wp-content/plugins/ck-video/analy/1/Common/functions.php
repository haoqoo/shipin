<?php
define ("__CQ__", "cq");
define ("__GQ__", "gq");
define ("__BQ__", "bq");
$hosturl= $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
@list($hosturl,$end)=explode('?',$hosturl);
define ("__HOSTURL__", 'http://'.$hosturl);
unset($end,$hosturl);
function get_xml($data)
{
	header('Content-Type:text/xml;charset=utf-8');
	
	$urls=$data['urls'];
	$vars=$data['vars'];
	$urllist='';
	foreach($urls as $key=>$value){
		$urllist.='		<video>'.chr(13);
		$urllist.="			<file><![CDATA[".$urls[$key]['url']."]]></file>".chr(13);
		if(isset($urls[$key]['sec'])){
			if(!isset($urls[$key]['size']))$urls[$key]['size']=0;
			$urllist.="			<size>".$urls[$key]['size']."</size>".chr(13);
			$urllist.="			<seconds>".$urls[$key]['sec']."</seconds>".chr(13);
		}
		$urllist.='		</video>'.chr(13);
	}
	$urllist2 = '';
	$urllist2.='<?xml version="1.0" encoding="utf-8"?>'.chr(13);
	$urllist2.='	<player>'.chr(13);
	$urllist2.='	<flashvars>'.chr(13);
	$urllist2.='		'.$vars.''.chr(13);
	$urllist2.='	</flashvars>'.chr(13);
	$urllist2.=$urllist;
	$urllist2.='	</player>';
	echo $urllist2;
}
function getip() {
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown'))
	{$ip = getenv('HTTP_CLIENT_IP');}
	elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown'))
	{$ip = getenv('HTTP_X_FORWARDED_FOR');}
	elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown'))
	{$ip = getenv('REMOTE_ADDR');}
	elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown'))
	{$ip = $_SERVER['REMOTE_ADDR'];}
	return preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : false;
}
function get_curl_contents($url,$header=0,$nobody=0,$ipopen=0)
{
		if (!function_exists('curl_init')) showMsg('您的主机未开启 php_curl.dll 扩展');
		
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);
		curl_setopt($c, CURLOPT_HEADER, $header);
		curl_setopt($c, CURLOPT_NOBODY, $nobody);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($c, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		$ipopen==0&&curl_setopt($c, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:'.$_SERVER["REMOTE_ADDR"], 'CLIENT-IP:'.$_SERVER["REMOTE_ADDR"]));
		$content = curl_exec($c);
		curl_close($c);
	return $content;
}
function urldebug($url,$off = true)
{
	showMsg('Do not submit address!');
	
	$data['status'] = -1;
	$data['msg'] = '该地址不能正常解析，已经记录，会在最短的时间内解决该问题';
	$data['url'] = $url;
	if($off == false){
		$url= 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		$out = 'http://debug.flv.pw/urldebug.php?url='.base64_encode($url);
		if($out != '1'){
			$data['msg'] = '该地址不能正常解析，地址记录无法正常记入数据库';
		}
	}
	echo json_encode($data);
	die;
}
function showMsg($msg = NULL)
{
	if ($msg == NULL) exit(0);
	
	header('Content-Type:text/html;charset=utf-8');
	
	$info = '<!DOCTYPE html><html><head><style type="text/css">html,body,div{margin:0;padding:0;}</style></head><body>';
	$css = 'width:800px;height:32px;line-height:32px;border-left:4px solid #7ad03a;background:#FCE9AE;color:#E2873E;font-size:12px;margin:100px auto;padding-left:10px ';
	$info .= "<div style='$css'>$msg</div></body></html>";die($info);
}
function escape($str, $reString = ''){
preg_match_all("/[\x80-\xff].|[\x01-\x7f]+/",$str,$newstr);
$ar = $newstr[0];
foreach($ar as $k=>$v){
	if(ord($ar[$k])>=127){
		$tmpString=bin2hex(iconv("GBK","ucs-2//IGNORE",$v));
		if (!preg_match("/WIN/i", PHP_OS)){
			$tmpString = substr($tmpString,2,2).substr($tmpString,0,2);
		}
		$reString.="%u".$tmpString;
	}else{
		$reString.= rawurlencode($v);
	}
}
return $reString;
}
function unescape($str) { 
$str = rawurldecode($str); 
preg_match_all("/%u.{4}|&#x.{4};|&#d+;|.+/U",$str,$r); 
$ar = $r[0]; 
foreach($ar as $k=>$v) { 
if(substr($v,0,2) == "%u") 
$ar[$k] = iconv("UCS-2","GBK",pack("H4",substr($v,-4))); 
elseif(substr($v,0,3) == "&#x") 
$ar[$k] = iconv("UCS-2","GBK",pack("H4",substr($v,3,-1))); 
elseif(substr($v,0,2) == "&#") { 
$ar[$k] = iconv("UCS-2","GBK",pack("n",substr($v,2,-1))); 
} 
} 
return join("",$ar); 
}
function IsMediaFile($url)
{
	$ext[] = '.mp4';
	$ext[] = '.flv';
	$ext[] = '.f4v';
	$ext[] = '.hlv';
	
	foreach ($ext as $value){
		if (stripos($url, $value)) return true;
	}
	return false;
}
function makexml($url){
	$stream['urls'][0]['url'] = $url;
	$stream['vars'] = '{h->3}';
	die(get_xml($stream));
}
?>