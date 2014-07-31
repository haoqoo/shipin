<?php
function getMobileurl($url){
if(strpos($url,'youku.com')){
      $data = getvideoid($url);
      $Mobileurl = 'http://m.youku.com/wap/pvs?id='.$data['id'].'&format=3gphd->video/mp4';
	  return $Mobileurl;
   }elseif(strpos($url,'tudou.com')){
      $data = getvideoid($url);
      if($data['type'] == 'youku'){
	  $Mobileurl = 'http://m.youku.com/wap/pvs?id='.$data['id'].'&format=3gphd->video/mp4';
	  return $Mobileurl;
	  }else{
      $Mobileurl = 'http://vr.tudou.com/v2proxy/v2.m3u8?it='.$data['id'].'&st=2&pw=->video/mp4';
	  return $Mobileurl;
         }
	 }else{
     return null;
}
}

?>