<script language="javascript" src="<?php bloginfo('template_url'); ?>/include/ColorPicker.js" charset="utf-8"></script>
<script type="text/javascript">(function(){imgUrl = "<?php bloginfo('template_url'); ?>/images/Rect.gif"})()</script>

<div class="wrap">
<div id="icon-themes" class="icon32"><br /></div>
<h2>主题调色板</h2>

<form method="POST" action="" id="config_from">
<input type="hidden" name="update_themeoptions_color" value="true" />
<div class="nav-tab-box">
<h3>主导航颜色色组设置</h3>
<table class="form-table">
<tr>
<th scope="row">主导航背景颜色</th>
<td width="200"><input type="text" name="fo2_colnav1" id="fo2_colnav1" size="10" value="<?php echo get_option('themes_fo2_colnav1'); ?>"> <script>CreateCPBtn('fo2_colnav1',imgUrl);</script></td>
<td></td>
</tr>
<tr>
<th scope="row">导航条分割线颜色</th>
<td width="200"><input type="text" name="fo2_colnav2" id="fo2_colnav2" size="10" value="<?php echo get_option('themes_fo2_colnav2'); ?>"> <script>CreateCPBtn('fo2_colnav2',imgUrl);</script></td>
<td></td>
</tr>
<tr>
<th scope="row">二级菜单颜色</th>
<td width="200"><input type="text" name="fo2_colnav3" id="fo2_colnav3" size="10" value="<?php echo get_option('themes_fo2_colnav3'); ?>"> <script>CreateCPBtn('fo2_colnav3',imgUrl);</script></td>
<td></td>
</tr>
<tr>
<th scope="row">hover背景色</th>
<td width="200"><input type="text" name="fo2_colnav4" id="fo2_colnav4" size="10" value="<?php echo get_option('themes_fo2_colnav4'); ?>"> <script>CreateCPBtn('fo2_colnav4',imgUrl);</script></td>
<td></td>
</tr>
<tr>
<th scope="row">导航文字颜色</th>
<td width="200"><input type="text" name="fo2_colnav5" id="fo2_colnav5" size="10" value="<?php echo get_option('themes_fo2_colnav5'); ?>"> <script>CreateCPBtn('fo2_colnav5',imgUrl);</script></td>
<td></td>
</tr>
<tr>
<th scope="row">导航文字hover颜色</th>
<td width="200"><input type="text" name="fo2_colnav6" id="fo2_colnav6" size="10" value="<?php echo get_option('themes_fo2_colnav6'); ?>"> <script>CreateCPBtn('fo2_colnav6',imgUrl);</script></td>
<td></td>
</tr>
</table>
<br />
<h3>未分类色组</h3>
<table class="form-table">
<tr>
<th scope="row">背景颜色</th>
<td width="200"><input type="text" name="fo2_colbg" id="fo2_colbg" size="10" value="<?php echo get_option('themes_fo2_colbg'); ?>"> <script>CreateCPBtn('fo2_colbg',imgUrl);</script></td>
<td>页面背景色</td>
</tr>

<tr>
<th scope="row">色板1</th>
<td><input type="text" name="fo2_col1" id="fo2_col1" size="10" value="<?php echo get_option('themes_fo2_col1'); ?>"> <script>CreateCPBtn('fo2_col1',imgUrl);</script></td>
<td>暂时没有效果，可以不填</td>
</tr>
<tr>

<th scope="row">色板2</th>
<td><input type="text" name="fo2_col2" id="fo2_col2" size="10" value="<?php echo get_option('themes_fo2_col2'); ?>"> <script>CreateCPBtn('fo2_col2',imgUrl);</script></td>
<td>主要控制导航条的颜色</td>
</tr>

<tr>
<th scope="row">色板3</th>
<td><input type="text" name="fo2_col3" id="fo2_col3" size="10" value="<?php echo get_option('themes_fo2_col3'); ?>"> <script>CreateCPBtn('fo2_col3',imgUrl);</script></td>
<td>控制文章日期色块、标题超链接hover效果</td>
</tr>

<tr>
<th scope="row">色板4</th>
<td><input type="text" name="fo2_col4" id="fo2_col4" size="10" value="<?php echo get_option('themes_fo2_col4'); ?>"> <script>CreateCPBtn('fo2_col4',imgUrl);</script></td>
<td>控制文章列表标题的颜色与网站副标的颜色</td>
</tr>

<tr>
<th scope="row">色板5</th>
<td><input type="text" name="fo2_col5" id="fo2_col5" size="10" value="<?php echo get_option('themes_fo2_col5'); ?>"> <script>CreateCPBtn('fo2_col5',imgUrl);</script></td>
<td>控制搜索按钮与侧边栏标题的颜色</td>
</tr>

<tr>
<th scope="row">色板6</th>
<td><input type="text" name="fo2_col6" id="fo2_col6" size="10" value="<?php echo get_option('themes_fo2_col6'); ?>"> <script>CreateCPBtn('fo2_col6',imgUrl);</script></td>
<td>控制普通文字的颜色</td>
</tr>

<tr>
<th scope="row">色板7</th>
<td><input type="text" name="fo2_col7" id="fo2_col7" size="10" value="<?php echo get_option('themes_fo2_col7'); ?>"> <script>CreateCPBtn('fo2_col7',imgUrl);</script></td>
<td>控制小标签的颜色</td>
</tr>

<tr>
<th scope="row">色板8</th>
<td><input type="text" name="fo2_col8" id="fo2_col8" size="10" value="<?php echo get_option('themes_fo2_col8'); ?>"> <script>CreateCPBtn('fo2_col8',imgUrl);</script></td>
<td>控制置顶超链接与面包屑超链接的颜色</td>
</tr>

<tr>
<th scope="row">色板9</th>
<td><input type="text" name="fo2_col9" id="fo2_col9" size="10" value="<?php echo get_option('themes_fo2_col9'); ?>"> <script>CreateCPBtn('fo2_col9',imgUrl);</script></td>
<td>控制侧边栏文章超链接与感兴趣的文章超链接</td>
</tr>

<tr>
<th scope="row">色板10</th>
<td><input type="text" name="fo2_col10" id="fo2_col10" size="10" value="<?php echo get_option('themes_fo2_col10'); ?>"> <script>CreateCPBtn('fo2_col10',imgUrl);</script></td>
<td>控制置顶文章框架的颜色</td>
</tr>

</table>
</div>

<p><input style="position: fixed;bottom: 50px;height: 40px;width: 10%;" type="submit" name="submit" id="submit" class="button button-primary" value="保存更改"></p>
</form>

</div>