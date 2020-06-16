<footer class="c-post__footer">
    <?php
    //does the post have any categories?
    if(has_category()) {
        echo '<div class="c-post__cats">';
        // the following coment format is a comment translators will see
        /* translators: used betweeen categories on single page */
        $cats_list = get_the_category_list( esc_html__( ', ', '_themename' ) );
        /* translators: %s is the categories list */
        printf(esc_html__( 'Posted in %s', '_themename' ), $cats_list);
        echo "</div>";
    }
    //is the post tagged in some way?
    if(has_tag()) {
        echo '<div class="c-post__tags">';
        //get_the_tag_list( $before:string, $sep:string, $after:string, $id:integer )
        $tags_list = get_the_tag_list( '<ul><li>', '</li><li>', '</li></ul>' );
        echo $tags_list;
        echo "</div>";
    }
    ?>
</footer>