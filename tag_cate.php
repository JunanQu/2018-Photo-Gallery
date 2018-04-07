<?php include('includes/init.php');
$current_page_id="index";
const BOX_UPLOADS_PATH = "uploads/photos/";
?>
<?php
$tag_name_carrier = strtoupper(filter_input(INPUT_GET, 'tag_carrier', FILTER_SANITIZE_STRING));


function array2string($data){
    $log_a = "";
    foreach ($data as $key => $value) {
        if(is_array($value))    $log_a .= "[".$key."] => (". array2string($value). ") \n";
        else                    $log_a .= "[".$key."] => ".$value."\n";
    }
    return $log_a;
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <script src="scripts/dropdown.js"></script>

  <title>Gallery</title>
</head>

<body>
<?php include('includes/header.php')?>
<?php

$sql2 = "SELECT id FROM tags WHERE tags.tag_name LIKE :tag_name  ";
$params = array(
      ':tag_name' => $tag_name_carrier
    );
$tag_id_record = exec_sql_query($db, $sql2, $params)->fetchAll(PDO::FETCH_ASSOC);

$tag_id_record=implode($tag_id_record[0]);

$sql = "SELECT DISTINCT photo_id FROM photo_tags WHERE photo_tags.tag_id LIKE :tag_id_record";
$params = array(
      ':tag_id_record' => $tag_id_record
    );
$photo_id_records = exec_sql_query($db, $sql, $params)->fetchAll(PDO::FETCH_ASSOC);
// var_dump($photo_id_records);
foreach ($photo_id_records as $key => $value) {
$records = exec_sql_query($db, "SELECT * FROM photos")->fetchAll(PDO::FETCH_ASSOC);
foreach ($records as $key) {
  if (in_array($key['id'], $value)) {
  echo "<div class='image-frame'>
        <div class='inner-frame'>
        <a href='image_detail.php?id_carrier=".htmlspecialchars($key['id'])."' name='image_data'>
        <img class='images' alt='icon-image' src='uploads/photos/".htmlspecialchars($key['id']).".".htmlspecialchars($key['photo_ext'])."'>
        </a>
        </div>
        </div>";
}
}}







?>



<?php include('includes/footer.php')?>
</body>
</html>
