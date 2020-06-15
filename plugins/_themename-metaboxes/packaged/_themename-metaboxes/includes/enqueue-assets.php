<?php 

//load plugins admin page css AND js scripts
add_action('admin_enqueue_scripts', 'bubdrops_metaboxes_admin_scripts');

function bubdrops_metaboxes_admin_scripts(){
  //access the current pagename
  global $pagenow;
  if ($pagenow !== 'post.php') return;

  wp_enqueue_script( 'bubdrops-metaboxes-admin-scripts', plugins_url( 'bubdrops-metaboxes/dist/assets/js/admin.js' ), array( 'jquery' ), '1.0.0', true);

  wp_enqueue_style( 'bubdrops-metaboxes-admin-stylesheet',  plugins_url('bubdrops-metaboxes/dist/assets/css/admin.css'), array(), '1.0.0', 'all' );
};
