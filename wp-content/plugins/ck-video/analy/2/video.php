<?php
error_reporting(0);
header("Content-Type: text/html; charset=utf-8"); // 设置网页编码，根据实际需要修改

/****
网址解析版本
本插件由 漫漫看 www.mmkan.com 网站友情提供。
仅用于网络技术学习之目的，禁止用于商业及违法用途。
不承担由本插件带来的任何责任。
版本：1.7
开发：蓝色海洋
******/


$v=$_GET["url"];
if(empty($v))
{echo '播放地址为空，播放失败，请重试或向管理员报告此错误！';}

$b=base64_encode($v);

/*** 超清 ***/
if(strlen(file_get_contents("http://api.flvxz.com/url/$b/xmlformat/ckxml/quality/6LaF5riF"))>100)
{
$p="http://api.flvxz.com/url/$b/xmlformat/ckxml/quality/6LaF5riF";
$q='超清';
}

/*** 高清 ***/
elseif(strlen(file_get_contents("http://api.flvxz.com/url/$b/xmlformat/ckxml/quality/6auY5riF"))>100)
{
$p="http://api.flvxz.com/url/$b/xmlformat/ckxml/quality/6auY5riF";
$q='高清';
}

/*** FLV高清 ***/
elseif(strlen(file_get_contents("http://api.flvxz.com/url/$b/xmlformat/ckxml/quality/RkxW6auY5riF"))>100)
{
$p="http://api.flvxz.com/url/$b/xmlformat/ckxml/quality/RkxW6auY5riF";
$q='高清';
}

/*** 标清 ***/
elseif(strlen(file_get_contents("http://api.flvxz.com/url/$b/xmlformat/ckxml/quality/5qCH5riF"))>100)
{
$p="http://api.flvxz.com/url/$b/xmlformat/ckxml/quality/5qCH5riF";
$q='标清';
}

/*** 流畅 ***/
elseif(strlen(file_get_contents("http://api.flvxz.com/url/$b/xmlformat/ckxml/quality/5rWB55WF"))>100)
{
$p="http://api.flvxz.com/url/$b/xmlformat/ckxml/quality/5rWB55WF";
$q='流畅';
}

/*** 极速 ***/
elseif(strlen(file_get_contents("http://api.flvxz.com/url/$b/xmlformat/ckxml/quality/5p6B6YCf"))>100)
{
$p="http://api.flvxz.com/url/$b/xmlformat/ckxml/quality/5p6B6YCf";
$q='急速';
}

/*** MP4 ***/
elseif(strlen(file_get_contents("http://api.flvxz.com/url/$b/xmlformat/ckxml/quality/TVA0"))>100)
{
$p="http://api.flvxz.com/url/$b/xmlformat/ckxml/quality/TVA0";
$q='标清';
}

/*** 其它 ***/
else
{
$p="http://api.flvxz.com/url/$b/xmlformat/ckxml";
$q='未知';
}

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo  file_get_contents($p);
?>
