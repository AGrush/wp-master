<!-- copy of loop-single ish, there will only be one item in the loop.. so dunno why we need a loop-->
<?php if(have_posts()) { ?>
    <?php while(have_posts()) { ?>
        <?php the_post(); ?>

        <!-- use our standard page content template part -->
        <?php get_template_part( 'template-parts/page/content' ); ?>
        
        <!-- allow comments -->
        <?php 
        if( comments_open() || get_comments_number()) {
            comments_template();
        }
        ?>

    <?php } ?>
<?php } else { ?>
    <!-- show no content template part -->
    <?php get_template_part( 'template-parts/post/content', 'none' ); ?>
<?php } ?>