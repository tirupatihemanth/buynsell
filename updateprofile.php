<?php

session_start ();
require_once 'functions.php';
sessionCheck ();
//include "header.php";
include "dnb.html";
$html_auto_fill = array ();
//$passwordmismatch = 0;
//$passworderror = 0;
$profileupdate = 0;
//$passwordupdate = 0;

$connectionObject = getConnection ();
$userinfoObject = queryDB ( $connectionObject, "SELECT * FROM userinfo WHERE rollno = '{$_SESSION['user_rollno']}'" ); 
$userinfo = $userinfoObject->fetch_array ();
$_SESSION['user_id'] = $userinfo['id'];
$_SESSION['user_fullname'] = $userinfo ['fullname'];
if(strlen($userinfo['fullname']) == 0){
	$_SESSION['user_fullname'] = $_SESSION['user_rollno'];
}

$html_auto_fill [0] = $userinfo ['fullname'];
$html_auto_fill [1] = $userinfo ['hostel'];
$html_auto_fill [2] = $userinfo ['roomno'];
$html_auto_fill [3] = $userinfo ['emailid'];
$html_auto_fill [4] = $userinfo ['phoneno'];

if (isset ( $_POST ['updateprofile'] )) {
	
	queryDB($connectionObject, "UPDATE userinfo SET fullname = '{$_POST['fullname']}', hostel = '{$_POST['hostel']}', roomno = '{$_POST['roomno']}', emailid = '{$_POST['emailid']}', phoneno = '{$_POST['phoneno']}' WHERE id = '{$_SESSION['user_id']}' ");
	
	$userinfoObject = queryDB($connectionObject, "SELECT * FROM userinfo WHERE id = '{$_SESSION['user_id']}'" );
	
	$userinfo = $userinfoObject->fetch_array();
	$html_auto_fill [0] = $userinfo ['fullname'];
	$html_auto_fill [1] = $userinfo ['hostel'];
	$html_auto_fill [2] = $userinfo ['roomno'];
	$html_auto_fill [3] = $userinfo ['emailid'];
	$html_auto_fill [4] = $userinfo ['phoneno'];
	
	$profileupdate = 1;
} /*else if (isset ( $_POST ['passwordreset'] )) {
	
	$userinfoObject = 
	$userinfo = mysql_query ( "SELECT * FROM userinfo WHERE id = '{$_SESSION['user_id']}'" );
	if (! $userinfo)
		die ( "Mysql query error " . mysql_error () );
	$userinfo = mysql_fetch_array ( $userinfo );
	
	$current_hashed_password = sha1 ( $_POST ['currentpassword'] );
	
	if ($current_hashed_password != $userinfo ['password'])
		$passworderror = 1;
	
	if ($_POST ['newpassword1'] != $_POST ['newpassword2'])
		$passwordmismatch = 1;
	
	if ($_POST ['newpassword1'] == $_POST ['newpassword2'] && $current_hashed_password == $userinfo ['password']) {
		
		$new_hashed_password = sha1 ( $_POST ['newpassword1'] );
		$result = mysql_query ( "UPDATE userinfo SET password = '{$new_hashed_password}' WHERE id = '{$_SESSION['user_id']}'" );
		
		$passwordupdate = 1;
	}
} */
$connectionObject->close();
?>

<html>
<head>
<title>Update Profile | BUYNSELL@IITM</title>
</head>
<body>
	<div class="col-xs-10 col-xs-offset-1 container">
		<h4>Update Your profile So that other people who buy your products can
			easily reach you</h4>
    <?php
				if (isset ( $_GET ['firsttime'] ) && $_GET ['firsttime'] == 1) {
						echo "<div class='alert alert-warning'><b> Seems Like You Are logging in for the first time! Welcome to Buy & Sell<br />Please Update Your profile so that other people can know more about you<br /></b></div>";
				}
				?>
    <form method="post" action="updateprofile.php">
      
	<?php echo "<p>Enter Your Full Name: <input type = 'text' value = '".$html_auto_fill[0]."' name = 'fullname'></input></p>"; ?>
	
	<?php echo "<p>HOSTEL: <input type = 'text' value = '".$html_auto_fill[1]."' name = 'hostel'></input></p>"; ?>
	
	<?php echo "<p> Room No.: <input type = 'number' value = '".$html_auto_fill[2]."' name = 'roomno'></input></p>"; ?>
	
	<?php echo "<p>Email Id: <input type = 'email' value = '".$html_auto_fill[3]."' name = 'emailid'></input></p>"; ?>
	
	<?php echo "<p>Phone No.: <input type = 'number' value = '".$html_auto_fill[4]."' name = 'phoneno'></input></p>"; ?>
    
        <input type="submit" value="Update Profile" name="updateprofile"></input>

		</form>
    
    <?php
				if ($profileupdate == 1)
					echo "<div class='alert alert-success'> Your profile update is successful.</div><br />";
				?>
    
<!--     <form method="post" action="updateprofile.php"> -->
			<p style='color: red'>
<!-- 				<b><em>You May Change Your Password here: </b></em><br /> -->
<!-- 			</p> -->
<!-- 			<p> -->
<!-- 				Please confirm your current Password : <input type="password" -->
<!-- 					name="currentpassword"></input> -->
<!-- 			</p> -->
<!-- 			<p> -->
<!-- 				Enter Your new password : <input type="password" name="newpassword1"></input> -->
<!-- 			</p> -->
<!-- 			<p> -->
<!-- 				Enter Your new Password again : <input type="password" -->
<!-- 					name="newpassword2"></input> -->
<!-- 			</p> -->
<!-- 			<input type="submit" value="confirm password reset" -->
<!-- 				name="passwordreset"></input> -->
<!-- 		</form> -->
    
    <?php
				
// 				if ($passwordupdate == 1)
// 					echo "<span style = 'color:green'>Your password update is successful :)</span><br />";
// 				if ($passworderror == 1)
// 					echo "<span style = 'color:red'> The current password you typed is wrong</span><br />";
// 				if ($passwordmismatch == 1)
// 					echo "<span style = 'color:red'> The new password's you typed doesn't match</span>";
				
// 				?>

	</div>
</body>

</html>
