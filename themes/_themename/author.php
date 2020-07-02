<!-- page for author archive, not inside the loop (basically copy of archive.php but with author bit) -->

<?php get_header(); ?>
<?php
// get author id
$author = get_query_var('author');
// same as in single.php but we are outside the loop here
$author_posts = count_user_posts($author);
$author_display = get_the_author_meta( 'display_name', $author );
$author_description = get_the_author_meta( 'user_description', $author );
$author_website = get_the_author_meta( 'user_url', $author );

?>
<div class="o-container u-margin-bottom-40">
    <div class="o-row">

        <div class="o-row__column o-row__column--span-12 o-row__column--span-4@medium">
            <header>
                <!-- get_avatar( $id_or_email:mixed, $size:integer pixels, $default:string, $alt:string, $args:array|null )  -->
                <?php echo get_avatar($author, 128); ?>
                <h1 class="u-margin-top-20"><b><?php echo esc_html($author_display) ?></b></h1>
                <div class="c-post-author__info">
                    <?php
                        /* translators: %s is the number of posts */
                        printf( esc_html(_n( '%s post', '%s posts', $author_posts, '_themename' )), number_format_i18n( $author_posts ));
                    ?>
                    <br />
                    <?php if($author_website) { ?>
                        <a target="_blank" href="<?php echo esc_url( $author_website ); ?>"><?php echo esc_html($author_website) ?></a>
                    <?php } ?>
                </div>
                <p class="c-post-author__desc"><?php echo esc_html($author_description) ?></p>
            </header>
        </div>

        <div class="o-row__column o-row__column--span-12 o-row__column--span-8@medium">
            <main role="main">
                <!-- give child theme developers chance to add loop-author.php -->
                <?php get_template_part( 'loop', 'author' ); ?>
            </main>
        </div>
      
    </div>
</div>
<?php get_footer(); ?>