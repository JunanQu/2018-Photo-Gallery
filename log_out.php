<?php include('includes/init.php');

$current_page_id="log_out";

log_out();
if (!$current_user) {
  record_message("You've been successfully logged out!");
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <script src="scripts/dropdown.js"></script>

  <title>Log Out</title>
</head>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <div id="log_out_frame">
      <?php
      print_messages();
      ?>
    </div>
  </div>

<?php include("includes/footer.php");?>
</body>
</html>
