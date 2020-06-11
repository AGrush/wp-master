<!-- using post_class function allows wordpress to add its custom classes + the custom classes we add here -->
<article <?php post_class('c-post u-margin-bottom-20') ?>>
    <h2 class="c-post__title">
        <!--| the_permalink template tage gets the link for this blog post -->
        <!--| the_title_attribute template tage gets the link for this blog post -->
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a>
    </h2>
    <div class="c-post__meta">
        <?php _themename_post_meta(); ?>
    </div>
    <div class="c-post__excerpt">
        <?php the_excerpt(); ?>
    </div>
    <?php _themename_readmore_link(); ?>
    <?php echo _themename_delete_post(); ?>

    <!--  
    //to get the value of any meta box in out content we use get_post_meta:
    get_post_meta( post_id, key, single:boolean ) 
    //we are in the loop so we can use get the_ID() for arg1
    //arg3: returns last value if true or whole array by default
    -->
    <!-- <?php var_dump(get_post_meta( get_the_ID(), 'price')) ?> -->
</article>