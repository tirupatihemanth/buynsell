<?php
  include "db.php";
  session_start();
  if(!isset($_SESSION['rollnum'])){
    header("Location: /buynsell/index.php?exp=1");
    exit();
  }
?>

 <?php
 
  //session_start();
  //include "db.php";
  $connection = mysql_connect($WEBHOST, $USER, $PASSWORD);
  mysql_select_db($DATABASE,$connection);
  if(!$connection)
    die("Mysql connection with the database failed".mysql_error());
    
  if(!isset($_SESSION['rollnum'])){
    header("Location: /buynsell/index.php?exp=1");
    exit();
    
  }
  else if (isset($_POST['post'])){
    
    $result = mysql_query("INSERT INTO items(item_name,price,description,reason,user_id) VALUE('{$_POST['item_name']}', '{$_POST['price']}', '{$_POST['description']}', '{$_POST['reason']}','{$_SESSION['user_id']}')", $connection);

    if(!$result)
        die("mysql_query error has occured".mysql_error());
        
    $result = mysql_query("SELECT item_id,user_id FROM items WHERE user_id = '{$_SESSION['user_id']}' ORDER BY timestamp DESC ");
    
    if(!$result)
        die("mysql_query error has occured".mysql_error());
    //echo mysql_num_rows($result);
    $result = mysql_fetch_array($result);
    //print_r($result);
    $item_id = $result['item_id'];
    //echo $item_id;
    if(isset($_POST['category'])){
      
      for($i=0;$i<8;$i++){
	if(isset($_POST['category'][$i])){
	//echo $_POST['category'][$i];
	$result = mysql_query("SELECT * FROM tags WHERE tag_name = '{$_POST['category'][$i]}'");
	
	if(!$result)
	  die("mysql_query error has occured".mysql_error());
	  
	if(mysql_num_rows($result)==1){
	  $result = mysql_fetch_array($result);
	  $tag_id = $result['tag_id'];
	}
	else
	  die("mysql_query error has occured".mysql_error());
	
	$result = mysql_query("INSERT INTO item_tags(item_id,tag_id) value('{$item_id}', '{$tag_id}')", $connection);
	if(!$result)
	  die("mysql_query error has occured".mysql_error());
      
	}
      }
    
    }
    echo "<span style= 'color:green'><b>Your posts has been successfully posted. Check your posts or All posts to have a look at it</b></span>";
  }
  
 ?>


<html>
    <head>
	<link href="stylesheets/css_afterlogin.css" rel = "stylesheet" type = "text/css"/>
	<title>BUY&SELL@IITM</title>	
    </head>
    <body>
	<h1>
	    <?php
	      $connection = mysql_connect($WEBHOST,$USER,$PASSWORD);
	      
	      if(!$connection)
		die("Mysql connection with the dtatabase failed".mysql_error());
		
	      mysql_select_db($DATABASE,$connection);
	      
	      $result = mysql_query("SELECT * FROM userinfo WHERE rollno = '{$_SESSION['rollnum']}'");
	      if(mysql_num_rows($result)==1){
		$user = mysql_fetch_array($result);
		$_SESSION['fullname'] = $user['fullname'];
	      }
	      if($_SESSION['fullname']=="")
		echo "BUYNSELL@IITM WELCOMES ". $_SESSION['rollnum'];
	      else
		echo "BUYNSELL@IITM WELCOME ". $_SESSION['fullname'];
	      mysql_close($connection);
	    ?>
	</h1>
	<h4>
	    ...A Site For IITM Junta
	</h4>
	<p>We thank you for joining our project of making the Life At IITM more peaceful!!!</p>
	<p>You have some unused products and would like to sell them It's simple now.  Post Below:</p>
	
	<a href = "posts.php?myposts=1">My Posts</a><br />
	<a href = "posts.php?allposts=1">All Posts</a><br />
	
	<form method="post" action = "afterlogin.php">
	    <p>
		Enter the name of the object you would like to sell precisely below:
	    </p>
	    <p>
		Name:<input type ="text" name = "item_name"></input>
	    </p>
	    <p>
		Selling Price(in Rs):<input type = "number" name="price"></input>
	    </p>
	    <p>
	      Please choose related tags from below:
	    </p>
	    <p>
	      <input type = "checkbox" name = "category[]" value = "mobiles">Mobiles</input>
	      <input type = "checkbox" name = "category[]" value = "tablets">Tablets</input>
	      <input type = "checkbox" name = "category[]" value = "laptops">Laptops</input>
	      <input type = "checkbox" name = "category[]" value = "electronic devices">Electronic Devices</input>
	      <input type = "checkbox" name = "category[]" value = "cycles">Cycles</input>
	      <input type = "checkbox" name = "category[]" value = "academics">Academics Related</input>
	      <input type = "checkbox" name = "category[]" value = "eatables">Eatables</input>
	      <input type = "checkbox" name = "category[]" value = "others">others</input>
	    </p>
	    <p>
		Brief Description:
	    </p>
	    <textarea rows = 10 cols = 100 name = "description"></textarea>
	    <p>
	      Specific reason for selling your product:
	    </p>
	    <textarea rows =10 cols = 100 name = "reason"></textarea>
	    <br />
	    <input type = "submit" name = "post" value = "post"></input>
	</form>
	<a href = "logout.php">logout good bye</a>
    </body>
</html>
