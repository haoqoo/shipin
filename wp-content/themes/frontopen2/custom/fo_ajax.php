<?php
$ajaxVal =  $_GET['ajax'];
if($ajaxVal == "getPostViews"){
setPostViews($_GET['postID']);
echo getPostViews($_GET['postID']);
}
?>