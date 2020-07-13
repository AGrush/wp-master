

<?php get_header("myheader") ?>
<div class="o-container u-margin-bottom-40"><!-- same as index.php apart from an archive header 'the_archive_title' -->
    <div class="o-row">
        <!-- the only difference on this page to index page at the moment is that it has the archive title & description at the top: -->
        <div class="o-row__column o-row__column--span-12">
            <header>
                <!-- takes before and after tags as arguments -->
                <?php the_archive_title( '<h1>', '</h1>'); ?>
                <?php the_archive_description( '<p>', '</p>') ?>
            </header>
        </div>
        <div class="o-row__column o-row__column--span-12 o-row__column--span-<?php echo is_active_sidebar('primary-sidebar') ? '8' : '12'; ?>@medium">
            <main role="main">
                <!-- the path of the template to include (get_template_part(slug,name) will search in the child theme for 'loop-archive' first then 'loop' then same in parent theme) -->
                <?php get_template_part( 'loop', 'archive' ); ?>
            </main>
        </div>
        <?php if(is_active_sidebar( 'primary-sidebar' )) { ?>
            <div class="o-row__column o-row__column--span-12 o-row__column--span-4@medium">
                <?php get_sidebar(); ?>
            </div>
        <?php } ?>
    </div>
</div>
<?php 
// $comments = 10;

// $city = 'London';


//wrong: echo esc_html__('Your city is', '_themename') . $city;

//allow to place the city in different postions for different languages, (printf includes echo)

// printf(  /* translators: $s is the city name */
//     esc_html__( 'Your city is %s', '_themename'), $city
// );

//plurals _n
//printf(_n('One comment', '%s comments', $comments, '_themename'), $comments);

// dont use these as they are not escaped:
// translate
// _x('Post', 'noun', '_themename');
// echo & translate
// _ex('Post', 'noun', '_themename');
?>
<?php get_footer() ?>
