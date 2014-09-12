<html>

  <head>
    <title>
      BUYNSELL@IITM
    </title>
  </head>
  <body>
  <?php

    include "db.php";
    session_start();
    if(!isset($_SESSION['rollnum'])){
      header("Location: /buynsell/index.php?exp=1");
      exit();
    }
    
    $connection = mysql_connect($WEBHOST, $USER, $PASSWORD);
    mysql_select_db($DATABASE, $connection);
    if(!$connection)
      die("Mysql connection with the database failed".mysql_error());
    if(isset($_GET['myposts']) && $_GET['myposts'] == 1){
      echo "<h3>This page shows posts only from you</h3>";
      echo "<h3>Insted to see posts from all users <a href = '/buynsell/posts.php?allposts=1'> Click Here</a></h3>";
      $result = mysql_query("SELECT * FROM items WHERE user_id = '{$_SESSION['user_id']}' ORDER BY timestamp DESC",$connection);
      if(!$result)
	die("Mysql query error".mysql_error());
      for($i=0;$i<mysql_num_rows($result);$i++){
	$array = mysql_fetch_array($result);
	echo "<span style = 'color:red'>Post Number: ".($i+1)."</span><br />";
	echo "<span style = 'color:green'>Item Name: ".$array['item_name']."</span><br />";
	echo "<span>Price as Specified By the User: ".$array['price']."</span><br />";
	echo "<span>Description:<br /><span style = 'color:green'>".$array['description']."</span></span><br />";
	echo "<span>Reason for selling:<br /><span style = 'color:green'>".$array['reason']."</span></span>";
	echo "<br /><br />---------------------------------------------------------------------------<br /><br />";

      }
    
    }
    
    else if(isset($_GET['allposts']) && $_GET['allposts'] == 1){
    
      echo "<h3>This page shows posts from all the users</h3>";
      
      $result = mysql_query("SELECT * FROM items ORDER BY timestamp DESC",$connection);
      if(!$result)
	die("Mysql query error".mysql_error());
      for($i=0;$i<mysql_num_rows($result);$i++){
	$array = mysql_fetch_array($result);
	echo "<span style = 'color:red'>Post Number: ".($i+1)."</span><br />";
	echo "<span style = 'color:green'>Item Name: ".$array['item_name']."</span><br />";
	echo "<span>Price as Specified By the User: ".$array['price']."</span><br />";
	echo "<span>Description:<br /><span style = 'color:green'>".$array['description']."</span></span><br />";
	echo "<span>Reason for selling:<br /><span style = 'color:green'>".$array['reason']."</span></span><br /><br />";
	echo "<span style = 'color:blue'><b>User Details:<br /></b></span>";
	
	$userdetails = mysql_query("SELECT * FROM userinfo WHERE id = '{$array['user_id']}'");
	if(!$userdetails)
	  die("Mysql error in query".mysql_erro());
	$userarray = mysql_fetch_array($userdetails);
	echo "<span><span color: green>User Name: </span><span>".$userarray['fullname']."</span><br />";
	echo "<span><span color: green>RollNumber: </span><span>".$userarray['rollno']."</span><br />";
	echo "<span><span color: green>Hostel: </span><span>".$userarray['hostel']."</span><br />";
	echo "<span><span color: green>Room Number: </span><span>".$userarray['roomno']."</span><br />";
	echo "<span><span color: green>email id: </span><span>".$userarray['emailid']."</span><br />";
	echo "<br /><br />---------------------------------------------------------------------------<br /><br />";

      }
    }

  ?>
  </body>
</html>