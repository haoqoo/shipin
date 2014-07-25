<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Front_Open
 * @since Front Open 1.0
 */
get_header(); ?>
  <div id="container">
      <div id="content" role="main">

<?php
/* Queue the first post, that way we know who
* the author is when we try to get their name,
* URL, description, avatar, etc.
*
* We reset this later so we can run the loop
* properly with a call to rewind_posts().
*/
if ( have_posts() )
  the_post();
?>

          <h1 class="page-title author"><?php the_author()?> 的 站内主页</h1>

<?php
/* Since we called the_post() above, we need to
* rewind the loop back to the beginning that way
* we can run the loop properly, in full.
*/
rewind_posts();

/* Run the loop for the author archive page to output the authors posts
* If you want to overload this in a child theme then include a file
* called loop-author.php and that will be used instead.
*/
get_template_part( 'loop', 'author' );
?>
      </div><!-- #content -->
  </div><!-- #container -->
<div id="primary" class="side" role="complementary">
<?php
if(isset($_GET['author_name'])) :
$curauth = get_userdatabylogin($author_name);
else :
$curauth = get_userdata(intval($author));
endif;
?>
<div class="widget-title">作者档案</div>
<div class="author_da">
<?php if($curauth->touxiang){ ?><div class="avatar"><img src="<?php echo $curauth->touxiang; ?>" /></div><?php } ?>
<?php if($curauth->display_name){ ?><p><b>昵称：</b><?php echo $curauth->display_name; ?></p><?php } ?>
<?php if($curauth->job){ ?><p><b>职业：</b><?php echo $curauth->job; ?></p><?php } ?>
<?php if($curauth->addres){ ?><p><b>所在地：</b><?php echo $curauth->addres; ?></p><?php } ?>
<?php if($curauth->user_url){ ?><p><b>主页：</b> <a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></p><?php } ?>
<?php if($curauth->user_email){ ?><p><b>邮箱：</b><?php the_author_meta('email') ?></p><?php } ?>
<?php if($curauth->qq){ ?><p><b>QQ：</b><?php echo $curauth->qq; ?></p><?php } ?>
<?php if($curauth->description){ ?><p><b>个人简介：</b><?php echo $curauth->description; ?></p><?php } ?>
</div>
<!-- Duoshuo Comment BEGIN -->
<div class="ds-thread" data-thread-key="author<?php the_author_meta('ID') ?>" data-title="<?php the_author()?> 在<?php bloginfo('name');?>中的主页" ></div>
<script type="text/javascript">
var duoshuoQuery = {short_name:"<?php echo $_SERVER['HTTP_HOST']?>"};
	(function() {
		var ds = document.createElement('script');
		ds.type = 'text/javascript';ds.async = true;
		ds.src = 'http://static.duoshuo.com/embed.js';
		ds.charset = 'UTF-8';
		(document.getElementsByTagName('head')[0] 
		|| document.getElementsByTagName('body')[0]).appendChild(ds);
	})();
	</script>
<!-- Duoshuo Comment END -->
</div>
<?php get_footer(); ?>