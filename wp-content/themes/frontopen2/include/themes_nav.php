<?php
$twodir = str_replace("http://".$_SERVER['HTTP_HOST'],'',get_bloginfo('template_url')); //获取模板路径
?>
<style type="text/css">
.demo dl{float:left;width:65px;height:75px;margin-right:20px;position:relative}
.demo dl dt{width:45px;padding:0 10px}
.demo dl dd{line-height:30px;height:30px;width:65px;text-align:center;font-weight:700; margin:0;}
.cls{clear:both}
.btn_move{float:right;}
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
<div class="btn_top">
<h3>图标按钮(<span class="nums"><?php echo $i ?></span>)</h3><div class="btn_move"><?php if($i != 1){ ?><a href="javascript:;" class="up button">上移</a><?php }?> <?php if($i != $num){?><a href="javascript:;" class="down button">下移</a><?php }?></div>
<div class="demo">
<dl>
    <dt><a href="<?php echo get_option('themes_fo2_top_btn' . $i . '_url'); ?>" title="<?php echo get_option('themes_fo2_top_btn' . $i . '_title'); ?>" target="<?php echo get_option('themes_fo2_top_btn' . $i . '_target'); ?>" class="nav_button" style="opacity: 0.7;" rel="<?php echo get_option('themes_fo2_top_btn' . $i . '_rel'); ?>"><img class="dsrc<?php echo $i ?>" src="<?php if(get_option('themes_fo2_top_btn' . $i . '_img')){ echo get_option('themes_fo2_top_btn' . $i . '_img');}elseif($_FILES['photo'. $i .'']['size']){ echo $twodir."/images/". $_FILES['photo'. $i .'']['name'];} ?>" width="45" height="45"></a></dt>
    <dd class="dtx<?php echo $i ?>"><?php echo get_option('themes_fo2_top_btn' . $i . '_text'); ?></dd>
</dl>
</div>
<table class="form-table btn_bod">
<tr>
<th scope="row">图片文件路径</th>
<td width="350"><input type="text" name="fo2_top_btn<?php echo $i ?>_img" id="fo2_top_btn<?php echo $i ?>_img" size="50" value="<?php if(get_option('themes_fo2_top_btn' . $i . '_img')){ echo get_option('themes_fo2_top_btn' . $i . '_img');}elseif($_FILES['photo'. $i .'']['size']){ echo $twodir."/images/". $_FILES['photo'. $i .'']['name'];} ?>"><br /> 
<input type="button" value="调用图像" class="button-secondary" onclick="TB_on('fo2_top_btn<?php echo $i ?>_img')">
</td>
<td></td>
</tr>
<tr>
<th scope="row">超链接</th>
<td width="350"><input type="text" name="fo2_top_btn<?php echo $i ?>_url" id="fo2_top_btn<?php echo $i ?>_url" size="50" value="<?php echo get_option('themes_fo2_top_btn' . $i . '_url'); ?>"></td>
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
<th scope="row"> <font color="red">显示按钮</font></th>
<td width="350">
<input name="fo2_top_btn<?php echo $i ?>_display" type="checkbox" id="fo2_top_btn<?php echo $i ?>_display" <?php echo get_option('themes_fo2_top_btn' . $i . '_display'); ?> />
</td>
<td></td>
</tr>
</table>
</div>
<br />

<?php 
//类的实例化：  
//$up=new upphoto;  
//$up->ph_path = dirname(dirname(__FILE__)) . "/images/"; //设定上传路径
//$up->ph_name = $_FILES['photo'. $i .'']['name'];
// $submit = $_POST['submit'. $i .''];  
// if($submit == "上传"){  
//  $up->get_ph_tmpname($_FILES['photo'. $i .'']['tmp_name']);  
//  $up->get_ph_type($_FILES['photo'. $i .'']['type']);  
//  $up->get_ph_size($_FILES['photo'. $i .'']['size']);  
//  $up->get_ph_name($_FILES['photo'. $i .'']['name']);  
// $up->save();  
// }
?>


<?php }?>

<p><input style="position: fixed;bottom: 50px;height: 40px;width: 10%;" type="submit" name="submit" id="submit" class="button button-primary" value="保存更改"></p>
</form>
</div>

<?php wp_enqueue_script('thickbox');wp_enqueue_style('thickbox');wp_enqueue_script("jquery");?>
<script type="text/javascript">
TB_Height = window.screen.height * 0.7;
function TB_on(inputKey) {		
	window.send_to_editor = function(html) 		
	{
		imgurl = jQuery('img',html).attr('src');
		jQuery('#'+inputKey).val(imgurl);
		tb_remove();
	}	 
 
	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true&width=670&height='+TB_Height);
	return false;		
};


jQuery(function($){
	_db = new Array();
	
	$('.down').click(function(){
		var nums = parseInt($(this).parents('.btn_top').find('.nums').text());
		var upNum = nums + 1;
		moveBtn.action(nums,upNum);
	})
	
	$('.up').click(function(){
		var nums = parseInt($(this).parents('.btn_top').find('.nums').text());
		var upNum = nums - 1;
		moveBtn.action(nums,upNum);
	})
	
	var moveBtn = {
	getVal:function(head,nums,foot,upNum){
		_db[head+nums+foot] = $('#'+head+nums+foot).val()
		_db[head+upNum+foot] = $('#'+head+upNum+foot).val()
	},
	postVal:function(head,nums,foot,upNum){
		$('#'+head+nums+foot).val(_db[head+upNum+foot])
		$('#'+head+upNum+foot).val(_db[head+nums+foot])
	},
	action:function(nums,upNum){
		_ipKey = new Array('_img','_url','_text','_title','_rel');
		
		for(var i in _ipKey){
			moveBtn.getVal('fo2_top_btn',nums,_ipKey[i],upNum);
			moveBtn.postVal('fo2_top_btn',nums,_ipKey[i],upNum);
		}
		
		var numsSrc = $('.dsrc'+nums).attr('src');
		var upNumSrc = $('.dsrc'+upNum).attr('src');
		numsSrc =  numsSrc || '#';
		upNumSrc = upNumSrc || '#';
		$('.dsrc'+nums).attr('src',upNumSrc);
		$('.dsrc'+upNum).attr('src',numsSrc);

		var numsText = $('.dtx'+nums).text();
		var upNumText = $('.dtx'+upNum).text();
		$('.dtx'+nums).text(upNumText);
		$('.dtx'+upNum).text(numsText);
	
	}
}


})	



</script>

