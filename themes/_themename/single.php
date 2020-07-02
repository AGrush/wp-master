<!-- basically a copy of index.php but with some sidebar customfields support and no exerpt -->

<?php get_header("myheader") ?>

<?php
    //use our helper function to get the metadata from our custom custom fields (and set a default)
    $layout = _themename_meta( get_the_ID(), '__themename_post_layout', 'full' );

    //if sidebar is deactivated revert to 'full' width
    $sidebar = is_active_sidebar( 'primary-sidebar' );
    if($layout === 'sidebar' && !$sidebar) {
        $layout = 'full';
    }
?>

<div class="o-container u-margin-bottom-40 o-single-post-<?php echo $layout; ?>">
    <div class="o-row">
        <div class="o-row__column o-row__column--span-12 o-row__column--span-<?php echo $layout === 'sidebar' ? '8' : '12' ?>@medium">
            <main role="main">
                <!-- the path of the template to include (get_template_part will search in the child theme for 'loop-single' first then 'loop' then in parent theme) -->
                <?php get_template_part( 'loop', 'single' ); ?>
            </main>
        </div>
        <?php if( $layout === 'sidebar') { ?>
          <div class="o-row__column o-row__column--span-12 o-row__column--span-4@medium">
              <!-- get_sidebar gets a file in your theme called get_sidebar -->
              <?php get_sidebar(); ?>
          </div>
        <?php } ?>
    </div>
</div>

<?php get_footer(); ?>