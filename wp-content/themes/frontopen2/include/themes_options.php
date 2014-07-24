<div class="wrap">
<div id="icon-themes" class="icon32"><br /></div>
<h2>主题设置</h2>
<form method="POST" action="" id="config_from">
<input type="hidden" name="update_themeoptions" value="true" />

<h3>网站标题</h3>
<table class="form-table">
<tr>
<th scope="row">主标题</th>
<td><input type="text" name="fo2_logo" id="fo2_logo" size="50" value="<?php echo get_option('themes_fo2_logo'); ?>"></td>
</tr>
<tr>
<th scope="row">副标题</th>
<td><input type="text" name="fo2_small_title" id="fo2_small_title" size="50" value="<?php echo get_option('themes_fo2_small_title'); ?>"></td>
</tr>
<tr>
<th scope="row">网站logo</th>
<td width="350">
<input type="text" name="fo2_logo_img" id="fo2_logo_img" size="50" value="<?php if(get_option('themes_fo2_logo_img')){ echo get_option('themes_fo2_logo_img');}elseif($_FILES['photo1']['size']){ echo "/". $_FILES['photo1']['name'];} ?>"><br /><input class="button button-primary" type="file" name="photo1"> <input type="submit" name="submit1" value="上传" onclick="picup()" class="button button-primary">

</td>
<td><?php if(get_option('themes_fo2_logo_img')){?><img src="<?php echo get_option('themes_fo2_logo_img'); ?>" /><?php }else{?><img src="http://<?php echo $_SERVER['HTTP_HOST'] ."/". $_FILES['photo1']['name'];?>" /><?php }?></td>
</tr>
</table>
<br /><br />

<h3>favicon图标设置</h3>
<table class="form-table">
<tr>
<th scope="row">favicon图标地址</th>
<td width="350">
<input type="file" name="photo" class="button button-primary">  
<input type="submit" name="submit" value="上传" onclick="picup()" class="button button-primary"><br />
请注意ico图标的文件名必须为favicon.ico才能被浏览器正确识别
</td>
<td><img src="http://<?php echo $_SERVER['HTTP_HOST'] ?>/favicon.ico" /></td>
</tr>
</table>
<br /><br />

<h3>顶部按钮扩展区域</h3>
<table class="form-table">
<tr>
<th scope="row">禁用按钮区域</th>
<td>
<input name="fo2_topbtn_display" type="checkbox" id="fo2_topbtn_display" <?php echo get_option('themes_fo2_topbtn_display'); ?> />
</td>
</tr>
</table>
<br /><br />


<h3>搜索栏文字设置</h3>
<table class="form-table">
<tr>
<th scope="row">搜索栏中的文字</th>
<td><input type="text" name="fo2_search_type" id="fo2_search_type" size="50" value="<?php echo get_option('themes_fo2_search_type'); ?>"></td>
</tr>
<tr>
<th scope="row">搜索按钮文字</th>
<td><input type="text" name="fo2_search_btn" id="fo2_search_btn" size="50" value="<?php echo get_option('themes_fo2_search_btn'); ?>"></td>
</tr>
<tr>
<th scope="row">隐藏搜索框</th>
<td>
<input name="fo2_search_display" type="checkbox" id="fo2_search_display" <?php echo get_option('themes_fo2_search_display'); ?> />
</td>
</tr>
</table>
<br /><br />

<h3>RSS订阅按钮开关</h3>
<table class="form-table">
<tr>
<th scope="row">禁用</th>
<td width="350">
<input name="fo2_btn_rss2" type="checkbox" id="fo2_btn_rss2" <?php echo get_option('themes_fo2_btn_rss2'); ?> />
</td>
<td>如果您不希望在首页导航条上方显示RSS订阅按钮，请点此禁用</td>
</tr>
</table>
<br /><br />


<h3>订阅右侧按钮设置</h3>
<table class="form-table">
<tr>
<th scope="row">按钮文字</th>
<td><input type="text" name="fo2_top_right_btn_text" id="fo2_top_right_btn_text" size="50" value="<?php echo get_option('themes_fo2_top_right_btn_text'); ?>"></td>
</tr>
<tr>
<th scope="row">按钮链接</th>
<td><input type="text" name="fo2_top_right_btn_url" id="fo2_top_right_btn_url" size="50" value="<?php echo get_option('themes_fo2_top_right_btn_url'); ?>"></td>
</tr>
<tr>
<th scope="row">超链接title</th>
<td><input type="text" name="fo2_top_right_btn_title" id="fo2_top_right_btn_title" size="50" value="<?php echo get_option('themes_fo2_top_right_btn_title'); ?>"></td>
</tr>
<tr>
<th scope="row">rel</th>
<td><input type="text" name="fo2_top_right_btn_rel" id="fo2_top_right_btn_rel" size="50" value="<?php echo get_option('themes_fo2_top_right_btn_rel'); ?>"></td>
<td>默认为空，SEO可以使用nofollow，external nofollow</td>
</tr>
<tr>
<th scope="row">超链跳转方式</th>
<td width="350">
<?php $target1 = get_option('themes_fo2_top_right_btn_target'); ?>
<select name ="fo2_top_right_btn_target">
  <option value="_self" <?php if ($target1=="_self") { echo 'selected'; } ?> >_self</option>
  <option value="_blank" <?php if ($target1=="_blank") { echo 'selected'; } ?> >_blank</option>
  <option value="new" <?php if ($target1=="new") { echo 'selected'; } ?> >new</option>
  <option value="_parent" <?php if ($target1=="_parent") { echo 'selected'; } ?> >_parent</option>
  <option value="_top" <?php if ($target1=="_top") { echo 'selected'; } ?> >_top</option>
</select></td>
<td>默认为_self</td>
</tr>
</table>
<br /><br />

<h3>右边栏跟随屏幕滚动模块设置</h3>
<table class="form-table">
<tr>
<th scope="row">模块ID</th>
<td width="350">
<select name ="fo2_sider_roll">
<option value="">--未启用--</option>
<?php
$s=get_option('sidebars_widgets');
$sider_roll = get_option('themes_fo2_sider_roll');

foreach($s['primary-widget-area'] as $skey){
?>
  <option value="<?php echo $skey; ?>" <?php if ($sider_roll==$skey) { echo 'selected'; } ?> ><?php echo $skey ?></option>
<?php }?>
</select>
</td><td>选择需要跟随滚动的模块ID(选项模块对应由上至下的顺序)</td>
</tr>
</table>
<br /><br />

<h3>热门浏览标识</h3>
<table class="form-table">
<tr>
<th scope="row">HOT判断标准值</th>
<td width="350"><input type="text" name="fo2_view_num" id="fo2_view_num" size="50" value="<?php echo get_option('themes_fo2_view_num'); ?>"></td><td>单篇文章浏览n次后在文章尾部追加“HOT”标识</td>
</tr>
<tr>
<th scope="row">显示浏览次数</th>
<td>
<input name="fo2_view_time" type="checkbox" id="fo2_view_time" <?php echo get_option('themes_fo2_view_time'); ?> />
</td>
<td>开启显示浏览次数功能后，上面的HOT判断功能会自动失效。HOT标识位置将显示该文章的阅读次数。</td>
</tr>
</table>
<br /><br />

<h3>捐赠功能的支付宝收款地址</h3>
<table class="form-table">
<tr>
<th scope="row">收款地址</th>
<td width="350"><input type="text" name="fo2_zhifu_url" id="fo2_zhifu_url" size="50" value="<?php echo get_option('themes_fo2_zhifu_url'); ?>"></td><td>如果没有收款地址请<a href="https://me.alipay.com/" target="_blank">点击这里</a>开通</td>
</tr>
<tr>
<th scope="row">开启作者收款</th>
<td>
<input name="fo2_author_jz" type="checkbox" id="fo2_author_jz" <?php echo get_option('themes_fo2_author_jz'); ?> />
</td>
<td>开启作者收款功能后，上面的收款地址将失效。捐赠功能将调取用户填写在个人资料的aim中的地址作为收款地址。开启该功能后请向用户做相应说明。</td>
</tr>
</table>
<br /><br />

<h3>页面加载耗时</h3>
<table class="form-table">
<tr>
<th scope="row">启用</th>
<td width="350">
<input name="fo2_load_time" type="checkbox" id="fo2_load_time" <?php echo get_option('themes_fo2_load_time'); ?> />
</td>
<td>开启后会在页面右下角显示当前页面加载所耗时间，是对当前服务器性能进行评估的重要指标。</td>
</tr>
</table>
<br /><br />

<h3>禁用自动摘要功能</h3>
<table class="form-table">
<tr>
<th scope="row">禁用</th>
<td width="350">
<input name="fo2_auto_zhaiyao" type="checkbox" id="fo2_auto_zhaiyao" <?php echo get_option('themes_fo2_auto_zhaiyao'); ?> />
</td>
<td>如果是文字类型网站，建议使用默认设置。如果是图片类网站，建议禁用自动摘要。注意：禁用自动摘要后，需要手动在文章中插入more标签</td>
</tr>
<tr>
<th scope="row">页面宽度限制</th>
<td width="350"><input type="text" name="fo2_page_width" id="fo2_page_width" size="50" value="<?php echo get_option('themes_fo2_page_width'); ?>"></td><td>设置页面宽度后，PC页面会按照您设定宽度展现页面。强烈建议禁用自动摘要后配合此功能调整页面。（请填入整数）</td>
</tr>
</table>
<br /><br />

<h3>自定义信息设置</h3>
<table class="form-table">
<tr>
<th scope="row">read more文字</th>
<td width="350"><input type="text" name="fo2_readmore" id="fo2_readmore" size="50" value="<?php echo get_option('themes_fo2_readmore'); ?>"></td>
</tr>
<tr>
<th scope="row">捐款说明文字</th>
<td width="350"><input type="text" name="fo2_juankuan" id="fo2_juankuan" size="50" value="<?php echo get_option('themes_fo2_juankuan'); ?>"></td>
</tr>
<tr>
<th scope="row">第三方分享代码</th>
<td width="350"><textarea name="fo2_fenxiang" cols="50" rows="5" id="fo2_fenxiang"><?php echo get_option('themes_fo2_fenxiang'); ?></textarea></td><td>文章结尾处可以插入例如<a href="http://share.baidu.com/" target="_blank">百度分享</a>之类的代码，方便用户将文章分享到社交平台</td>
</tr>
</table>
<br /><br />


<h3>广告位代码管理</h3>
<table class="form-table">
<tr>
<th scope="row">文章页面右侧广告位</th>
<td width="350"><textarea name="fo2_ad_1" cols="50" rows="5" id="fo2_ad_1"><?php echo get_option('themes_fo2_ad_1'); ?></textarea></td><td>建议是矩形广告</td>
</tr>
<tr>
<th scope="row">文章页面相关阅读上方广告位</th>
<td width="350"><textarea name="fo2_ad_2" cols="50" rows="5" id="fo2_ad_2"><?php echo get_option('themes_fo2_ad_2'); ?></textarea></td><td>建议为横幅广告</td>
</tr>
</table>
<br /><br />


<h3>网站底部信息</h3>
<table class="form-table">
<tr>
<th scope="row">备案号</th>
<td width="350"><input type="text" name="fo2_icp" id="fo2_icp" size="50" value="<?php echo get_option('themes_fo2_icp'); ?>"></td>
</tr>
<tr>
<th scope="row">版权信息</th>
<td width="350"><input type="text" name="fo2_copyright" id="fo2_copyright" size="50" value="<?php echo get_option('themes_fo2_copyright'); ?>"></td>
</tr>
<tr>
<th scope="row">网站地图</th>
<td width="350"><input type="text" name="fo2_sitemap" id="fo2_sitemap" size="50" value="<?php echo get_option('themes_fo2_sitemap'); ?>"></td><td>填写您的网站地图地址</td>
</tr>
<tr>
<th scope="row">第三方统计</th>
<td width="350"><textarea name="fo2_tongji" cols="50" rows="5" id="fo2_tongji"><?php echo get_option('themes_fo2_tongji'); ?></textarea></td><td>插入统计代码，也可以插入其他代码</td>
</tr>
</table>
<br /><br />

<h3>主题版权信息链接开关</h3>
<table class="form-table">
<tr>
<th scope="row">禁用</th>
<td width="350">
<input name="fo2_banquan" type="checkbox" id="fo2_banquan" <?php echo get_option('themes_fo2_banquan'); ?> />
</td>
<td>如果您确实出于SEO需要，减少权重流失。可以点此关掉主题右下角版权信息的超链接，只显示版权文字信息。（此超链接只会在首页显示，内页只显示版权文字）<br />PS:如果可以的话，希望还是请保留版权信息以尊重作者的劳动成果。</td>
</tr>
</table>
<br /><br />


<p><input style="position: fixed;bottom: 50px;height: 40px;width: 10%;" type="submit" name="submit" id="submit" class="button button-primary" value="保存更改"></p>
</form>



<script type="text/javascript" src="http://beta.frontopen.com/wp-content/themes/frontopen2/jquery.js"></script>
<script type="text/javascript">
function picup(){
	$('#config_from').attr('enctype','multipart/form-data');	
}
</script>
<?php 
//类的实例化： 

$up=new upphoto;  
$up->ph_path = $_SERVER['DOCUMENT_ROOT']."/"; //设定上传路径
$up->ph_name = $_FILES['photo1']['name'];
 $submit = $_POST['submit1'];  
 if($submit == "上传"){  
  $up->get_ph_tmpname($_FILES['photo1']['tmp_name']);  
  $up->get_ph_type($_FILES['photo1']['type']);  
  $up->get_ph_size($_FILES['photo1']['size']);  
  $up->get_ph_name($_FILES['photo1']['name']);  
 $up->save();  
 }  

$up=new upphoto;  
$up->ph_path = $_SERVER['DOCUMENT_ROOT']."/"; //设定上传路径
$up->ph_name = $_FILES['photo']['name'];
 $submit = $_POST['submit'];  
 if($submit == "上传"){  
  $up->get_ph_tmpname($_FILES['photo']['tmp_name']);  
  $up->get_ph_type($_FILES['photo']['type']);  
  $up->get_ph_size($_FILES['photo']['size']);  
  $up->get_ph_name($_FILES['photo']['name']);  
 $up->save();  
 }  

?>

</div>