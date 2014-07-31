<?php
function getvideo($id,$pid=2){
	$xml = simplexml_load_file(getApi().$id);
	if (property_exists($xml, 'msg')) return '';
	return array(
		'urls' => array(0 => array(
				'url' => $xml->vd->vi->url,
				'size' => $xml->vd->vi->fs,
				'sec' => $xml->vd->vi->dur
			)
		),
		'vars' => '{h->3}{a->'.$id.'_qq}{f->'.__HOSTURL__.'?url=[$pat1]}'
	);
	return '';
}
function getApi(){
	return pack("H*", '687474703a2f2f76762e766964656f2e71712e636f6d2f67657475726c3f7669643d');
}
?>