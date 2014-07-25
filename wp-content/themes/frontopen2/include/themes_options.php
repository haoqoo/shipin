<div class="wrap">
<div id="icon-themes" class="icon32"><br /></div>
<h2 class="nav-tab-wrapper" id="bak_nav_a">
<a href="javascript:void()" class="nav-tab nav-tab-active">主题设置</a><a href="javascript:void()" class="nav-tab">功能设置</a><a href="javascript:void()" class="nav-tab">运营相关</a><a href="javascript:void()" class="nav-tab">自定义文字</a><a href="javascript:void()" class="nav-tab">SEO三标签</a><a href="javascript:void()" class="nav-tab">插件集成</a><a href="javascript:void()" class="nav-tab">自定义CSS</a>
</h2>

<form method="POST" action="" id="config_from">
<input type="hidden" name="update_themeoptions" value="true" />
<div class="nav-tab-box">
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
<input type="text" name="fo2_logo_img" id="fo2_logo_img" size="50" value="<?php if(get_option('themes_fo2_logo_img')){ echo get_option('themes_fo2_logo_img');}elseif($_FILES['photo1']['size']){ echo "/". $_FILES['photo1']['name'];} ?>"><br /> 
<input type="button" value="调用图像" class="button-secondary" onclick="TB_on('fo2_logo_img')">

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

</div><!--box1-->


<div class="nav-tab-box" style="display:none;">
<h3>admin_bar控制</h3>
<table class="form-table">
<tr>
<th scope="row">启用</th>
<td width="350">
<input name="fo2_admin_bar" type="checkbox" id="fo2_admin_bar" <?php echo get_option('themes_fo2_admin_bar'); ?> />
</td>
<td>主题默认关闭了登陆后的前台admin_bar，如果需要使用的话，可以勾选此项启用</td>
</tr>
</table>
<br /><br />

<h3>启用幻灯片功能</h3>
<table class="form-table">
<tr>
<th scope="row">启用</th>
<td width="350">
<input name="fo2_focus" type="checkbox" id="fo2_focus" <?php echo get_option('themes_fo2_focus'); ?> />
</td>
<td>勾选此项后，首页将会显示幻灯片。并且编辑文章时会出现"图片"形式的选项，勾选图片选项后，该片文章将被推送为幻灯片。幻灯片需要展示的图片请插入到这篇文章的第一个图片位，程序将会自动调用。<br />关于幻灯片的使用说明，请参照<a href="http://www.frontopen.com/1900.html" target="_blank">这篇文章</a></td>
</tr>
</table>
<br /><br />

<h3>禁用TimThumb缩略图裁剪功能</h3>
<table class="form-table">
<tr>
<th scope="row">禁用</th>
<td width="350">
<input name="fo2_TimThumb" type="checkbox" id="fo2_TimThumb" <?php echo get_option('themes_fo2_TimThumb'); ?> />
</td>
<td>TimThumb缩略图裁剪功能优于wordpress自带的缩略图生成功能，它能够根据页面布局的不同比例，对单个区域进行指定的大小裁剪。<br />如果由于某些服务器环境或url路径等策略的不同，造成功能不可用的话，请禁用该功能。<br /><font color="red">如果启用TimThumb缩略图裁剪功能后，造成站点外部链接的图片无法显示，请参照<a href="http://www.frontopen.com/2034.html" target="_blank">这篇文章</a>修改TimThumb的安全设置</font></td>
</tr>
</table>
<br /><br />

<h3>禁用懒人加载功能</h3>
<table class="form-table">
<tr>
<th scope="row">禁用</th>
<td width="350">
<input name="fo2_lateload" type="checkbox" id="fo2_lateload" <?php echo get_option('themes_fo2_lateload'); ?> />
</td>
<td>懒人加载功能可以让用户在未滚动到屏幕所在区域时不加载图片，可以有效的节省服务器的带宽消耗与页面的打开速度。当然了，懒人加载功能会导致搜索引擎无法正常的抓取站点的图片。勾选此项可以禁用主题自带的懒人加载功能。</td>
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

<h3>RSS订阅按钮开关</h3>
<table class="form-table">
<tr>
<th scope="row">禁用</th>
<td width="350">
<input name="fo2_btn_rss2" type="checkbox" id="fo2_btn_rss2" <?php echo get_option('themes_fo2_btn_rss2'); ?> />
</td>
<td>如果您不希望在首页导航条上方显示RSS订阅按钮，请点此禁用</td>
</tr>
<tr>
<th scope="row">QQ订阅key:</th>
<td width="350">
<input type="text" name="fo2_rss_key" id="fo2_rss_key" size="50" value="<?php echo get_option('themes_fo2_rss_key'); ?>">
</td>
<td>可以让用户通过自己的邮箱订阅站点的更新内容，需要至腾讯list邮箱中注册key<a href="http://list.qq.com/" target="_blank">去看看</a></td>
</tr>
</table>
<br /><br />

<h3>文章首行缩进</h3>
<table class="form-table">
<tr>
<th scope="row">启用</th>
<td width="350">
<input name="fo2_page_suo" type="checkbox" id="fo2_page_suo" <?php echo get_option('themes_fo2_page_suo'); ?> />
</td>
<td>开启后，所有文章内容将自动缩进2em（两个中文汉字宽度）</td>
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

<h3>热门浏览标识</h3>
<table class="form-table">
<tr>
<th scope="row">HOT判断标准值</th>
<td width="350"><input type="text" name="fo2_view_num" id="fo2_view_num" size="50" value="<?php echo get_option('themes_fo2_view_num'); ?>"></td><td>单篇文章浏览n次后在文章尾部追加"HOT"标识</td>
</tr>
<tr>
<th scope="row">显示浏览次数</th>
<td>
<input name="fo2_view_time" type="checkbox" id="fo2_view_time" <?php echo get_option('themes_fo2_view_time'); ?> />
</td>
<td>开启显示浏览次数功能后，上面的HOT判断功能会自动失效。HOT标识位置将显示该文章的阅读次数。并且小标签的围观次数将不会再列表页显示</td>
</tr>
</table>
<br /><br />

<h3>标签云设置</h3>
<table class="form-table">
<tr>
<th scope="row">标签云数量</th>
<td width="350"><input type="text" name="fo2_tag_num" id="fo2_tag_num" size="50" value="<?php echo get_option('themes_fo2_tag_num'); ?>"></td><td>设置标签云的显示数量，不填则默认显示45个</td>
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
<th scope="row">自动摘要字符数</th>
<td width="350"><input type="text" name="fo2_dis_num" id="fo2_dis_num" size="50" value="<?php echo get_option('themes_fo2_dis_num'); ?>"></td><td>请根据需要输入整数以控制首页摘要的字符数量，如不填则使用默认策略</td>
</tr>
<tr>
<th scope="row">页面宽度限制</th>
<td width="350"><input type="text" name="fo2_page_width" id="fo2_page_width" size="50" value="<?php echo get_option('themes_fo2_page_width'); ?>"></td><td>设置页面宽度后，PC页面会按照您设定宽度展现页面。强烈建议禁用自动摘要后配合此功能调整页面。（请填入整数，并且宽度设置小于960会出错！）</td>
</tr>
</table>
<br /><br />

<h3>主题特效参数设置</h3>
<table class="form-table">
<tr>
<th scope="row">loading条加载速度</th>
<td width="350"><input type="text" name="fo2_load_speed" id="fo2_load_speed" size="50" value="<?php echo get_option('themes_fo2_load_speed'); ?>"></td><td>必须是整数，单位为毫秒。 （1秒=1000毫秒）</td>
</tr>
<tr>
<th scope="row">首页屏蔽分类</th>
<td width="350"><input type="text" name="fo2_not_category" id="fo2_not_category" size="50" value="<?php echo get_option('themes_fo2_not_category'); ?>"></td><td>填写对应分类的 '-'id 即可使某些分类的文章不在首页显示（例如 -1）。如果需要屏蔽多个栏目请将id用","隔开（例如 -1,-2）</td>
</tr>
</table>
<br /><br />

<h3>首页&列表页缩略图大小控制</h3>
<table class="form-table">
<tr>
<th scope="row">图片高度</th>
<td width="350"><input type="text" name="fo2_image_height" id="fo2_image_height" size="50" value="<?php echo get_option('themes_fo2_image_height'); ?>"></td><td>图片的自定义高度，不填写则默认为140（注意填写遵循css格式规范，例如"140px"，"auto"）</td>
</tr>
<tr>
<th scope="row">图片宽度</th>
<td width="350"><input type="text" name="fo2_image_width" id="fo2_image_width" size="50" value="<?php echo get_option('themes_fo2_image_width'); ?>"></td><td>图片的自定义宽度，不填写则默认为auto（注意填写遵循css格式规范，例如"140px"，"auto"）建议自定义图片大小之后，在wordpress的缩略图也设置为相应的大小配置
</td>
</tr>
<tr>
<th scope="row">框体高度</th>
<td width="350"><input type="text" name="fo2_con_height" id="fo2_con_height" size="50" value="<?php echo get_option('themes_fo2_con_height'); ?>"></td><td>在1366px像素以上的双栏模式下，可以自定义列表框的高度，默认140px
</td>
</tr>
</table>
<br /><br />


<h3>文章列表摘要超链接</h3>
<table class="form-table">
<tr>
<th scope="row">禁用</th>
<td width="350">
<input name="fo2_dis_href" type="checkbox" id="fo2_dis_href" <?php echo get_option('themes_fo2_dis_href'); ?> />
</td>
<td>禁用后首页、分类页文章列表的摘要部分将不再具有超链接。只能通过点击文章标题和read more进入文章内页。</td>
</tr>
</table>
<br /><br />

<h3>mobile自适应控制</h3>
<table class="form-table">
<tr>
<th scope="row">禁用</th>
<td width="350">
<input name="fo2_mobile" type="checkbox" id="fo2_mobile" <?php echo get_option('themes_fo2_mobile'); ?> />
</td>
<td>勾选后，主题将不会为移动设备自动匹配样式（不推荐使用）</td>
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

</div><!--box2-->

<div class="nav-tab-box" style="display:none">

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

<h3>广告位代码管理</h3>
<table class="form-table">
<tr>
<th scope="row">文章页面右侧广告位</th>
<td width="350"><textarea name="fo2_ad_1" cols="50" rows="5" id="fo2_ad_1"><?php echo get_option('themes_fo2_ad_1'); ?></textarea></td><td><?php echo get_option('themes_fo2_ad_1');?>建议是矩形广告</td>
</tr>
<tr>
<th scope="row">文章页面相关阅读上方广告位</th>
<td width="350"><textarea name="fo2_ad_2" cols="50" rows="5" id="fo2_ad_2"><?php echo get_option('themes_fo2_ad_2'); ?></textarea></td><td><?php echo get_option('themes_fo2_ad_2'); ?>建议为横幅广告</td>
</tr>
<tr>
<th scope="row">文章页面相关阅读上方广告位（移动设备）</th>
<td width="350"><textarea name="fo2_mobile_ad_2" cols="50" rows="5" id="fo2_mobile_ad_2"><?php echo get_option('themes_fo2_mobile_ad_2'); ?></textarea></td><td><?php echo get_option('themes_fo2_mobile_ad_2'); ?>建议为移动版广告</td>
</tr>
</table>
<br /><br />

</div><!--box3-->

<div class="nav-tab-box" style="display:none">
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
<th scope="row">转载请注明文字</th>
<td width="350"><textarea name="fo2_zhuanzai" cols="50" rows="5" id="fo2_zhuanzai"><?php echo get_option('themes_fo2_zhuanzai'); ?></textarea></td><td>用于自定义转载申明的文字描述,可以插入html代码</td>
</tr>
<tr>
<th scope="row">feed订阅自定义文字内容</th>
<td width="350"><textarea name="fo2_feed_type" cols="50" rows="5" id="fo2_zhuanzai"><?php echo get_option('themes_fo2_feed_type'); ?></textarea></td><td>可以在feed订阅的内容后面跟上自己想要告诉给用户的信息，支持HTML。当前站点的feed的访问地址为 <?php bloginfo('rss2_url'); ?></td>
</tr>
<tr>
<th scope="row">第三方分享代码</th>
<td width="350"><textarea name="fo2_fenxiang" cols="50" rows="5" id="fo2_fenxiang"><?php echo get_option('themes_fo2_fenxiang'); ?></textarea></td><td>文章结尾处可以插入例如<a href="http://share.baidu.com/" target="_blank">百度分享</a>之类的代码，方便用户将文章分享到社交平台</td>
</tr>
</table>
<br /><br />

</div><!--box4-->

<div class="nav-tab-box" style="display:none">
<h3>主题SEO三标签功能</h3>
<table class="form-table">
<tr>
<th scope="row">启用</th>
<td width="350">
<input name="fo2_seo_on" type="checkbox" id="fo2_seo_on" <?php echo get_option('themes_fo2_seo_on'); ?> />
</td>
<td>开启后将使用主题自带的站点title keyword description 功能</td>
</tr>
</table>
<br /><br />

<h3>首页SEO三标签</h3>
<table class="form-table">
<tr>
<th scope="row">首页标题</th>
<td width="350"><input type="text" name="fo2_seo_ht" id="fo2_seo_ht" size="50" value="<?php echo get_option('themes_fo2_seo_ht'); ?>"></td><td>站点首页的title标题，为空则自动调用WP后台填写的站点标题。（建议不要和SEO插件同时使用）</td>
</tr>
<tr>
<th scope="row">首页keyword</th>
<td width="350"><input type="text" name="fo2_seo_hk" id="fo2_seo_hk" size="50" value="<?php echo get_option('themes_fo2_seo_hk'); ?>"></td>
</tr>
<tr>
<th scope="row">首页description</th>
<td width="350"><textarea name="fo2_seo_hd" cols="50" rows="5" id="fo2_seo_hd"><?php echo get_option('themes_fo2_seo_hd'); ?></textarea></td>
</tr>
</table>
<br /><br />


</div><!--box5-->
<div class="nav-tab-box" style="display:none">
<h3>短代码功能设置</h3>
<table class="form-table">
<tr>
<th scope="row">启用</th>
<td width="350">
<input name="fo2_duan_plus" type="checkbox" id="fo2_duan_plus" <?php echo get_option('themes_fo2_duan_plus'); ?> />
</td>
<td>开启主题集成的短代码功能，如果发现有冲突请检查您是否正在使用短代码插件。(beta 慎用！)</td>
</tr>
</table>
<br /><br />

<h3>集成插件控制</h3>
<table class="form-table">
<tr>
<th scope="row">启用widget_logic</th>
<td width="350">
<input name="fo2_widget_logic" type="checkbox" id="fo2_widget_logic" <?php echo get_option('themes_fo2_widget_logic'); ?> />
</td>
<td>主题默认会开启widget_logic插件用于小工具加载判断条件，如果您发现存在插件冲突可以尝试关闭这个插件，并报告主题作者改进。</td>
</tr>
</table>
<br /><br />


</div><!--box6-->
<div class="nav-tab-box" style="display:none">
<p>此处的样式将会替换默认的style.css中的样式，并且其值会保存在数据库中，升级主题不会对自定义过的样式造成覆盖。</p> 
<textarea name="fo2_css" cols="150" rows="30" id="fo2_css" style="width:100%"><?php echo get_option('themes_fo2_css'); ?></textarea>

</div><!--box7-->

<p><input style="position: fixed;bottom: 50px;height: 40px;width: 10%;" type="submit" name="submit" id="submit" class="button button-primary" value="保存更改"></p>
</form>

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


function picup(){
	jQuery('#config_from').attr('enctype','multipart/form-data');	
}

jQuery(document).ready(function($){
	$('.nav-tab-wrapper a').click(function(){
		var j = $('.nav-tab-wrapper a').index($(this)[0]);
		cookie.set("wrappera",j,"1");
		$('.nav-tab-wrapper a').eq(j).addClass('nav-tab-active').siblings().removeClass('nav-tab-active');
		$('.nav-tab-box').eq(j).show().siblings('.nav-tab-box').hide();
		return false;
	})
	
	var ckGet = cookie.get('wrappera');
	$('.nav-tab-wrapper a').eq(ckGet).addClass('nav-tab-active').siblings().removeClass('nav-tab-active');
	$('.nav-tab-box').eq(ckGet).show().siblings('.nav-tab-box').hide();

});

	
/*cookie方法*/
var cookie = {
	set:function(key,val,time){//设置cookie方法
		var date=new Date(); //获取当前时间
		var expiresDays=time;  //将date设置为365天以后的时间
		date.setTime(date.getTime()+expiresDays*24*3600*1000); //将tips的cookie设置为10天后过期 
		document.cookie=key + "=" + val +";expires="+date.toGMTString();  //设置cookie
	},
	get:function(key){//获取cookie方法
		/*获取cookie参数*/
		var getCookie = document.cookie.replace(/[ ]/g,"")  //获取cookie，并且将获得的cookie格式化，去掉空格字符
		var arrCookie = getCookie.split(";")  //将获得的cookie以"分号"为标识 将cookie保存到arrCookie的数组中
		var tips;  //声明变量tips
		for(var i=0;i<arrCookie.length;i++){   //使用for循环查找cookie中的tips变量
			var arr=arrCookie[i].split("=");   //将单条cookie用"等号"为标识，将单条cookie保存为arr数组
			if(key==arr[0]){  //匹配变量名称，其中arr[0]是指的cookie名称，如果该条变量为tips则执行判断语句中的赋值操作
				tips=arr[1];   //将cookie的值赋给变量tips
				break;   //终止for循环遍历
			} 
		}
		return tips;

	}
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