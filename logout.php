<?php
  session_start();
  if(isset($_SESSION['user_id'])){
    session_unset();
    setcookie("user_id","",time()-(30*24*3600));
    session_destroy();
    header("Location: /buynsell/index.php?logout=1");
    exit();
  }
?>