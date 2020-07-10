<?php

//$content is for 'enclosing' shortcode tags, $tag is just the shortcode name that we defined below '_themename_button', when u include it u allow filtering (below)
function _themename_button($atts = [], $content = null, $tag = '') {
    //extract will convert the array into normal php variables
    extract(shortcode_atts([
        //default attributes
        'color' => 'red',
        'text' => 'Button'
    ], $atts, $tag));
    
    //shortcodes should always return a value, and variables should be escaped
    //do_shortcode allows outputting shortcodes inside shortcodes, always use it just incase
    return '<button class="_themename_button" style="background-color: ' . esc_attr($color) . '">' . do_shortcode($content) . '</button>';
}

add_shortcode('_themename_button', '_themename_button');


//allow filtering
function func() {
    return [
        'color' => 'green'
    ];
}
add_filter('shortcode_atts__themename_button', 'func');