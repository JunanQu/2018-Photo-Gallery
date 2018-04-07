<?php include('includes/init.php');
$current_page_id="view_my_picture";
?>
<?php
const MAX_FILE_SIZE = 10000000;
const BOX_UPLOADS_PATH = "uploads/photos/";
$image_types = array('gif', 'jpg', 'jpeg', 'png', 'jpe');
if (isset($_POST["submit"]) ) {
  $target_dir = "uploads/photos/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $upload_info = $_FILES["fileToUpload"];
  $upload_desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
  $upload_name = basename($upload_info["name"]);
  $upload_ext = strtolower(pathinfo($upload_name, PATHINFO_EXTENSION) );
  $upload_info = $_FILES["fileToUpload"];
  if (in_array($upload_ext, $image_types)){
    if ($upload_info['error'] == UPLOAD_ERR_OK ) {
    $sql = "INSERT INTO  `photos` (photo_name, photo_ext, photo_description) VALUES (:filename, :extension, :description)";
    $params = array(
      ':extension' => $upload_ext,
      ':filename' => $upload_name,
      ':description' => $upload_desc,
    );
    $result = exec_sql_query($db, $sql, $params);
    if ($result) {
      $file_id = $db->lastInsertId("id");
      if (move_uploaded_file($upload_info["tmp_name"], BOX_UPLOADS_PATH . "$file_id.$upload_ext")){
        array_push($messages, "Your file has been uploaded.");
        $sql = "INSERT INTO  `photo_users` (photo_id, user_name) VALUES (:photoid, :username)";
        $params = array(
          ':photoid' => $file_id,
          ':username' => $current_user,
        );
        $result = exec_sql_query($db, $sql, $params);
      }
    }
  }if ($upload_info['error'] != UPLOAD_ERR_OK ) {
     array_push($messages, "Fail To Upload.");
  }
}else {
  array_push($messages, "Uploading File Is Not An Image.");
}

}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <script src="scripts/dropdown.js"></script>

  <title>View My Pictures</title>
</head>

<body>
<?php include('includes/header.php')?>
<?php
if (isset($_POST['delete'])) {
  $id_carrier = $_POST['id_carrier'];
  $delete_query = "DELETE FROM photos WHERE photos.id LIKE '%' || :current_image_id || '%'";
  $params = array(
        ':current_image_id' => $id_carrier
      );
  $store_delete = exec_sql_query($db, $delete_query, $params)->fetchAll(PDO::FETCH_ASSOC);
}

?>
<?php

$sql = "SELECT * FROM photos LEFT JOIN photo_users ON photos.id = photo_users.photo_id LEFT JOIN accounts ON photo_users.user_name = accounts.username WHERE accounts.username LIKE  '%' || :currentuser || '%'";
$params = array(
      ':currentuser' => $current_user
    );
$records = exec_sql_query($db, $sql, $params)->fetchAll(PDO::FETCH_ASSOC);


foreach($records as $record){

  echo "<div class='image-frame'>
        <div class='inner-frame'>
        <a href='image_detail.php?id_carrier=".htmlspecialchars($record['photo_id'])."' name='image_data'>
        <img  class='images' alt='icon-image' src='uploads/photos/".htmlspecialchars($record['photo_id']).".".htmlspecialchars($record['photo_ext'])."'>
        </a>

        <form name='image_data' action='view_my_picture.php' method='post'>
        <button class='tag_submit_button' name='delete' type='submit' value='Submit'>Delete It!</button>
        <input name='id_carrier' type='hidden' value=".htmlspecialchars($record['photo_id']).">
        </form>
        </div>

        </div>";
}
?>




<?php
if ($current_user != NULL) {
        echo'
        <div id="upload_frame">
        <h1 class="uploaded-message">';
        print_messages();
        echo '</h1>
        <form id="upload_form" action="view_my_picture.php" enctype="multipart/form-data" method="post">
            <label>Upload Your Image:</label>';
        echo '<input type="file" name="fileToUpload" id="fileToUpload" required>';

        echo'<label>Description:</label>
            <textarea name="description" cols="40" rows="5" required></textarea>
            <Button type="submit" name="submit">Submit</Button>
          </form>
        </div>';
}else {
    echo '<div id="log_out_reminder">';
    record_message("Please Log In!");
    print_messages();
    echo '</div>';
}
?>
