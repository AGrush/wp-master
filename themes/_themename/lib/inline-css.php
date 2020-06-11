
<?php

$inline_styles_selectors = array (
    'a' => array(
        'color' => '_themename_accent_colour',
    ),
    ':focus' => array(
        'outline-color' => '_themename_accent_colour',
    ),
    '.c-post.sticky' => array(
        'border-left-color' => '_themename_accent_colour',
    ),
    //find these using chrome inspector
    'button, input[type=submit], .header-nav .menu > .menu-item:not(.mega) .sub-menu .menu-item:hover > a' => array(
        'background-color' => '_themename_accent_colour',
    )
);

$inline_styles = "";

//css properties
foreach ($inline_styles_selectors as $selector => $props) {
    $inline_styles .= "{$selector} {";
        foreach ($props as $prop => $value) {
            //value coiming from database so must be sanitised
            $inline_styles .= "{$prop}: " . sanitize_hex_color(get_theme_mod( $value, '#20ddae' )) . ";";
        }
    $inline_styles .= "} ";
}

