<?php
function bmd_comment_list($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment;
    
    switch ($comment->comment_type) :
        case 'pingback'  :
        case 'trackback' : 
        ?>
            <li class="pingback">  
                <p>
                    <?php _e('Pingback:', 'bmd'); ?>
                    <?php comment_author_link(); ?>
                    <?php edit_comment_link(__('(Edit)', 'bmd'), ' ' ); ?>
                </p>
            </li>
            <?php
            break;
            
        default :
        ?>
            <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                <article class="comment-wrapper clearfix"> 

                    <div class="comment-avartar">
                        <?php echo get_avatar( $comment, 60 ); ?>
                    </div><!-- end div .comment-avartar -->

                    <div class="comment-content-wrapper clearfix">
                       
                        <div class="comment-head">
                            <span class="comment-author"><?php echo get_comment_author_link(); ?></span>
                            <span>::</span>
                            <span class="comment-date"><?php echo get_comment_date() ?> at <?php echo get_comment_time() ?></span>
                            <span>::</span>
                            <span class="comment-reply">
                                <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                            </span> 
                        </div><!-- end div .comment-head -->

                        <div class="comment-message">
                            <?php echo get_comment_text(); ?>
                        </div><!-- end div .comment-message -->
                        
                    </div><!-- end div.comment-authors -->
                    
                </article><!-- end article .comment-wrapper --> 
            </li>
            <?php
            break;
    endswitch;
    
}