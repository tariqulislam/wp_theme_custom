<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to tfuse_comment() which is
 * located in the functions.php file.
 *
 */
?>
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
<div id="comments" class="comments-area clearfix">
    <?php if ( post_password_required() ) : ?>
        <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'tfuse' ); ?></p>
    <?php
            /* Stop the rest of comments.php from being processed,
             * but don't kill the script entirely -- we still have
             * to fully load the template.
             */
            return;
        endif;
    ?>

    <?php
    $commenter = wp_get_current_commenter();
        $req = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
    
        // You can start editing here -- including this comment! ?>

    <?php if ( have_comments() ) : ?>
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-above">
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'tfuse' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'tfuse' ) ); ?></div>
        </nav>
        <?php endif; // check for comment navigation ?> 
        <h2 class="comments-title"> <?php _e( 'join the discussion', 'tfuse' );?></h2>
        <h3 class="comments-subtitle"><?php comments_number("0 ".__('comments','tfuse'), "1 ".__('comment','tfuse'), "% ".__('comments','tfuse')); ?><?php _e(' added', 'tfuse') ?></h3>
        <ol class="comment-list">
            <?php
                /* Loop through and list the comments. Tell wp_list_comments()
                 * to use tfuse_comment() to format the comments.
                 * If you want to overload this in a child theme then you can
                 * copy file comments-template.php to child theme or
                 * define your own tfuse_comment() and that will be used instead.
                 * See tfuse_comment() in comments-template.php for more.
                 */
                get_template_part( 'comments', 'template' );
                wp_list_comments( array( 'callback' => 'tfuse_comment' ) );
            ?>
        </ol>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-below">
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'tfuse' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'tfuse' ) ); ?></div>
        </nav>
        <?php endif; // check for comment navigation ?>

    <?php elseif ( comments_open() ) : // If comments are open, but there are no comments ?>

        <h2 class="comments-title"><?php _e('No comments yet.', 'tfuse') ?></h2>

    <?php endif; ?>

<?php
if(is_user_logged_in()){
    $comment_field = ' <p class="comment-form-comment">
                            <textarea id="comment" name="comment" cols="45" rows="6" class="textarea required" placeholder="'.__('ENTER YOUR MESSAGE','tfuse').'"></textarea>
                        </p>';
    $textarea_field = '';
}
else{
    $comment_field = '';
    $textarea_field = ' <p class="comment-form-comment">
                            <textarea id="comment" name="comment" cols="45" rows="6" class="textarea required" placeholder="'.__('ENTER YOUR MESSAGE','tfuse').'"></textarea>
                        </p>';
}
?>
<?php
$args = array(
    'id_form'           => 'commentform',
    'id_submit'         => 'submit',
    'title_reply'       => __( '','tfuse'  ),
    'title_reply_to'    => __( 'Leave a Reply to %s','tfuse'  ),
    'cancel_reply_link' => __( 'Cancel Reply','tfuse'  ),
    'label_submit'      => __( 'Send us the message','tfuse'  ),

    'comment_field' => $comment_field,

    'must_log_in' => '<p class="must-log-in">' .
        sprintf(
            __( 'You must be <a href="%s">logged in</a> to post a comment.','tfuse'  ),
            wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
        ) . '</p>',

    'logged_in_as' => '<p class="logged-in-as">' .
        sprintf(
            __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','tfuse'  ),
            admin_url( 'profile.php' ),
            $user_identity,
            wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
        ) . '</p>',

    'comment_notes_before' => '',

    'comment_notes_after' => '',

    'fields' => apply_filters( 'comment_form_default_fields', array(
            'comment_field' => $textarea_field,
            'author' =>'<p class="comment-form-author">
                            <input id="author" name="author" type="text"  value="' . esc_attr( $commenter['comment_author'] ) .'" size="30" placeholder="'.__('Name & Surname','tfuse').'" ' . $aria_req . '>
                        </p>',

            'email' =>'<p class="comment-form-email">
                            <input id="email" name="email"  type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" size="30" placeholder="'.__('Email adress','tfuse').'" ' . $aria_req . '>
                        </p>',
        )
    ),
);
comment_form($args);
?>
</div><!-- #comments -->
</div>
            </div>
        </div>
    </div>
</div>