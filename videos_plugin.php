<?php
/**
 * @package Videos Plugin
 */
/*
Plugin Name: Videos PLugin
Plugin URI: -
Description: Not description yet
Version: 1.0.1
Author: Zlatkoflash
Author URI: -
License: GPLv2 or later
Text Domain: videos_plugin
*/

/*
Copyright 2021Automattic, Inc.
*/




define('VP_VERSION', '1.0.0');
define('VP_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('VP_POST_TYPE', 'video');
define('VP_ADMIN_POST_URL', admin_url( 'admin-post.php' ));

register_activation_hook( __FILE__, array( 'VideosPluginAdministrator', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'VideosPluginAdministrator', 'plugin_deactivation' ) );


require_once VP_PLUGIN_DIR.'class.vp.public.php';
add_action( 'init', array( 'VideosPlugin', 'init' ) );
//add_action( 'template_redirect', array( 'DSTP', 'template_redirect' ) );

if(is_admin()){
  require_once VP_PLUGIN_DIR.'class.vp.administrator.php';
  add_action( 'init', array( 'VideosPluginAdministrator', 'init' ) );
}

?>