<?php
  include "db.php";
  session_start();
  if(!isset($_SESSION['user_id'])){
    header("Location: /buynsell/index.php?exp=1");
    exit();
  }
?>

 <?php
  $connection = mysql_connect($WEBHOST, $USER, $PASSWORD);
  if(!$connection)
    die("Mysql connection with the database failed".mysql_error());
  mysql_select_db($DATABASE,$connection);
  $result = mysql_query("SELECT * from userinfo WHERE id = '{$_SESSION['user_id']}'",$connection);
  if(!$result)
    die("Mysql query failed".mysql_error());
  $result = mysql_fetch_array($result);
  $_SESSION['rollnum'] = $result['rollno'];
  $_SESSION['fullname'] = $result['fullname'];

  mysql_close($connection);
  
 ?>


<html>
    <head>
	<link href="stylesheets/css_afterlogin.css" rel = "stylesheet" type = "text/css"/>
	<title>BUY&SELL@IITM</title>	
	<script src = "./ckeditor/ckeditor.js"></script>
    </head>
    <body>
	    <?php
	      $connection = mysql_connect($WEBHOST,$USER,$PASSWORD);
	      include "header.php";
	      if(!$connection)
		die("Mysql connection with the dtatabase failed".mysql_error());
		
	      mysql_select_db($DATABASE,$connection);
	      
	      $result = mysql_query("SELECT * FROM userinfo WHERE rollno = '{$_SESSION['rollnum']}'");
	      if(mysql_num_rows($result)==1){
		$user = mysql_fetch_array($result);
		$_SESSION['fullname'] = $user['fullname'];
	      }
	     if($_SESSION['fullname']=="")
		echo "<br /><br />BUYNSELL@IITM WELCOMES ". $_SESSION['rollnum'];
	      else
	echo "BUYNSELL@IITM WELCOMES ". $_SESSION['fullname'];

	    ?>
	<div class="col-xs-8 col-xs-offset-2">
	<h4>
	    ...A Site For IITM Junta
	</h4>
	<p>We thank you for joining our project of making the Life At IITM more peaceful!!!</p>
	<p>You have some unused products and would like to sell them It's simple now.  Post Below:</p>
	<p>We would like to Introduce to our all new news feed. This feed contans some important notifications such as comments on your posts and also private messages sent to you</p>
	<h3>Public comments on your posts</h3>
	<?php
	$pubcomments = mysql_query("SELECT comments.user_com_id,comments.message,userinfo.rollno FROM items, comments, userinfo WHERE items.item_id = comments.item_id AND items.user_id = '{$_SESSION['user_id']}' AND userinfo.id = comments.user_com_id AND visibility = 1",$connection);
	if(!$pubcomments)
	  die("Mysql query error has occured".mysql_error());
	$rows = mysql_num_rows($pubcomments);
//	echo "<br />blah blah blah<br />";
//	print_r($rows);
	if($rows == 0){
	  echo "<span style = 'background-color:#f7f7f7'>Nothing to see here move along :)</span><br />";
	}
	else{
	  for($i = 0;$i<$rows;$i++){
	    $array = mysql_fetch_array($pubcomments);
	    echo "<span>Sender: <a href='viewprofile.php?user_id=".$array['user_com_id']."'>".$array['rollno']."</a></span><br />";
	    echo "<span style = 'background-color:yellow'>".($i+1).". ".$array['message']."</span><br /><br />";
	  }
	}
	echo "<h3>Some private messages you have got</h3>";
	$privcomments = mysql_query("SELECT comments.user_com_id, comments.message, userinfo.rollno FROM items, comments,userinfo WHERE items.item_id = comments.item_id AND user_id = '{$_SESSION['user_id']}' AND userinfo.id = comments.user_com_id AND visibility = 0",$connection);
	if(!$privcomments)
	  die("Mysql query error has occured".mysql_error());
	$rows = mysql_num_rows($privcomments);
	if($rows == 0){
	  echo "<span style = 'background-color:#f7f7f7'>Nothing to see here move along :)</span><br />";
	}
	else{
	  for($i = 0;$i<$rows;$i++){

	    $array = mysql_fetch_array($privcomments);
	    echo "<span>Sender: <a href='viewprofile.php?user_id=".$array['user_com_id']."'>".$array['rollno']."</a></span><br />";
	    echo "<span style = 'background-color:yellow'>".($i+1).". ".$array['message']."</span><br />";
	  }
	}
	mysql_close($connection);
	
	?>
	</div>
    </body>
</html>
