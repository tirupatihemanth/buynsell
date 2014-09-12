<?php
  session_start();
  if(isset($_SESSION['rollnum'])){
    session_unset();
    session_destroy();
    header("Location: /buynsell/index.php?logout=1");
    exit();
  }
?>