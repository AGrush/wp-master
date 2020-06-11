<?php

//DELETE POST
function _themename_handle_delete_post() {
  if( isset($_GET['action']) && $_GET['action'] === '_themename_delete_post' ) {
    //check if nonce is set and is valid
    if(!isset($_GET['nonce']) || !wp_verify_nonce( $_GET['nonce'], '_themename_delete_post_nonce' . $_GET['post'] ) ) {
      return;
    }
    //arguments are stored in the super global $_GET
    //isset check if variable is set (in the url variables)
    if( isset($_GET['action']) && $_GET['action'] === '_themename_delete_post'){
      //if postid exists in url set it to this variable
      $post_id = isset($_GET['post']) ? $_GET['post'] : null;
      //check database for the post
      $post = get_post((int) $post_id);
      //if post doesnt exist
      if(empty($post)){
        return;
      }
      //delete post
      wp_trash_post ( $post_id );

      wp_safe_redirect( home_url() );

      die;
    }
  }
}

add_action( 'init', '_themename_handle_delete_post' );