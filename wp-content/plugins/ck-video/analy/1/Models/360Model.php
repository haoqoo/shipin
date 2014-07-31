<?php
function getvideo($id,$pid=2){

if(strstr($id,"?nid=")){
           $id = str_replace("amp;","",$id);
           $urlsec=$id;
		   }else{
		    $shareurl = $id;
			$handle = fopen($shareurl, 'r');
			$content = '';
			if($handle==0){return 0; }
			while(!feof($handle)){
			$content .= fread($handle, 8080);
			}
			fclose($handle);	
			$findnid = "nid : '";
			$findsurl = "surl : '";
			$findname = "name : '";
			$findnameend = "',";
			$nidLen = strlen($findnid);
			$surlLen = strlen($findsurl);
			$nameLen = strlen($findname);
			$nidnum = stripos($content, $findnid);
			$surlnum = stripos($content, $findsurl);
			$namenum = stripos($content, $findname);
			$nameendnum = stripos($content, $findnameend, $namenum);
			$flvname = substr($content, $namenum+8, $nameendnum-$namenum-8);
			$urlsec = "http://awertbzgqw.l21.yunpan.cn/videoPlayer/playShare?nid=".substr($content, $nidnum+7, 17)."&type=3&shorturl=".substr($content, $surlnum+8, 13);
			}

 $handle = fopen($urlsec, 'r');
    $content = '';
    while(!feof($handle)){
        $content .= fread($handle, 8080);
    }
    fclose($handle);

	$findflv ="videoUrl: '";
	
	$flvLen = strlen($findflv);

	$flvnum = stripos($content, $findflv);
	$flvnamenum = stripos($content, "',", $flvnum);
	
	$urlflv = substr($content, $flvnum+11, $flvnamenum-$flvnum-6);
	
	$urllist['urls'][0]['url']= substr($content, $flvnum+11, $flvnamenum-$flvnum-11);
	$urllist['vars']='{h->3}{a->'.$qvars.'}{f->'.__HOSTURL__.'?url=[$pat'.($pid-1).']}';
	
	return $urllist;	
	
	
	
 }

?>
