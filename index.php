<?php include('includes/init.php');
$current_page_id="index";
const BOX_UPLOADS_PATH = "uploads/photos/";
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
<div class="image-tag-index-out">
<?php
$sql_name = "SELECT DISTINCT tag_name FROM tags";
$alltag_name = exec_sql_query($db, $sql_name)->fetchAll(PDO::FETCH_ASSOC);
foreach ($alltag_name as $name) {
  echo"<div class='image-tag-index'>
       <a href='tag_cate.php?tag_carrier=".htmlspecialchars($name['tag_name'])."' name='tag_data'>"
       .htmlspecialchars($name['tag_name'])."
       </a>
       </div>
       ";
}
?>
</div>
<?php
$records = exec_sql_query($db, "SELECT * FROM photos")->fetchAll(PDO::FETCH_ASSOC);
foreach($records as $record){
  echo "<div class='image-frame'>
        <div class='inner-frame'>
        <a href='image_detail.php?id_carrier=".htmlspecialchars($record['id'])."' name='image_data'>
        <img  class='images' alt='icon-image' src='uploads/photos/".htmlspecialchars($record['id']).".".htmlspecialchars($record['photo_ext'])."'>
        </a>
        </div>
        </div>";
  }
?>
<?php include('includes/footer.php')?>
</body>
</html>
