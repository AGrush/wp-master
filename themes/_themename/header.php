<!DOCTYPE html>
<!--| add language dynamically -->
<html <?php language_attributes(); ?>>
<head>
    <!--| bloginfo returns information about blog from set list of queries -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- title tag will be generated automatically with wp_head hook, also css can be injected here-->
    <?php wp_head(); ?>
</head>
<!-- adds custom useful wp classes -->
<body <?php body_class(); ?> >
    <!-- skip link for keyboard accessibility of main conent -->
    <a class="u-skip-link" href="#content"><?php esc_attr_e('Skip to content', '_themename'); ?></a>
    <header role="banner" class="u-margin-bottom-40">
        <div class="c-header">
            <div class="o-container u-flex u-align-justify u-align-middle">
                <div class="c-header__logo">
                    <!-- home_url is the website address -->
                    <?php if(has_custom_logo( )) {
                        the_custom_logo();
                    } else { ?>
                        <a class="c-header__blogname" href="<?php echo esc_url(home_url( '/' )); ?>"><?php esc_html(bloginfo( 'name' )); ?></a>
                    <?php } ?>
                </div>

                <!-- get_search_form takes a booleean, if true, it generates a search form using some wordpress html, it first searches for searchform.php in ur theme and if not found generates basic search form wordpress html -->
                <?php get_search_form( true ); ?>
            </div>
        </div>
        <div class="c-navigation">
            <div class="o-container">
                <nav class="header-nav" role="navigation" aria-label="<?php esc_html_e( 'Main Navigation', '_themename' ) ?> ">
                    <?php wp_nav_menu( array('theme_location' => 'main-menu')) ?>
                </nav>
            </div>
        </div>
    </header>

    <div id="content">