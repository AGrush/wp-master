<?php

add_action( 'add_meta_boxes', '_themename_add_meta_box' );
function _themename_add_meta_box() {
  add_meta_box( 
      '_themename_post_metabox', 
      //title: appears top of meta setting
      'Post Settings', 
      //callback responsible for rendering the content inside the metabox
      '_themename_post_metabox_html', 
      //which post types we would like this metabox to appear in (could be an array: array(asddf,adfds))
      'post', 
      //where we want it to appear: normal, advanced or side.
      'normal', 
      //priority of the order which it will appear
      'default'
      //callback args: none used here
      );
}

//we are given the post object as an argument here, we'll use it to make it appear in the input if it has been set
function _themename_post_metabox_html($post) {

  // get id from post object, get the meta_key from below, last
  // get_post_meta( post_id, key, single:boolean ) we are in the loop so we can use get the_ID() //single- returns last value if true or whole array by default-->
  $subtitle = get_post_meta($post->ID, '__themename_post_subtitle', true);
  $layout = get_post_meta($post->ID, '__themename_post_layout', true);
  //wp_nonce_field( action, name, referer, echo ) //this will create a hidden input field with a nonce value with ur hex code for ur session id, timestamp etc
  wp_nonce_field( '_themename_update_post_metabox', '_themename_update_post_nonce' );

  // echo '<pre>';
  // var_dump(get_post_type_object( $post->post_type ));
  // echo '</pre>';
  ?>
    <p>
        <label for="_themename_post_metabox_html"><?php esc_html_e( 'Post Subtitle', '_themename' ); ?></label>
        <br />
        <!-- name will be available in the post superglobal -->
        <input class="widefat" type="text" name="_themename_post_subtitle_field" id="_themename_post_metabox_html" value="<?php echo esc_attr( $subtitle ); ?>" />
    </p>
    <p>
        <label for="_themename_post_layout_field"><?php esc_html_e( 'Layout', '_themename' ); ?></label>
        <select name="_themename_post_layout_field" id="_themename_post_layout_field" class="widefat">
            <!-- selected( $selected:mixed, $current:mixed, $echo:boolean ) -->
            <option <?php selected( $layout, 'full' ); ?> value="full"><?php esc_html_e( 'Full Width', '_themename' ); ?></option>
            <option <?php selected( $layout, 'sidebar' ); ?> value="sidebar"><?php esc_html_e( 'Post With Sidebar', '_themename' ); ?></option>
        </select>
    </p>
  <?php

}

//SAVING THE POSTED METADATA WHEN SAVE CLICKED
// whatever is typed here will be available in the superglobal variables
add_action( 'save_post', '_themename_save_post_metabox', 10, 2 );
function _themename_save_post_metabox($post_id, $post) {
  //add_post_meta( post_id, meta_key, meta_value, unique )
  //update_post_meta( post_id, meta_key, meta_value, unique ) //if (meta_key) exists in database it will update, if not it will create

  
  
  //we get the edit_capability dynamically to work on pages & posts, if current user should not edit we return;
  //check vardump above;
  //get_post_type_object( post_type ): returns info about the post type;
  $edit_cap = get_post_type_object( $post->post_type )->cap->edit_post;
  
  if( !current_user_can( $edit_cap, $post_id )) {
    return;
  }

  //wp_verify_nonce( $nonce:string, $action:string|integer )
  //if the nonce in the hidden field set above is not set or not the real deal return
  if( !isset( $_POST['_themename_update_post_nonce']) || !wp_verify_nonce( $_POST['_themename_update_post_nonce'], '_themename_update_post_metabox' )) {
    return;
  }

  if(array_key_exists('_themename_post_subtitle_field', $_POST)) {
    update_post_meta( 
        $post_id, 
        //any value for the database meta_key, if it exists in database it will update, if not it will create
        //an underscore before the key means this will not appear in the dropdown and have its own meta box
        '__themename_post_subtitle',
        //the value of what the user typed
        sanitize_text_field($_POST['_themename_post_subtitle_field'])
    );
  }


  if(array_key_exists('_themename_post_layout_field', $_POST)) {
    update_post_meta( 
        $post_id, 
        '__themename_post_layout', 
        sanitize_text_field($_POST['_themename_post_layout_field'])
    );
  } 

}