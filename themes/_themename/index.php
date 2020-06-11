<?php get_header("myheader") ?>
<div class="o-container u-margin-bottom-40">
    <div class="o-row">
        <div class="o-row__column o-row__column--span-12 o-row__column--span-<?php echo is_active_sidebar('primary-sidebar') ? '8' : '12'; ?>@medium">
            <main role="main">
                <!-- the path of the template to include (get_template_part will search in the child theme for 'loop-index' first then 'loop' then in parent theme) -->
                <?php get_template_part( 'loop', 'index' ); ?>
            </main>
        </div>
        <?php if(is_active_sidebar( 'primary-sidebar' )) { ?>
            <div class="o-row__column o-row__column--span-12 o-row__column--span-4@medium">
                <!-- get_sidebar gets a file in your theme called get_sidebar -->
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
