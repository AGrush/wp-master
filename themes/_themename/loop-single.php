<!--| the post loop/ the have_posts here is dependant on the URL -->
<?php if(have_posts()) { ?>
    <?php while(have_posts()) { ?>
    <!--| this has to be here or there is an infinite loop -->
        <?php the_post(); ?>            <!-- add second argument here to allow for different post formats (wp feature) -->

        <?php get_template_part( 'template-parts/post/content' ); ?>
      
        <?php 
          //if customizer 'setting' to display author info is on (default = true) display author info.
          if(get_theme_mod('_themename_display_author_info', true)){
            get_template_part( 'template-parts/single/author' ); 
          }
        ?>

        <?php get_template_part( 'template-parts/single/navigation' ); ?>

        <?php 
        //if comments are not disabled OR there are comments and comments are disabled/enabled
        if( comments_open() || get_comments_number()) {
            comments_template();
        }
        ?>

    <?php } ?>
<?php } else { ?>
    <!-- no posts found template, content-none modifier for no posts -->
    <?php get_template_part( 'template-parts/post/content', 'none' ); ?>
<?php } ?>