<?php 

//load main website css AND js assets
add_action('wp_enqueue_scripts', '_themename_assets');
function _themename_assets(){
    //get_template_directory_uri() will always reference the parent theme
    wp_enqueue_style('_themename-stylesheet', get_template_directory_uri() . '/dist/assets/css/bundle.css', array(), '1.0.0', 'all');

 
    //add a plugin included in wp core: https://developer.wordpress.org/reference/functions/wp_enqueue_script/
    //wp_enqueue_script('jquery');

    // include this php so tat $inline_styles becomes available. Include always needs base path like this
    include(get_template_directory() . '/lib/inline-css.php');

    // handle1 - css style sheet that exists and we want to load handle2 css after
    wp_add_inline_style( '_themename-stylesheet', $inline_styles );


    //include jquery in the array of dependancies here, (dependancies will load b4 script)
    wp_enqueue_script( '_themename-scripts', get_template_directory_uri() . '/dist/assets/js/bundle.js', array('jquery'), '1.0.0', true );

    //JS ability to reply to comments without reloading & new page, only load on single page, only if comments are enabled, if nested comments are enabled
    if( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

//enqueue css only in gutenberg
add_action( 'enqueue_block_editor_assets', '_themename_block_editor_assets' );
function _themename_block_editor_assets() {
    wp_enqueue_style( '_themename-block-editor-styles', get_template_directory_uri() . '/dist/assets/css/editor.css', array(), '1.0.0', 'all' );
}





//load admin page css AND js assets
add_action('admin_enqueue_scripts', '_themename_admin_assets');
function _themename_admin_assets(){
    wp_enqueue_style('_themename-admin-stylesheet', get_template_directory_uri() . '/dist/assets/css/admin.css', array(), '1.0.0', 'all');
    wp_enqueue_script( '_themename-admin-scripts', get_template_directory_uri() . '/dist/assets/js/admin.js', array(), '1.0.0', true );
};



// load login page css AND js assets
add_action( 'login_enqueue_scripts', '_themename_login_assets' );
function _themename_login_assets() {
    wp_enqueue_style( '_themename-login-stylesheet', get_template_directory_uri() . '/dist/assets/css/login.css', array(), '1.0.0', 'all');
    wp_enqueue_script( '_themename-login-scripts', get_template_directory_uri() . '/dist/assets/js/login.js', array(), '1.0.0', true );
};


//customize api
add_action( 'customize_preview_init', '_themename_customize_preview_js');
function _themename_customize_preview_js() {
    wp_enqueue_script( '_themename-cutomize-preview', get_template_directory_uri() . '/dist/assets/js/customize-preview.js', array('customize-preview', 'jquery'), '1.0.0' , true );

    include(get_template_directory() . '/lib/inline-css.php');

    //MAKE PHP VARIABLE AVAILABLE TO JS, handle1- php variable(handle2) to be available in this file (so the handle2 js variable is injected before it in the index), handle2- object that will contain all of our variables that we want to pass from php to js, handle3- is an array of variables that we would like to be available in handle2 object for example we want inline_styles_sleelectors to be available under the name inline-css.
    wp_localize_script( '_themename-cutomize-preview', '_themename', array('inline-css' => $inline_styles_selectors) );
};




?>