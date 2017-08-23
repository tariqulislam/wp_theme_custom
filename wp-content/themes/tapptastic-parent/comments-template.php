<?php
if ( ! function_exists( 'tfuse_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own tfuse_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function tfuse_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
       <a name="comment-<?php comment_ID() ?>"></a>
        <div id="li-comment-<?php comment_ID() ?>" class="comment-container comment-body clearfix">
            <p><?php _e( 'Pingback:', 'tfuse' ); ?> <?php comment_author_link(); ?>
                <span class="comment-date"><?php comment_date() ?></span>
                <?php comment_text() ?>
        </div><?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <a name="comment-<?php comment_ID() ?>"></a>

            <article id="li-comment-<?php comment_ID() ?>" class="comment-body clearfix">
                    
                    <footer class="comment-meta">

                        <div class="comment-author">
                            <?php echo get_avatar( $comment, 76); ?>
                            <b class="fn"><a href="#" ><?php comment_author_link() ?></a></b>
                        </div>
                        <div class="comment-meta-second clearfix">
                            <div class="comment-metadata"> <a href="#"><?php  echo tf_time_passed(strtotime(get_comment_date ( 'Y/m/d g:i:s', get_comment_ID()))); ?></a></div>
                            <div class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?></div>
                        </div>
                    </footer>
                    <div class="comment-content">
                        <p><?php echo get_comment_text() ?>  </p>
                    </div>
                    
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                            <p class='unapproved'><?php _e('Your comment is awaiting moderation.', 'tfuse'); ?></p>
                            <br />
                        <?php endif; ?>
                   
                    <!-- /.comment-head -->
                    <div id="comment-<?php comment_ID(); ?>"></div>
            
            </article><!-- /.comment-container -->
    <?php
            break;
        endswitch;
}
endif; // ends check for tfuse_comment()
