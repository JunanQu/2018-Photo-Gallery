<?php include('includes/init.php');
$current_page_id="image_detail";
const BOX_UPLOADS_PATH = "uploads/photos/";
?>
<?php
$id_carrier = filter_input(INPUT_GET, 'id_carrier', FILTER_VALIDATE_INT);
if (isset($_POST['submit_tag'])) {
  $upload_tag = strtoupper(filter_input(INPUT_POST, 'tag_input', FILTER_SANITIZE_STRING));
  $upload_tag = str_replace(' ', '', $upload_tag);
  $sql = "INSERT INTO  `tags` (tag_name) VALUES (:tagname);";
      $params = array(
        ':tagname' => $upload_tag
      );
  $result = exec_sql_query($db, $sql, $params);
  if ($result) {
    $file_id = $db->lastInsertId("id");
    $sql = "INSERT INTO  `photo_tags` (photo_id, tag_id) VALUES (:photoid, :tagid)";
    $params = array(
      ':photoid' => $_GET['id_carrier'],
      ':tagid' => $file_id,
    );
    $result = exec_sql_query($db, $sql, $params);
}
}


if (isset($_POST['delete'])) {
  $tag_name_carrier = filter_input(INPUT_POST, 'tag_name_carrier', FILTER_SANITIZE_STRING);
  $delete_query = "DELETE FROM tags WHERE tags.tag_name =  :current_tag_name";
  $params = array(
        ':current_tag_name' => $tag_name_carrier
      );
  $store_delete = exec_sql_query($db, $delete_query, $params)->fetchAll(PDO::FETCH_ASSOC);
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <script src="scripts/dropdown.js"></script>

  <title>Image</title>
</head>
<body>
<?php include('includes/header.php')?>
<?php
$sql = "SELECT DISTINCT tag_name FROM tags INNER JOIN photo_tags ON tags.id = photo_tags.tag_id INNER JOIN photos ON photo_tags.photo_id = photos.id WHERE photos.id LIKE   :clicked_id  ";
$params = array(
':clicked_id' => $id_carrier
);
$tagrecords = exec_sql_query($db, $sql, $params)->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM photos WHERE photos.id LIKE   :clicked_id  ";
$params = array(
':clicked_id' => $id_carrier
);
$records = exec_sql_query($db, $sql, $params)->fetchAll(PDO::FETCH_ASSOC);
foreach($records as $record){
echo "<div class='detailed-image-frame'>
  <img class='detailed_image' alt='icon-image' src='uploads/photos/".htmlspecialchars($record['id']).".jpg'>
  <p class='detailed_description'>".htmlspecialchars($record['photo_description'])."</p>";
echo "<div class='image-tag-out'>";
foreach($tagrecords as $tagrecord){
  if(isset($current_user)){
    $sql = "SELECT DISTINCT user_name FROM photo_users WHERE photo_users.photo_id =  :current_photo";
    $params = array(
          ':current_photo' => $id_carrier
        );
    $records = exec_sql_query($db, $sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($records)){
    $records=(implode($records[0]));
    if ($records==$current_user) {
      echo "<div class='image-tag'>
        <p>#".$tagrecord['tag_name']."</p>
        <form name='image_data' action='image_detail.php?id_carrier=".$id_carrier."' method='post'>
        <button class='tag_submit_button' name='delete' type='submit' value='Submit'>Delete It!</button>
        <input name='tag_name_carrier' type='hidden' value=".htmlspecialchars($tagrecord['tag_name']).">
        </form>
        </div>";
   }else {
     echo "<div class='image-tag'>
       <p>#".$tagrecord['tag_name']."</p>
       </div>";
   }

 }  else {
   echo "<div class='image-tag'>
   <p>#".$tagrecord['tag_name']."</p>
   </div>";
 } }
   else {
   echo "<div class='image-tag'>
   <p>#".$tagrecord['tag_name']."</p>
   </div>";
 }

}
echo "</div>";

echo "
  <form class='tag-form' action='image_detail.php?id_carrier=".$id_carrier."' method='post' name='tag_input'>
  <label class='tag_label'>Tags:</label>
  <input type='text' name='tag_input' required>
  <input type='hidden'name='submit_tag' value = 'submit'>
  <button class='tag_submit_button' name='submit_tag' type='submit' value='Submit'>Tag It!</button>
  </form>
  </div>";
}
?>


<?php include('includes/footer.php')?>
</body>
</html>
