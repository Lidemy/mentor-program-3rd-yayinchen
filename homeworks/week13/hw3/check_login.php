<?php
  require_once 'conn.php'; 

  session_start();

  $user = null;
  $nickname = null;

  if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $user = $_SESSION['username'];
    $nickname = $_SESSION['nickname'];
  }
?>