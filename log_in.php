<?php include('includes/init.php');

$current_page_id="log_in";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <script src="scripts/dropdown.js"></script>

  <title>Log In</title>
</head>

<body>
<?php include('includes/header.php')?>
<div class="wrapper">
  <h2>Login</h2>
  <?php
  if (isset($_POST["login"])){
  // print_messages();
  }
  ?>
  <?php

  ?>
  <div class="form">
      <?php

      ?>
      <form action="index.php" method="post">
      <label>Username</label>
      <input type="text" name="username" placeholder="Username" required/>
      <label>Password</label>
      <input type="password" name="password" placeholder="Password" required />
      <button name="login" type="submit" value="LogIn">Log In</button>
    </form>

  </div>
</div>
<?php include('includes/footer.php')?>
</body>
</html>
