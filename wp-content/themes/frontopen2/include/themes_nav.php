<style type="text/css">
.demo dl{float:left;width:65px;height:75px;margin-right:20px;position:relative}
.demo dl dt{width:45px;padding:0 10px}
.demo dl dd{line-height:30px;height:30px;width:65px;text-align:center;font-weight:700; margin:0;}
.cls{clear:both}
</style>
<div class="wrap">
<div id="icon-themes" class="icon32"><br /></div>
<h2>头部按钮设置</h2>
<form method="POST" action="" id="config_from">
<input type="hidden" name="update_themeoptions_btn" value="true" />

<h3>当前图标导航预览</h3>
<div class="demo">
<?php if(get_option('themes_fo2_btn_num')){ $num = get_option('themes_fo2_btn_num');}else{$num =1;}	
	for($i=1; $i<=$num; $i++){  ?>
		<?php if(get_option('themes_fo2_top_btn' . $i . '_display')=='checked') : ?>
			<dl>
			    <dt><a href="<?php echo get_option('themes_fo2_top_btn' . $i . '_url'); ?>" title="<?php echo get_option('themes_fo2_top_btn' . $i . '_title'); ?>" target="<?php echo get_option('themes_fo2_top_btn' . $i . '_target'); ?>" class="nav_button" style="opacity: 0.7;" rel="<?php echo get_option('themes_fo2_top_btn' . $i . '_rel'); ?>"><img src="<?php echo get_option('themes_fo2_top_btn' . $i . '_img'); ?>" width="45" height="45"></a></dt>
                <dd><?php echo get_option('themes_fo2_top_btn' . $i . '_text'); ?></dd>
            </dl>
			<?php endif; ?>
<?php }?>
<div class="cls"></div>
</div>
           
<table class="form-table">
<tr>
<th scope="row">最大图标个数</th>
<td><input type="text" name="fo2_btn_num" id="fo2_btn_num" size="2" value="<?php if(get_option('themes_fo2_btn_num')){ echo get_option('themes_fo2_btn_num');}else{echo "1";} ?>">个</td>
</tr>
</table>
<p><input type="submit" name="submit" id="submit" class="button button-primary" value="保存更改"></p>
<hr />

<?php 	for($i=1; $i<=$num; $i++){  ?>
<h3>图标按钮(<?php echo $i ?>)</h3>
<div class="demo">
<dl>
    <dt><a href="<?php echo get_option('themes_fo2_top_btn' . $i . '_url'); ?>" title="<?php echo get_option('themes_fo2_top_btn' . $i . '_title'); ?>" target="<?php echo get_option('themes_fo2_top_btn' . $i . '_target'); ?>" class="nav_button" style="opacity: 0.7;" rel="<?php echo get_option('themes_fo2_top_btn' . $i . '_rel'); ?>"><img src="<?php if(get_option('themes_fo2_top_btn' . $i . '_img')){ echo get_option('themes_fo2_top_btn' . $i . '_img');}elseif($_FILES['photo'. $i .'']['size']){ echo "/wp-content/themes/frontopen2/images/". $_FILES['photo'. $i .'']['name'];} ?>" width="45" height="45"></a></dt>
    <dd><?php echo get_option('themes_fo2_top_btn' . $i . '_text'); ?></dd>
</dl>
</div>
<table class="form-table">
<tr>
<th scope="row">图片文件路径</th>
<td width="350"><input type="text" name="fo2_top_btn<?php echo $i ?>_img" id="fo2_top_btn<?php echo $i ?>_img" size="50" value="



<?php if(get_option('themes_fo2_top_btn' . $i . '_img')){ echo get_option('themes_fo2_top_btn' . $i . '_img');}elseif($_FILES['photo'. $i .'']['size']){ echo "/wp-content/themes/frontopen2/images/". $_FILES['photo'. $i .'']['name'];} ?>"><br /><input class="button button-primary" type="file" name="photo<?php echo $i; ?>"> <input type="submit" name="submit<?php echo $i; ?>" value="上传" onclick="picup()" class="button button-primary">
</td>
<td>默认提供地址<?php bloginfo('template_url'); ?>/images/dsj.gif</td>
</tr>
<tr>
<th scope="row">超链接</th>
<td width="350"><input type="text" name="fo2_top_btn<?php echo $i ?>_url" id="fo2_top_btn<?php echo $i ?>1_url" size="50" value="<?php echo get_option('themes_fo2_top_btn' . $i . '_url'); ?>"></td>
<td></td>
</tr>
<tr>
<th scope="row">标题文字</th>
<td width="350"><input type="text" name="fo2_top_btn<?php echo $i ?>_text" id="fo2_top_btn<?php echo $i ?>_text" size="50" value="<?php echo get_option('themes_fo2_top_btn' . $i . '_text'); ?>"></td>
<td></td>
</tr>
<tr>
<th scope="row">按钮title</th>
<td width="350"><input type="text" name="fo2_top_btn<?php echo $i ?>_title" id="fo2_top_btn<?php echo $i ?>_title" size="50" value="<?php echo get_option('themes_fo2_top_btn' . $i . '_title'); ?>"></td>
<td></td>
</tr>
<tr>
<th scope="row">按钮rel</th>
<td width="350"><input type="text" name="fo2_top_btn<?php echo $i ?>_rel" id="fo2_top_btn<?php echo $i ?>_rel" size="50" value="<?php echo get_option('themes_fo2_top_btn' . $i . '_rel'); ?>"></td>
<td>默认为空，SEO可以使用nofollow，external nofollow</td>
</tr>
<tr>
<th scope="row">超链跳转方式</th>
<td width="350">
<?php $target1 = get_option('themes_fo2_top_btn' . $i . '_target'); ?>
<select name ="fo2_top_btn<?php echo $i ?>_target">
  <option value="_self" <?php if ($target1=="_self") { echo 'selected'; } ?> >_self</option>
  <option value="_blank" <?php if ($target1=="_blank") { echo 'selected'; } ?> >_blank</option>
  <option value="new" <?php if ($target1=="new") { echo 'selected'; } ?> >new</option>
  <option value="_parent" <?php if ($target1=="_parent") { echo 'selected'; } ?> >_parent</option>
  <option value="_top" <?php if ($target1=="_top") { echo 'selected'; } ?> >_top</option>
</select></td>
<td>默认为_self</td>
</tr>
<tr>
<th scope="row">显示按钮</th>
<td width="350">
<input name="fo2_top_btn<?php echo $i ?>_display" type="checkbox" id="fo2_top_btn<?php echo $i ?>_display" <?php echo get_option('themes_fo2_top_btn' . $i . '_display'); ?> />
</td>
<td></td>
</tr>
</table>
<br />

<?php 
//类的实例化：  
$up=new upphoto;  
$up->ph_path = dirname(dirname(__FILE__)) . "/images/"; //设定上传路径
$up->ph_name = $_FILES['photo'. $i .'']['name'];
 $submit = $_POST['submit'. $i .''];  
 if($submit == "上传"){  
  $up->get_ph_tmpname($_FILES['photo'. $i .'']['tmp_name']);  
  $up->get_ph_type($_FILES['photo'. $i .'']['type']);  
  $up->get_ph_size($_FILES['photo'. $i .'']['size']);  
  $up->get_ph_name($_FILES['photo'. $i .'']['name']);  
 $up->save();  
 }
?>


<?php }?>

<p><input style="position: fixed;bottom: 50px;height: 40px;width: 10%;" type="submit" name="submit" id="submit" class="button button-primary" value="保存更改"></p>
</form>
</div>
<script type="text/javascript" src="http://beta.frontopen.com/wp-content/themes/frontopen2/jquery.js"></script>
<script type="text/javascript">
function picup(){
	$('#config_from').attr('enctype','multipart/form-data');	
}
</script>

