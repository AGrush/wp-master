<!-- like single.php but for pages -->
<?php get_header(); ?>

<div class="o-container u-margin-bottom-40">
    <div class="o-row">
        <div class="o-row__column o-row__column--span-12 o-row__column--span-8@medium">
            <main role="main">
                <!-- theres a loop for the page even though there is always one page -->
                <?php get_template_part( 'loop', 'page' ); ?>
            </main>
        </div>
        <!-- all default pages to have a sidebar -->
        <div class="o-row__column o-row__column--span-12 o-row__column--span-4@medium">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>