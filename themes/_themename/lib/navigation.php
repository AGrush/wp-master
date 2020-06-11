<?php 

function _themename_register_menus() {
    register_nav_menus( array(
        'main-menu' => esc_html__('Main Menu', '_themename'),
        'footer-menu' => esc_html__('Footer Menu', '_themename')
    ) );
}
// init: Fires after WordPress has finished loading but before any headers are sent. Many plugins instantiate themselves on it for all sorts of reasons (e.g. they need a user, a taxonomy, etc.)
add_action( 'init', '_themename_register_menus' );




//inserting aria attributes for dropdown menus, this function runs and returns $atts in the add_filter function below
function _themename_aria_hasdropdown($atts, $item, $args) {

    if($args->theme_location == 'main-menu') {
        if(in_array('menu-item-has-children', $item->classes)){
            //key/value attributes
            $atts['aria-haspopup'] = 'true';
            $atts['aria-expanded'] = 'false';
        }
    }
    
    return $atts;
}
//priority 10, args 3
add_filter( 'nav_menu_link_attributes', '_themename_aria_hasdropdown', 10, 3);


//Wrap the arow in a button for accessibility (separate function as there is a lot of html)
function _themename_submenu_button($dir = 'down', $title) {
    $button = '<button class="menu-button">';
    $button .= '<span class="u-screen-reader-text menu-button-show">' . sprintf(esc_html__('Show %s submenu', '_themename'), $title) . '</span>';
    $button .= '<span aria-hidden="true" class="u-screen-reader-text menu-button-hide">' . sprintf(esc_html__('Hide %s submenu', '_themename'), $title) . '</span>';
    $button .=   '<i class="fa fa-angle-' . $dir . '" aria-hidden="true"></i>';
    $button .= '</button>';

    return $button;
}


//FILTER ARROWS ON TO MENU TITLE
//Four args: 1. menu title that we need to filter, 2.every navigation $item is a post object containint its custom post info,
//           3. the args are passed from wp_nav_menu in header 4. depth is what level the menu is on 0,1,2..
function _themename_dropdown_icon($title, $item, $args, $depth) {

    //only run for specific menus (main-menu)
    if($args->theme_location == 'main-menu') {
        //does the class 'menu-item-has-children' exist in the array of classes inside the menu $item post object?
        if(in_array('menu-item-has-children', $item->classes)){
            if($depth == 0) {
                //if its the top menu $item add down arrow icon
                $title .= _themename_submenu_button('down', $title);
            } else {
                //if 'no-arrow' is in the title classes of lower menus dont show arrow (meant for megamenu)
                if(!in_array('no-arrow', $item->classes)){
                //if any other menu $item add right arrow icon
                    $title .= _themename_submenu_button('right', $title);
                }
            }
        }
    }

    //returned the filtered title
    return $title;
}
//hook the filter to 'nav_menu_item_title', priority 10(default) and 4 arguments.
//http://hookr.io/filters/nav_menu_item_title/
add_filter( 'nav_menu_item_title', '_themename_dropdown_icon', 10, 4);