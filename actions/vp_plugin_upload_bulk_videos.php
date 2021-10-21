<?php

//print_r($_POST);
//print_r($_FILES);

$data_matrix = [];

$row = 1;
if (($handle = fopen($_FILES['csv_videos']['tmp_name'], "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            //echo $data[$c] . "<br />\n";
        }
        $data_matrix[] = $data;
    }
    fclose($handle);
}


//Creating main videos category:


$is_subcategories_existing_array = [];

//print_r($data_matrix);
for($iv=1;$iv<count($data_matrix);$iv++){
  $video = $data_matrix[$iv][0];
  $categories = $data_matrix[$iv][1];
  
  $post_ID = wp_insert_post([
    'post_type'=>VP_POST_TYPE,
    'post_status'=>'publish',
    'post_title'=>'Video - '.explode('?', $video)[1]
  ]);

  add_post_meta($post_ID, 'video_url', $video);
  //add_post_meta($post_ID, 'categories', $categories);
  //print_r($data_matrix[$iv]);
  ///////////////////////////////////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////
  /////Adding the categories if not existing
  $categories_array = explode(',', $categories);
  $categories_array_IDs = [];
  //print_r($categories_array);
  foreach($categories_array AS $video_category){
    $video_category = strtolower($video_category);
    if(!isset($is_subcategories_existing_array[$video_category])){
      $wp_video_category = get_category_by_slug($video_category);
      if(!$wp_video_category){
        //echo 'Need to create videos category';
        wp_create_category($video_category);
        $wp_video_category = get_category_by_slug($video_category);
      }
      $is_subcategories_existing_array[$video_category] = $wp_video_category;
    }
    $wp_video_category = $is_subcategories_existing_array[$video_category];
    $categories_array_IDs[] = $wp_video_category->cat_ID;
  }
  wp_set_post_categories($post_ID, $categories_array_IDs);
  //End adding the categories
  ///////////////////////////////////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////
}


wp_redirect('edit.php?post_type='.VP_POST_TYPE);

?>