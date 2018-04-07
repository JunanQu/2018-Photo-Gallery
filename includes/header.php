<?php
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
      <div class="index-banner1">
        <div class="header-top">
        <div class="wrap">
            <div class="logo">
            <a href="index.php"><img src="images/logo.png" alt=""/></a>
            <?php
            if (isset($_POST['login'])) {
            } if (isset($current_user)) {
              echo "<h1 class='user_greetinhg'>Hello, $current_user!</h1>";
            } else{
              echo "<h1 class='user_greetinhg'>Please Log In!</h1>";
            }
            ?>
          </div>
          <div class="menu">
              <div class="box" id="box">
                  <div class="box_content_center1">
                    <div class="menu_box_list1">

                      <button onclick="myFunction()" class="dropbtn"><img src="images/nav_icon.png" alt=""></button>
                      <div id="drop_down_menu" class="dropdown-content">
                        <?php
                        foreach($tabs as $page_id => $page_name) {
                          if ($page_id == $current_page_id) {
                            $css_id = "class='current_page'";
                          } else {
                            $css_id = "class='current_page_alt'";
                          }
                          echo "<a " . $css_id . " href='" . $page_id. ".php'>$page_name</a>";
                        }
                        ?>
                      </div>

                     </div>
                 </div>
               </div>
            </div>
             <div class="clear"></div>
            </div>
          </div>
      </div>
