<div class="cls"></div>
</section><!-- #main -->
<div class="cls"></div>
	<footer id="footer" role="contentinfo">
		<div id="colophon">
<?php	get_sidebar( 'footer' );?>
<div id="site-info">
<a href="javascript:void(0)" onClick="goRoll(0)" id="goTop">返回顶部</a> <a href="<?php echo get_option('themes_fo2_sitemap'); ?>">网站地图</a> &nbsp; <a href="http://www.miitbeian.gov.cn/" rel="external nofollow"><?php echo get_option('themes_fo2_icp'); ?></a> <?php echo get_option('themes_fo2_tongji') ?> ©<?php echo get_option('themes_fo2_copyright'); ?><?php if(get_option('themes_fo2_load_time')){echo " - 加载耗时" . timer_stop() . "s";}?> | Theme <?php if(get_option('themes_fo2_banquan') || is_paged() || !is_home()){echo "<span id='official'>frontopen2</span>";}else{echo '<a id="official" href="http://www.frontopen.com/" target="_blank" title="frontopen主题官方站">frontopen2</a>';} ?></div>
		</div><?php //-- #colophon -->?>
	</footer><?php //-- #footer -->?>
</div><?php //-- #web_bod --?>
<?php
	wp_footer();
?>
<div id="float"><a id="float_gotop" class="floatbtn"  href="javascript:void()" onClick="goRoll(0)" title="返回顶部"></a><a class="linbak floatbtn" href="<?php echo admin_url() ?>" title="登陆&注册"></a><a id="float_goend" class="floatbtn" href="javascript:void()" onClick="goend()" title="转到底部"></a></div>
</body>
</html>