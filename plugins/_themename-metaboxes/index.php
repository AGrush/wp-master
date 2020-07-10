<?php
/*
Plugin Name:  _themename _pluginname
Plugin URI: 
Description: Adding Metaboxes for _themename
Version: 1.0.0
Author: Andrey Grushevskiy
Author URI: 1-g.co.uk
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: _themename-_pluginname
Domain Path: /languages
*/

//if ( ! defined( 'WPINC' ) ) die; and if ( ! defined( 'ABSPATH' ) ) exit; add an extra layer of security by preventing any direct access to your plugin file.
if( !defined('WPINC')) {
  die;
}

include_once('includes/metaboxes.php');
include_once('includes/enqueue-assets.php');