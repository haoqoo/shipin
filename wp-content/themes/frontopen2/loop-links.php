<?php
/**
 * The loop that displays a page.
 *
 * The loop displays the posts and the post content. See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-page.php.
 *
 * @package WordPress
 * @subpackage Front_Open
 * @since Front Open 1.2
 */
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <?php if ( is_front_page() ) { ?>
          <h2 class="entry-title"><?php the_title(); ?></h2>
      <?php } else { ?>
          <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php } ?>

      <div class="entry-content f_links">
      <?php
        $default_ico = get_bloginfo('url').'/favicon.ico'; //默认 ico 图片位置
        $bookmarks = get_bookmarks('title_li=&orderby=rand'); //全部链接随机输出
        //如果你要输出某个链接分类的链接，更改一下get_bookmarks参数即可
        //如要输出链接分类ID为5的链接 title_li=&categorize=0&category=5&orderby=rand
        if ( !empty($bookmarks) ) {
            foreach ($bookmarks as $bookmark) {
            echo '<li><img src="', $bookmark->link_url , '/favicon.ico" onerror="javascript:this.src=\' ', $default_ico , '\'" /><a href="' , $bookmark->link_url , '" title="' , $bookmark->link_description , '" target="_blank" >' , $bookmark->link_name , '</a></li>';
            }
        }
      ?>
          <div class="cls"></div>
          <hr />
          <?php the_content(); ?>
          <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'frontopen' ), 'after' => '</div>' ) ); ?>
          <?php edit_post_link( __( 'Edit', 'frontopen' ), '<span class="edit-link">', '</span>' ); ?>
      </div><!-- .entry-content -->
  </div><!-- #post-## -->
  <?php comments_template( '', true ); ?>
<?php endwhile; // end of the loop. ?>
