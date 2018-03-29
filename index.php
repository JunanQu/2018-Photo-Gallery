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



  <?php
  $records = exec_sql_query($db, "SELECT * FROM photos")->fetchAll(PDO::FETCH_ASSOC);
  foreach($records as $record){
    echo "<div class='image-frame'>
          <div class='inner-frame'>
          <form name='image_data' action='image_detail.php' method='get'>
          <input type='image' border='0' class='images' alt='icon-image' src='uploads/photos/".htmlspecialchars($record['id']).".jpg'>
          <input name='id_carrier' type='hidden' value=".htmlspecialchars($record['id']).">
          </form>
          <form class='tag-form' action='index.php' method='post' name='tag_input'>
          <label class='tag_label'>Tags:</label>
          <input type='text' name='tag_input' required>
          <button class='tag_submit_button' name='submit_tag' type='submit' value='Submit'>Tag It!</button>
          </form>
          </div>
          </div>";
  }
  ?>


<?php include('includes/footer.php')?>
</body>
</html>
