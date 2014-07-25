<div class="wrap">
<div id="icon-themes" class="icon32"><br /></div>
<h2>站点公告设置</h2>
<form method="POST" action="" id="config_from">
<input type="hidden" name="update_themeoptions_ac" value="true" />
  
<?php get_option('themes_fo2_ac_num')?$num = get_option('themes_fo2_ac_num'):$num =1;?>
           
<table class="form-table">
<tr>
<th scope="row">公告条数</th>
<td><input type="text" name="fo2_ac_num" id="fo2_ac_num" size="2" value="<?php if(get_option('themes_fo2_ac_num')){ echo get_option('themes_fo2_ac_num');}else{echo "1";} ?>">个</td>
</tr>
</table>
<p><input type="submit" name="submit" id="submit" class="button button-primary" value="保存更改"></p>
<hr />
<p>显示在导航条右上方，支持HTML代码。（建议不要再这里插入一些影响布局的代码）</p>
<?php 	for($i=1; $i<=$num; $i++){  ?>
<table class="form-table">
<tr>
<th scope="row">站点公告(<?php echo $i ?>)</th>
<td width="350"><textarea type="text" name="fo2_top_ac<?php echo $i ?>_text" id="fo2_top_ac<?php echo $i ?>_text" cols="50" rows="3"><?php echo get_option('themes_fo2_top_ac' . $i . '_text'); ?></textarea></td>
<td>启用 <input name="fo2_top_ac<?php echo $i ?>_display" type="checkbox" id="fo2_top_ac<?php echo $i ?>_display" <?php echo get_option('themes_fo2_top_ac' . $i . '_display'); ?> />
</td>
</tr>

</table>
<br />

<?php }?>

<p><input style="position: fixed;bottom: 50px;height: 40px;width: 10%;" type="submit" name="submit" id="submit" class="button button-primary" value="保存更改"></p>
</form>
</div>
