
<?php


//override the parent function
function _themename_post_meta() {
echo 'hsfdfsdxx';
}


//how we enqueue stylesheet in child theme to override parent styles
add_action('wp_enqueue_scripts', '_themename_child_scripts' );
function _themename_child_scripts() {
    wp_enqueue_style('_themename-child-styles', 
    //get_stylesheet_directory_uri() will always reference the active theme even if its a child theme
    //get_template_directory_uri will always reference the parent theme
    get_stylesheet_directory_uri() . '/styles.css',
    //run the parent theme stylesheet first here in this dependency array, then run the child stylesheet
    array('_themename-stylesheet'),
    '1.0.0',
    'all');
}

add_action('_themename_after_pagination', 'after_pagination' );
add_action('_themename_after_pagination', 'after_pagination2');
function after_pagination($x){
    echo $x;
    echo 'bla bla bla bla';
}
function after_pagination2($x){
    echo ' blee blee blee blee';
}

// add_action( 'wp_head', 'function_to_add');
// function function_to_add() {
//     echo '<style>body{background-color:#ff9!important;</style>';
// }

add_filter( '_themename_no_posts_filter', 'no_posts_text');
function no_posts_text($text){
    return $text . esc_html__(' No faackin posts alrite','sdfs-textdomain-child');
}


// filter the titles 
// add_filter( 'the_title', 'filter_title' );
// function filter_title($title){
//     return 'Filtered ' . $title;
// }


?>