<?php

  // This php file contains the functions that I will be using frequently using

  function redirectTo($address){
      header("Location: /buynsell/$address");
      exit();
  }
  
  function connectioncheck($connection){
    if(!connection)
      die("Mysql connection to database failed ".mysql_error());
  }
  
  function querycheck($result){
    if(!result)
      die("There was an error in your mysql query".mysql_error());
  }

?>

