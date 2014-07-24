<?php

/**

 * The template for displaying the footer.

 *

 * Contains the closing of the id=main div and all content

 * after. Calls sidebar-footer.php for bottom widgets.

 *

 * @package WordPress

 * @subpackage Front_Open

 * @since Front Open 1.0

 */

?>

	</div><!-- #main -->

<div class="cls"></div>

	<div id="footer" role="contentinfo">

		<div id="colophon">



<?php

	/* A sidebar in the footer? Yep. You can can customize

	 * your footer with four columns of widgets.

	 */

	get_sidebar( 'footer' );

?>



			<div id="site-info">

            <a href="javascript:void(0)" onclick="goRoll(0)" id="goTop">返回顶部</a>

        <?php wp_loginout(); ?> 

         &nbsp; <a href="/wp-login.php?action=register">注册</a> &nbsp; <a href="<?php echo get_option('themes_fo2_sitemap'); ?>">网站地图</a> &nbsp; <a href="http://www.miitbeian.gov.cn/" rel="external nofollow"><?php echo get_option('themes_fo2_icp'); ?></a> ©<?php echo get_option('themes_fo2_copyright'); ?><?php if(get_option('themes_fo2_load_time')){echo " - 加载耗时" . timer_stop() . "s";}?> | Theme 
		 <?php if(get_option('themes_fo2_banquan') || is_paged() || !is_home()){echo "frontopen2";}else{echo '<a href="http://www.frontopen.com/" target="_blank" title="frontopen主题官方站">frontopen2</a>';} ?></div><!-- #site-info -->

		</div><!-- #colophon -->

	</div><!-- #footer -->



</div><!-- #wrapper -->



<?php

	/* Always have wp_footer() just before the closing </body>

	 * tag of your theme, or you will break many plugins, which

	 * generally use this hook to reference JavaScript files.

	 */



	wp_footer();

?>

<?php echo get_option('themes_fo2_tongji') ?>


</body>
<script src="<?php bloginfo('template_url'); ?>/include/ai.js"></script>
<script src="<?php bloginfo('template_url'); ?>/include/slip.js"></script>
<script src="<?php bloginfo('template_url'); ?>/include/page.js"></script>
</html>