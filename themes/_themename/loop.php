<!--| the post loop/ the have_posts here is dependant on the URL -->
<?php if(have_posts()) { ?>
    <?php while(have_posts()) { ?>
     <!--| this has to be here or there is an infinite loop -->
        <?php the_post(); ?>            <!-- add second argument here to allow for different post formats (wp feature) -->
            <?php get_template_part( 'template-parts/post/content' ); ?>
        <?php } ?>
    <?php the_posts_pagination(); ?>
    <?php do_action('_themename_after_pagination'); ?>
<?php } else { ?>
    <!-- no posts found template, content-none modifier for no posts -->
    <?php get_template_part( 'template-parts/post/content', 'none' ); ?>
<?php } ?>