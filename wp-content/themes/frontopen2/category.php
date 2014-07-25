<?php 
global $wp_query;
$cat_ID = get_query_var('cat');
$picCat = array();
foreach($picCat as $key){
	if($key == $cat_ID){
		get_template_part( 'loop', 'categorypic'); 
		die;}
}
get_template_part( 'loop', 'category'); 
?>
