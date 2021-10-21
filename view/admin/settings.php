<div style="padding:40px;">

  <form method="post" enctype="multipart/form-data" action="<?php echo VP_ADMIN_POST_URL; ?>">
    <input type="hidden" name="action" value="vp_plugin_upload_bulk_videos">
    <label>
      Attach file CSV with videos
      <input type="file" name="csv_videos">
    </label>
    <button type="submit">Upload bulk csv data with videos</button>
  </form>

</div>
