<?php
include_once('vids.php');
include_once('functions.php');
$data = getvideoid($_GET["url"]);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_GET["content"];?></title>
</head>

<body>
<?php if($data['type'] == 'youku'){?>
<p style="text-align: center;">
<embed src="http://player.youku.com/player.php/sid/<?php echo $data['id']; ?>/v.swf" allowFullScreen="true" quality="high" width="90%" height="90%" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>
</p>
<?php }elseif($data['type'] == 'tudou'){?>
<p style="text-align: center;">
<embed src="http://www.tudou.com/l/uEzdxom13wk/&bid=05&iid=<?php echo $data['id']; ?>&resourceId=0_05_05_99/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque" width="95%" height="95%"></embed>
</p>
<?php }elseif($data['type'] == 'letv'){?>


<?php }else{}?>
</body>
</html>


