<?php

//allow child theme to override this function
if(!function_exists('_themename_post_meta')){
function _themename_post_meta() {

    /* translators: $s is the post date */
    printf(
        //text domain set in css file is _themename
        esc_html__('Posted on %s','_themename'),
        '<a href="' . esc_url(get_permalink( )) . '"><time datetime="' . esc_attr(get_the_date('c')) . 
        '">' . esc_html(get_the_date()) . '</time></a>'
    );

    /* translators: $s is the post author */
    printf(
        //text domain is _themename
        esc_html__(' By %s', '_themename'),
        ' By <a href=" ' . esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )) . '">'
        . esc_html(get_the_author()) . '</a>'
    );
}
}

//allow child theme to override this function
if(!function_exists('_themename_readmore_link')){
    function _themename_readmore_link(){
        echo '<a class="c-post__readmore" href="' . esc_url(get_permalink()) . '" title="' . the_title_attribute(['echo' => false]) .'">';

        /* translators: $s is the post title */
        printf(
            wp_kses(
                __( 'Read more <span class="u-screen-reader-text">About %s </span>', '_themename'),
                [
                    'span' => [
                        'class' => []
                    ]
                ]
            ),
            get_the_title()
        );
        echo '</a>';
    }
}


function _themename_delete_post() {
    //add arguments to url: add_query_args takes 2 arguments. 1arg = the array of arguments we need to add to the url, 2arg = the array of urls that we need to add these arguments to
    $url = add_query_arg([
        'action' => '_themename_delete_post',
        'post' => get_the_ID(),
        //send a hash (session token+action+userid) that validates ur the user that can delete this post
        'nonce' => wp_create_nonce( '_themename_delete_post_nonce' . get_the_ID() )
    ], home_url());
    
    //var_dump(current_user_can( 'delete_posts'));
    //var_dump(current_user_can( 'delete_post', get_the_ID() ));

    if(current_user_can( 'delete_post', get_the_ID() )) {
        return "&nbsp;<a href='" . esc_url($url) . "'>" . esc_html__( 'Delete Post', '_themename' ) . "</a>";
    }
}


function _themename_meta( $id, $key, $default) {
    $value = get_post_meta( $id, $key, true );
    if(!$value && $default) {
        return $default;
    }
    return $value;
}


?>