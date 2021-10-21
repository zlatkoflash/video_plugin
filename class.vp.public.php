<?php

class VideosPlugin{

  private static $initiated = FALSE;

  public static function init(){
    if(!self::$initiated){
      self::$initiated = TRUE;
      self::init_hooks();
    }
  }

  private static function init_hooks(){
    add_shortcode('plugin_video', ['VideosPlugin', 'ViewTheVideo']);
  }

  public static function ViewTheVideo($attrs=[]){
    $video_id = $attrs['id'];
    $video_url = get_post_meta($video_id, 'video_url', TRUE);
    $video_id = explode('?', $video_url)[1];
    $video_id = str_replace('v=', '', $video_id);
    ////www.youtube.com/embed/q1HW6DdBCKw?v=q1HW6DdBCKw
    return 
      '<a href="'.$video_url.'" target="_blank">Click to play the video external</a>
      
      <iframe src="//www.youtube.com/embed/'.$video_id.'?v='.$video_id.'" style="display:block;width:100%; height: 50vh;"></iframe>
      ';
  }

}

?>