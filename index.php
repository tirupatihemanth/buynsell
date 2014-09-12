<?php
    
    include "functions.php";
    include "db.php";
    session_start();
    $connection = mysql_connect($WEBHOST,$USER,$PASSWORD);
    if(!$connection){
      die("Mysql connection with the database failed".mysql_error());
    }
    mysql_select_db($DATABASE,$connection);
    if(isset($_POST['login'])){
	$rollnum = $_POST["rollno"];
	$hashed_passwd = sha1($_POST["password"]);
	$result = mysql_query("SELECT * FROM userinfo WHERE rollno = '{$rollnum}' AND password = '{$hashed_passwd}'", $connection);
      if(mysql_num_rows($result)==1){
	$user = mysql_fetch_array($result);
	$_SESSION['rollnum']=$user['rollno'];
	$_SESSION['user_id']=$user['id'];
	redirectTo("afterlogin.php");
      }
    else{
	echo "<span style = 'color:red'><b>Invalid rollnum or Password. Please make sure that you you use your LDAP password???</b></span>";   
	}
    }
    mysql_close($connection);
?>

<html>
    <head>
	<link href = "stylesheets/css_login_signup.css" rel= "stylesheet" type = "text/css"/>
	<title>
	    Buy&Sell@IITM
	</title>
    </head>
    <body>
	<?php
	  if(isset($_GET['exp']) && $_GET['exp'] == 1){
	    echo "<span style = 'color:red'><b>You page got expired.., Please Login again!!!</b></span>";
	  }
	  if(isset($_GET['logout']) && $_GET['logout'] == 1){
	    echo "<span style='color:red'><b>You have logged out successfully </b> </span>";
	  }
	
	?>
	<h1 id = "welcome">
	    Welcome To BUY&SELL@IITM
	</h1>
	<h4>
	    An Online Market For Your Unused Articles.
	</h4>
	<p>
	    Login to see all the products
	</p>
	<h3>
	    Login Here:
	</h3>
	<form method = "POST" action="index.php">
	    <p>
		Roll No.: <input type = "text" name = "rollno"></input>
	    </p>
	    <p>
		Password:<input type = "password" name = "password"></input>  
	    </p>
	    <input type="submit" name = "login" value = "Login"></input>
	</form>
	
    </body>
</html>