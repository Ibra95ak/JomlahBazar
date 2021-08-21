<?php
/*Start browser session*/
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
$action = $_GET['action'];
if ($action=="set-cookie") {
  $cookie_name = $_POST['cookie_name'];
  $cookie_value = $_POST['cookie_value'];
  setcookie($cookie_name, $cookie_value, time() + (10 * 365 * 24 * 60 * 60), "/", "", true, true);
}
if ($action=="get-cookie") {
  $cookie_name = $_POST['cookie_name'];
  if(!isset($_COOKIE[$cookie_name])) {
  echo "NA";
  } else {
    echo $_COOKIE[$cookie_name];
  }
}

?>
