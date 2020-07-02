<!-- INSIDE SINGLE PAGE //if customizer 'setting' to display author info is on (default = true) display author info. -->

<div class="c-post-author u-margin-bottom-20">
    <h2 class="u-screen-reader-text"><?php esc_attr_e( 'About The Author', '_themename' ); ?></h2>
    <?php
        $author_id = get_the_author_meta( 'ID' );
        $author_posts = get_the_author_posts();
        //diplay name as setting in frontend
        $author_display = get_the_author();
        //archive for author
        $author_posts_url = get_author_posts_url( $author_id );
        //https://developer.wordpress.org/reference/functions/get_the_author_meta/
        $author_description = get_the_author_meta( 'user_description' );
        $author_website = get_the_author_meta( 'user_url' );
    ?>
    <div class="c-post-author__avatar">
        <?php echo get_avatar( $author_id, 265 ); ?>
    </div>
    <div class="c-post-author__content">
        <!-- title -->
        <!-- make user title a link to the users website (set in frontend) IF he has a website set in user settings -->
        <div class="c-post-author__title">
            <?php if($author_website) { ?>
            <a target="_blank" href="<?php echo esc_url( $author_website ); ?>">
            <?php } ?>
                <?php echo esc_html( $author_display ); ?>
            <?php if($author_website) { ?>
            </a>
            <?php } ?>
        </div>
        <!-- number of posts as a link that goes to author archive -->
        <div class="c-post-author__info">
            <a href="<?php echo esc_url( $author_posts_url ); ?>">
                <?php
                //_n( $single:string, $plural:string, $number:integer, $domain:string )
                //number_format_i18n formats number to international settings
                printf( esc_html(_n( '%s post', '%s posts', $author_posts, '_themename' )), number_format_i18n( $author_posts ));
                ?>
            </a>
        </div>

        <div class="c-post-author__desc">
            <?php echo esc_html( $author_description ); ?>
        </div>
    </div>
</div>