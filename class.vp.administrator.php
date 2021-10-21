<?php


class VideosPluginAdministrator{

  private static $initiated = FALSE;

  public static function init(){
    if(!self::$initiated){
      self::$initiated = TRUE;
      self::init_hooks();
    }
  }
  private static function init_hooks(){
    //echo 'AAAAA';

    register_post_type( VP_POST_TYPE,
        array(
            'labels' => array(
                'name' => 'Plugin Test Videos',
                'singular_name' => 'Video',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Video',
                'edit' => 'Edit',
                'edit_item' => 'Edit Video',
                'new_item' => 'New Video',
                'view' => 'View',
                'view_item' => 'View Video',
                'search_items' => 'Search Plugin Test Videos',
                'not_found' => 'No Plugin Test Videos found',
                'not_found_in_trash' => 'No Plugin Test Videos found in Trash',
                'parent' => 'Parent Video'
            ),
 
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields', 'page-attributes' ),
            //'supports'=>'all',
            'taxonomies' => array( 'category' ),
            'menu_icon' => 'dashicons-admin-media',
            'has_archive' => true
        )
    );


    add_action( 'admin_menu', array( 'VideosPluginAdministrator', 'admin_menu_settings' ) );


    add_filter('manage_'.VP_POST_TYPE.'_posts_columns', function($columns) {
      return array_merge($columns, ['shortcode' => __('Shortcode', 'textdomain')]);
    });
    add_action('manage_'.VP_POST_TYPE.'_posts_custom_column', function($column_key, $post_id) {
      if ($column_key == 'shortcode') {
        //$shortcode = get_post_meta($post_id, 'shortcode', true);
        echo '<input type="text" value=\'[plugin_video id="'.$post_id.'"]\'>';
      }
    }, 10, 2);


    //actions:
    //vp_plugin_upload_bulk_videos
    add_action('admin_post_vp_plugin_upload_bulk_videos', ['VideosPluginAdministrator', 'vp_plugin_upload_bulk_videos']);
  }
  public static function admin_menu_settings(){
    /*echo 'edit.php?post_type='.VP_POST_TYPE;*/
    add_submenu_page(
      'edit.php?post_type='.VP_POST_TYPE,
      'Settings Page Title',
      'Settings Page Menu',
      'manage_options',//capability
      'video_plugin_settings_slug',
      ['VideosPluginAdministrator', 'video_plugin_settings_slug_admin_page']
      //'video_plugin_settings_slug_admin_page'
    );
/*
    add_submenu_page(
      'edit.php?post_type='.VP_POST_TYPE,
      __( 'Test Settings', 'menu-test' ),
      __( 'Test Settings', 'menu-test' ),
      'manage_options',
      'testsettings',
      'mt_settings_page'
    );*/
  }
  public static function video_plugin_settings_slug_admin_page(){
    //echo 'this will be the admin settings page';
    require_once __DIR__.'/view/admin/settings.php';
  }

  public static function plugin_activation(){}
  public static function plugin_deactivation(){}


  public static function vp_plugin_upload_bulk_videos(){
    require_once __DIR__.'/actions/vp_plugin_upload_bulk_videos.php';
  }

}

?>