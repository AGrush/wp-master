<?php 
    //REGISTER 4 SEPARATE SIDEBARS for widgets in the footer (user can change in theme settings)
    $footer_layout = sanitize_text_field(get_theme_mod('_themename_footer_layout', '3,3,3,3'));
    //remove spaces incase user types them between
    $footer_layout = preg_replace('/\s+/', '', $footer_layout);
    
    //explode separates the string with , into array 
    $columns = explode(',', $footer_layout);
    $footer_bg = _themename_sanitize_footer_bg(get_theme_mod( '_themename_footer_bg', 'dark' ));
    $widget_theme = '';
    //logic for no widgets: create flag, loop through widgets & check if any active widgets, if even one is active set variable to true.
    $widgets_active = false;
    foreach ($columns as $i => $column) {
        if( is_active_sidebar( 'footer-sidebar-' . ($i + 1) )) {
            $widgets_active = true;
            break;
        }
    }
?>
<?php if($widgets_active) { ?>
    <!-- "c-footer c-footer--<?php echo $footer_bg; ?>" 
         `c-footer c-footer--${footer_bg}` 
         in js 
    -->
    <div class="c-footer c-footer--<?php echo $footer_bg; ?>">
        <div class="o-container">
            <div class="o-row">
                <?php foreach($columns as $i => $column) { ?>
                    <div class="o-row__column o-row__column--span-12 o-row__column--span-<?php echo $column ?>@medium">
                        <?php if(is_active_sidebar( 'footer-sidebar-' . ($i + 1) )) {
                            dynamic_sidebar( 'footer-sidebar-' . ($i + 1) );
                        } ?>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
<?php } ?>