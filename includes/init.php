<?php

$title = "Junan's Image";


// 1.
function exec_sql_query($db, $sql, $params = array()) {
  try{

    $query = $db->prepare($sql);
    if ($query and $query->execute($params)) {
      return $query;
  }

}catch (PDOException $exception) {
  handle_db_error($exception);
  }
}


function handle_db_error($exception) {
  echo '<p><strong>' . htmlspecialchars('Exception : ' . $exception->getMessage()) . '</strong></p>';
}

$messages = array();

// Record a message to display to the user.
function record_message($message) {
  global $messages;
  array_push($messages, $message);
}

// Write out any messages to the user.
function print_messages() {
  global $messages;
  foreach ($messages as $message) {
    echo "<p><strong>" . htmlspecialchars($message) . "</strong></p>\n";
  }
}

function open_or_init_sqlite_db($db_filename, $init_sql_filename) {
  if (!file_exists($db_filename)) {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db_init_sql = file_get_contents($init_sql_filename);
    if ($db_init_sql) {
      try {
        $result = $db->exec($db_init_sql);
        if ($result) {
          return $db;
        }
      } catch (PDOException $exception) {
        unlink($db_filename);
        throw $exception;
        handle_db_error ($exception);
      }
    }
  } else {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
  }
  return NULL;
}

$db = open_or_init_sqlite_db("new.sqlite", "init/init.sql");

function check_login() {
  global $db;

  if (isset($_COOKIE["session"])) {
    $session = $_COOKIE["session"];

    $sql = "SELECT * FROM accounts WHERE session = :session_id;";
    $params = array (
      ":session_id" => $session,
    );
    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if ($records) {
      $account = $records[0];
      return $account["username"];
    }
  }
  return NULL;
}

//
function log_in($username, $password) {
  global $db;
  if ($username && $password) {

    $sql = "SELECT * FROM accounts WHERE username = :username;";
    $params = array(
      ':username' => $username
    );
    $records = exec_sql_query($db, $sql, $params)->fetchAll();

    if ($records) {
      $account = $records[0];
      if ($account['password'] == $password) {


        $session = uniqid();
        $sql = "UPDATE accounts SET session = :session WHERE id = :user_id;";
        $params = array (
          ":user_id" => $account['id'],
          ":session" => $session
        );
        $result = exec_sql_query($db, $sql, $params);
        if ($result) {

          setcookie("session", $session, time()+3600);

          record_message("Logged in as $username");
          return $username;
        }
      } else {
        $log_out_clicked = 0;
        record_message("Invalid username or password.");
      }
    } else {
      $log_out_clicked = 0;
      record_message("Invalid username or password.");
    }
  } else {
    $log_out_clicked = 0;
    record_message("No username or password given.");
  }
  return NULL;
}
//
//
function log_out() {
  global $current_user;
  global $db;

  if ($current_user) {

    $sql = "UPDATE accounts SET session = :session WHERE username = :username;";
    $params = array (
      ":username" => $current_user,
      ":session" => NULL
    );
    if (!exec_sql_query($db, $sql, $params)) {
      record_message("log out failed.");
    }
    $current_user = NULL;
    setcookie("session", "", time()-3600);

  }

}



if (isset($_POST['login'])) {
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $username = trim($username);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  $current_user = log_in($username, $password);
}else{
  $current_user = check_login();
}

// check if logged in



if (isset($current_user)){
$tabs = array(
  "index" => "Gallery",
  "view_my_picture" => "View My Pictures",
  "log_out"=> "Log Out",
);

}else {
  $tabs = array(
    "index" => "Gallery",
    "log_in" => "Log In"
  );
}

?>
