<?php 

function _themename_theme_support(){

    //add_theme_support takes a feature argument. this adds title support for wp_head
    add_theme_support( 'title-tag' );

    add_theme_support( 'post-thumbnails' );

    add_theme_support( 'html5', array('search-form', 'comment-list', 'comment-form', 'gallery', 'caption') );

    add_theme_support( 'customize-selective-refresh-widgets' );

    add_theme_support( 'custom-logo', array(
        'height' => 200,
        'width' => 600,
        //allows editing aspect ratio in image editor
        'flex-height' => true,
        'flex-width' => true
    ));
}

//this function (& after_setup_theme hook) is called when each page is loaded after theme is initialised.
add_action('after_setup_theme', '_themename_theme_support');

?>