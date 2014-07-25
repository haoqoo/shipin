<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to frontopen_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Front_Open
 * @since Front Open 1.0
 */
?>
<div id="comments">
<?php if ( post_password_required() ) : ?>
    <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'frontopen' ); ?></p>
</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>
<?php
	// You can start editing here -- including this comment!
?>
<?php if ( have_comments() ) : ?>
<h3 id="comments-title"><?php
printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'frontopen' ),
number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
?></h3>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
<div class="navigation">
    <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'frontopen' ) ); ?></div>
    <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'frontopen' ) ); ?></div>
</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>
<ol class="commentlist">
  <?php
      /* Loop through and list the comments. Tell wp_list_comments()
       * to use frontopen_comment() to format the comments.
       * If you want to overload this in a child theme then you can
       * define frontopen_comment() and that will be used instead.
       * See frontopen_comment() in frontopen/functions.php for more.
       */
      wp_list_comments( array( 'callback' => 'frontopen_comment' ) );
  ?>
</ol>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
<div class="navigation">
    <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'frontopen' ) ); ?></div>
    <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'frontopen' ) ); ?></div>
</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>
<?php else : // or, if we don't have comments:
	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
<?php endif; // end ! comments_open() ?>
<?php endif; // end have_comments() ?>
<?php comment_form(array(
'comment_notes_after' => '',
'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( '你必须先 <a href="%s">登录</a>才能发表评论。' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( '<a href="%1$s">%2$s</a>已经登录，要 <a href="%3$s" title="注销用户">注销</a>此用户吗?' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
'comment_notes_before' => '<p class="comment-notes">' . __( '你的email不会被公开。' ) . ( $req ? $required_text : '' ) . '</p>',
'title_reply'          => __( '留下一个回复' ),
'title_reply_to'       => __( '给%s的回复' ),
'cancel_reply_link'    => __( '取消回复' ),
'label_submit'         => __( '发表评论' )
)); ?>
</div><!-- #comments -->
