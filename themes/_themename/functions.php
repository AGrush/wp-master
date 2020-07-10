<?php 

//customise-api settings
require_once('lib/customize.php');

require_once('lib/helpers.php');
require_once('lib/enqueue-assets.php');

//need sidebars defined to have 'Widgets' option in 'Appearance'
require_once('lib/sidebars.php');

//wordpress html5 tag support functions
require_once('lib/theme-support.php');

//nav bar support
require_once('lib/navigation.php');

//delete-posts
require_once('lib/delete-post.php');

//metaboxes - coming from a plugin now
//require_once('lib/metaboxes.php');

//ask to activate necessary plugins we've built using tgm plugin activator here, add new plugin paths in here
require_once('lib/include-plugins.php');

//change comments markup
require_once('lib/comment-callback.php');
?>