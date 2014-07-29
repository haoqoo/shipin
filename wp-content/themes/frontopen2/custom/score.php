<?php
$oper = $_GET['oper'];
$score = get_post_meta($_GET['postID'], "like", $single = true);
if($oper == "like"){
	$score += 1;
}else{
	$score -= 1;
}
update_post_meta($_GET['postID'], "like", $score);  
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>
<script type="text/javascript">
	window.location.href = "<?php bloginfo('url').'/?p='.$_GET['postID']; ?>";
</script>