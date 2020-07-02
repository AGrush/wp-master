<!-- this file overrides the default WP comments file -->

<?php
//if password protected dont show comments
if( post_password_required() ) {
    return;
}
?>


<div id="comments" class="c-comments">

    <?php if(have_comments()) { ?>
        <h2 class="c-comments__title">
            <?php
                /* translators: 1 is number of comments and 2 is post title */
                // add commment for translators as above
                //printf ( string $format [, placeholder1, placeholder2... ] ) : int
                printf(
                    //_n( $single:string, $plural:string, $number:integer, $domain:string )
                    esc_html( _n( 
                        '%1$s Reply to "%2$s"', 
                        '%1$s Replies to "%2$s"', 
                        get_comments_number(), 
                        '_themename' 
                    )),
                    number_format_i18n( get_comments_number() ),
                    get_the_title()
                )
            ?>
        </h2>

        <ul class="c-comments__list">           
            <?php
                wp_list_comments( array(
                    'short_ping' => false,
                    // 'style' can change these to be wrapped in any other tags instead of li (automatically closes these in custom callback)
                    //'style' => 'div',
                    'avatar_size' => 50,
                    'reply_text' => 'reply',
                    //create our own markup for each comment
                    'callback' => '_themename_comment_callback'
                ) );
            ?>
        </ul>
        <?php the_comments_pagination() ?>
    <?php } ?>

    <?php
    if( ! comments_open() && get_comments_number()) { ?>
        <p class="c-comments__closed"><?php esc_html_e( 'Comments are closed for this post', '_themename' ) ?></p>
    <?php } ?>

    <!-- https://developer.wordpress.org/reference/functions/comment_form/ customise everything in the comment form here-->
    <?php comment_form() ?>

</div>