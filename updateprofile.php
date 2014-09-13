<?php

  include "db.php";
  session_start();
  if(!isset($_SESSION['rollnum'])){
    header("Location: /buynsell/index.php?exp=1");
    exit();
  }

?> 

<?php
    $html_auto_fill = array();
    $passwordmismatch = 0;
    $passworderror = 0;
    $profileupdate = 0;
    $passwordupdate =0;
    $connection = mysql_connect($WEBHOST, $USER, $PASSWORD);
    mysql_select_db($DATABASE,$connection);
    if(!$connection)
      die("Mysql connection with the database failed".mysql_error());
    
    $userinfo = mysql_query("SELECT * FROM userinfo WHERE id = '{$_SESSION['user_id']}'");
     
     if(!$userinfo)
	die("Mysql query error ".mysql_error());
     $userinfo = mysql_fetch_array($userinfo);
     $html_auto_fill[0] = $userinfo['fullname'];
     $html_auto_fill[1] = $userinfo['hostel'];
     $html_auto_fill[2] = $userinfo['roomno'];
     $html_auto_fill[3] = $userinfo['emailid'];
     $html_auto_fill[4] = $userinfo['phoneno'];
      
    if(isset($_POST['updateprofile'])){
      
      $result = mysql_query("UPDATE userinfo SET fullname = '{$_POST['fullname']}', hostel = '{$_POST['hostel']}', roomno = '{$_POST['roomno']}', emailid = '{$_POST['emailid']}', phoneno = '{$_POST['phoneno']}' WHERE id = '{$_SESSION['user_id']}' ",$connection);

      if(!$result)
	die("Mysql query error ".mysql_error());
	
      $userinfo = mysql_query("SELECT * FROM userinfo WHERE id = '{$_SESSION['user_id']}'");
     
     if(!$userinfo)
	die("Mysql query error ".mysql_error());
     $userinfo = mysql_fetch_array($userinfo);
     $html_auto_fill[0] = $userinfo['fullname'];
     $html_auto_fill[1] = $userinfo['hostel'];
     $html_auto_fill[2] = $userinfo['roomno'];
     $html_auto_fill[3] = $userinfo['emailid'];
     $html_auto_fill[4] = $userinfo['phoneno'];
	
      $profileupdate = 1;
      
      
    
    }
    else if(isset($_POST['passwordreset'])){
      $userinfo = mysql_query("SELECT * FROM userinfo WHERE id = '{$_SESSION['user_id']}'");
      if(!$userinfo)
	die("Mysql query error ".mysql_error());
      $userinfo = mysql_fetch_array($userinfo);
      
      $current_hashed_password = sha1($_POST['currentpassword']);
      
      if($current_hashed_password!=$userinfo['password'])
	$passworderror = 1;
	
      if($_POST['newpassword1'] != $_POST['newpassword2'])
	$passwordmismatch = 1;
      
      if($_POST['newpassword1'] == $_POST['newpassword2'] && $current_hashed_password == $userinfo['password']){
	
	$new_hashed_password = sha1($_POST['newpassword1']);
	$result = mysql_query("UPDATE userinfo SET password = '{$new_hashed_password}' WHERE id = '{$_SESSION['user_id']}'");
	
	if(!$result)
	  die("Mysql query error ".mysql_error());
	
	$passwordupdate = 1;
      
      }

    }
    mysql_close($connection);

?>

<html>
  <head>
    <title>Update Profile | BUYNSELL@IITM</title>
  </head>
  <body>
    <h1>
      Update Your profile So that other people who buy your products can easily reach you
    </h1>
    <?php
       if($_SESSION['count'] == 1)
	  echo "<span style = 'color:green'><b> Seems Like You Are logging in for the first time BUYNSELL@IITM WELCOMES YOU :)<br /><br /></b></span>";
    ?>
    
    <a href = "afterlogin.php">My Home Page</a>
    
    <form method = "post" action = "updateprofile.php">
      
	<?php echo "<p>Enter Your Full Name: <input type = 'text' value = '".$html_auto_fill[0]."' name = 'fullname'></input></p>"; ?>
	
	<?php echo "<p>HOSTEL: <input type = 'text' value = '".$html_auto_fill[1]."' name = 'hostel'></input></p>"; ?>
	
	<?php echo "<p> Room No.: <input type = 'number' value = '".$html_auto_fill[2]."' name = 'roomno'></input></p>"; ?>
	
	<?php echo "<p>Email Id: <input type = 'email' value = '".$html_auto_fill[3]."' name = 'emailid'></input></p>"; ?>
	
	<?php echo "<p>Phone No.: <input type = 'number' value = '".$html_auto_fill[4]."' name = 'phoneno'></input></p>"; ?>
    
        <input type = "submit" value = "Update Profile" name = "updateprofile"></input>
        
    </form>
    
    <?php
      if($profileupdate == 1)
	echo "<span style = 'color:green'> Your profile update is successful :)</span><br />";
    ?>
    
    <form method = "post" action = "updateprofile.php">
      <p style = 'color:red'>
	<b><em>You May Change Your Password here: </b></em><br />
      </p>
      <p>
	Please confirm your current Password : <input type = "password" name = "currentpassword"></input>
      </p>
      <p>
	Enter Your new password : <input type = "password" name = "newpassword1"></input>
      </p>
      <p>
	Enter Your new Password again : <input type = "password" name = "newpassword2"></input>
      </p>
      <input type = "submit" value = "confirm password reset" name = "passwordreset"></input>
    </form>
    
    <?php
    
    if($passwordupdate == 1)
      echo "<span style = 'color:green'>Your password update is successful :)</span><br />";
    if($passworderror == 1)
      echo "<span style = 'color:red'> The current password you typed is wrong</span><br />";
    if($passwordmismatch == 1)
      echo "<span style = 'color:red'> The new password's you typed doesn't match</span>";
    
    
    ?>
  </body>

</html>
