<!-- using post_class function allows wordpress to add its custom classes + the custom classes we add here -->
<article <?php post_class('c-post u-margin-bottom-20') ?>>
    <div class="c-post__inner">

        <!-- get thumbnail, wp makes three sizes of each image on upload -->
        <?php if(get_the_post_thumbnail() !== '') { ?>
            <div class="c-post__thumbnail">
                <?php the_post_thumbnail( 'large' ); ?>
            </div>
        <?php } ?>

        <?php get_template_part('template-parts/post/header'); ?>

        <?php if(is_single( )) { ?>
            <div class="c-post__content">
                <!-- full content if we are in single page -->
                <?php 
                    the_content(); 
                    //wp_link_pages takes arguments if you want to change html markup for it.
                    //this creates extra pages for extra 'read more' tags in editor
                    wp_link_pages();
                ?>
            </div>
        <?php } else { ?>
            <div class="c-post__excerpt">
                <!-- excerpt if we are in the index page -->
                <?php the_excerpt(); ?>
            </div>
        <?php } ?>

        <!-- not important but good example of diff users ability-->
        <!-- <?php echo _themename_delete_post(); ?> -->

        <!--  
        //to get the value of any meta box in out content we use get_post_meta:
        get_post_meta( post_id, key, single:boolean ) 
        //we are in the loop so we can use get the_ID() for arg1
        //arg3: returns last value if true or whole array by default
        -->
        <!-- <?php var_dump(get_post_meta( get_the_ID(), 'price')) ?> -->
    </div>


    <?php if(is_single( )) { ?>
        <?php get_template_part('template-parts/post/footer'); ?>
    <?php } ?>

    <?php if(!is_single()) { _themename_readmore_link(); } ?>
</article>