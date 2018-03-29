<?php include('includes/init.php');
$current_page_id="image_detail";
const BOX_UPLOADS_PATH = "uploads/photos/";
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

  $id_carrier = $_GET['id_carrier'];
  // var_dump($id_carrier);
  $sql = "SELECT * FROM photos WHERE photos.id LIKE   :clicked_id  ";
  $params = array(
        ':clicked_id' => $id_carrier
      );
  $records = exec_sql_query($db, $sql, $params)->fetchAll(PDO::FETCH_ASSOC);
  foreach($records as $record){
    // var_dump($record);
    echo "<div class='detailed-image-frame'>
          <img class='detailed_image' alt='icon-image' src='uploads/photos/".htmlspecialchars($record['id']).".jpg'>
          <p class='detailed_description'>".htmlspecialchars($record['photo_description'])."</p>
          </div>
    ";
  }
  ?>


<?php include('includes/footer.php')?>
</body>
</html>
