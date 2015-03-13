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
	<div class="container col-xs-10 col-xs-offset-1">
		<div class='alert alert-warning col-xs-10 col-xs-offset-1'><p>Update Your profile So that other people who buy your products can
			easily reach you</p></div>
    <?php
				if (isset ( $_GET ['firsttime'] ) && $_GET ['firsttime'] == 1) {
						echo "<div class='alert alert-warning'><b> Seems Like You Are logging in for the first time BUYNSELL@IITM WELCOMES YOU :)<br />Please Update Your profile So that other people can know more about you<br /></b></div>";
				}
				?>
        <div class='col-xs-10 col-xs-offset-1'>
    <form method="post" action="updateprofile.php">
        <div class="form-group">
            <label for="Input1">Enter your full name:</label>
            <input type="text" class="form-control" value = '<?php echo $html_auto_fill[0] ?>' name='fullname' id="Input1" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="Input2">Enter your hostel name:</label>
            <input type="text" class="form-control" value = '<?php echo $html_auto_fill[1] ?>' name='hostel' id="Input2" placeholder="Enter hostel">
        </div>
        <div class="form-group">
            <label for="Input3">Enter your room no:</label>
            <input type="number" class="form-control" value = '<?php echo $html_auto_fill[2] ?>' name='roomno' id="Input3" placeholder="Enter room no">
        </div>
        <div class="form-group">
            <label for="Input4">Enter your email id:</label>
            <input type="text" class="form-control" value = '<?php echo $html_auto_fill[3] ?>' name='emailid' id="Input4" placeholder="Enter email ID">
        </div>
        <div class="form-group">
            <label for="Input5">Enter your phone number:</label>
            <input type="text" class="form-control" value = '<?php echo $html_auto_fill[4] ?>' name='phoneno' id="Input5" placeholder="Enter phone no">
        </div>
	    <button type="submit" class="btn btn-default" value="Update Profile" name="updateprofile">Submit</button>
		</form><br></div>
    
    <?php
				if ($profileupdate == 1)
					echo "<br><br><div class='col-xs-10 col-xs-offset-1 alert alert-success'> Your profile update was successful.</div><br />";
				?>
    
<!--     <form method="post" action="updateprofile.php"> 
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
