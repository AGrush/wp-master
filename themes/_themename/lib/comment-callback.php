
<?php
//<!-- custom comment html -->
//the comment, args = the other args on wp_list_comments & default ones, depth is the depth
function _themename_comment_callback( $comment, $args, $depth) {
    $tag = ( $args['style'] === 'div') ? 'div' : 'li';
    echo $comment->comment_type;
    ?>
    
    <!-- no need to close li, wp does this -->
    <!-- add id so can scroll to it -->
    <<?php echo $tag ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( ['c-comment', $comment->comment_parent ? 'c-comment--child' : ''] ) ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="c-comment__body">

            <?php if($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'], false, false, array('class' => 'c-comment__avatar') ); ?>
            <!-- put in edit comment link -->
            <?php edit_comment_link( esc_html__( 'Edit Comment', '_themename' ), '<span class="c-comment__edit-link">', '</span>' ); ?>

            <div class="c-comment__content">

                <div class="c-comment__author">
                    <!-- link to author website & display name -->
                    <?php echo get_comment_author_link( $comment ); ?>
                </div>

                <a class="c-comment__time" href="<?php echo esc_url( get_comment_link( $comment, $args ) ) ?>">
                    <!-- datetime attribute -->
                    <time datetime="<?php comment_time( 'c' ) ?>">
                        <!-- output the time string -->
                        <?php
                            //display time diff in human readable way, make sure u use printf so translators can reorder the placeholder position
                            printf( esc_html__( '%s ago', '_themename' ), human_time_diff( get_comment_time( 'U' ), current_time( 'U' ) ));
                        ?>
                    </time>
                </a>
                <!-- if comment not approved display awaiting moderation text  -->
                <?php if($comment->comment_approved == '0') { ?>
                    <p class="c-comment__awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', '_themename' ); ?></p>
                <?php } ?>

                <?php 
                //if($comment->comment_type == '' || (($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback') && !$args['short_ping'])) {
                    comment_text();
                //}
                ?>

                <!-- reply link -->
                <?php
                    comment_reply_link( array_merge($args, array(
                        'depth' => $depth,
                        //open the reply field exactly after this div ID
                        'add_below' => 'div-comment',
                        //encapsulate the reply link in a div
                        'before' => '<div class="c-comment__reply-link">',
                        'after' => '</div>'
                    )));
                ?>
            </div>

        </article>
    <?php
}