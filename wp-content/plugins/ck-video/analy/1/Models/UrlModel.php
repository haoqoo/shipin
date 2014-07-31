<?php
function getvideo($id,$pid='2'){
	return geturl($id);
	$urllist['urls'][0]['url'] = $id;
	$urllist['vars']='{h->3}{a->'.$id.'}';
	return $urllist;
}

// Powered by 景 辰
function geturl($query){
	$url = 'http://www.flvcd.com/parse.php?kw='.escape($query);
	$result = str_cut(iconv('gb2312', 'utf-8', get_curl_contents($url)), 'name="inf" value="', '"');
	
	if (!empty($result) && substr($result, -1) == '|')
	{
		$urlstr = array_filter(explode('|', $result));
		
		foreach ($urlstr as $index => $value) {
			@$stream['urls'][$index]['url'] = $value;
		}
		$stream['vars']='{h->3}{a->'.$query.'}{f->'.__HOSTURL__.'?url=[$pat1]}';
		return $stream;
	}
	showMsg('不能正常解析此资源');
}
function str_cut($content, $firt, $last){ // 字符串分割
	$start = strpos($content, $firt);
	if ( $start > 0 ) {
		$start += strlen($firt);
		$ending = strpos($content, $last, $start);
		if ( $ending > 0 ) {
			return substr($content, $start, $ending - $start);
		}
	}
	return '';
}
?>