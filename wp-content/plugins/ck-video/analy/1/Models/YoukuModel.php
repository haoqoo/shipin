<?php
function getvideo($id,$pid=2){
	$hz='_youku';
	$content = get_curl_contents('http://v.youku.com/player/getRealM3U8/vid/'.$id.'/type/mp4/v.m3u8');
	$flvdata = (preg_match_all('/#EXTINF:([\d\.]+),\s+(.*)\.ts\?ts_start=/',$content,$matchs) ? $matchs[2] : die());
	//print_r($matchs);die;
	$pido = 1;
	switch($pido){
		case 1:
			$qvars=__BQ__.'_'.$id.$hz;
			break;
		case 2:
			$qvars=__BQ__.'_'.$id.$hz.'|'.__GQ__.'_'.$id.$hz;
			break;
		case 3:
			$qvars=__BQ__.'_'.$id.$hz.'|'.__GQ__.'_'.$id.$hz.'|'.__CQ__.'_'.$id.$hz;
			break;
		case 4:
			$qvars=__BQ__.'_'.$id.$hz.'|'.__GQ__.'_'.$id.$hz.'|'.__CQ__.'_'.$id.$hz.'|'.__YH__.'_'.$id.$hz;
			break;
		default:
			$qvars=$id.$hz;
			break;
	}
	$pid=min($pid,$pido);

	foreach($flvdata AS $k => $v){
		$urllist['urls'][$k]['url'] = $v;
		$urllist['urls'][$k]['sec'] = $matchs[1][$k];
	}
	$urllist['vars']='{h->2}{a->'.$qvars.'}{f->'.__HOSTURL__.'?url=[$pat'.($pid-1).']}';
	return $urllist;
}
?>