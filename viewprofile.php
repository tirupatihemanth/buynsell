<?php
	require_once 'functions.php';
	session_start();
	sessionCheck();
	include "dnb.html";
?>

<div class = 'col-xs-10 col-xs-offset-1'>

<?php

	$connectionObject = getConnection();
	$otherProfile = 0;
	$user_id = 0;
	
	if( !isset($_GET['user_id']) || ( $_SESSION['user_id'] == $_GET['user_id'] )){
		$user_id = $_SESSION['user_id'];
		$userinfoObject = queryDB($connectionObject,"SELECT * FROM userinfo WHERE id = '{$_SESSION['user_id']}'");
		$userarray = $userinfoObject->fetch_array();
		//print_r($_SESSION);
		echo "<br /><br /><br /><br /><a href = 'updateprofile.php'>Update Profile</a><br /><br />";
	}
	else{
		$user_id = $_GET['user_id'];
		$userinfoObject = queryDB($connectionObject, "SELECT * FROM userinfo WHERE id = '{$_GET['user_id']}'" );
		$userarray = $userinfoObject->fetch_array();
		$otherProfile = 1;
		echo "<br /><br /><br /><br />"; 
	}
	
	if(isset($_POST['privmessagesubmit'])){
		//echo "got here";
		queryDB ( $connectionObject, "INSERT INTO comments(user_com_id,item_id,visibility,message, user_id) value('{$_SESSION['user_id']}',-1,0,'{$_POST['privmessage']}','{$_GET['user_id']}')" );
		echo "<span style = 'background-color:green; color:white;'>message sent succesfully!!!</span><br />";
	}
	
	if($userinfoObject->num_rows == 0){
		die("No such user exists");
	}
	
	echo"
		<p>
			Full Name: ".$userarray['fullname']."
		</p>
		<br />
		<p>
			Roll No.: ".$userarray['rollno']."		
		</p>
		<br />
		<p>
			Hostel: ".$userarray['hostel']."
		</p>
		<br />
		<p>
			Room No.: ".$userarray['roomno']."
		</p>
		<br />
		<p>
			Email Id: ".$userarray['emailid']."
		</p>
		<br />
		<p>
			Phone No.: ".$userarray['phoneno']."
		</p>
		<br />
	";
	
	if($otherProfile == 1){
		echo "<form method = 'post' action = 'viewprofile.php?user_id=".$user_id."'><textarea name = 'privmessage'></textarea><br /><input id = 'privmessagesubmit' type='submit' name = 'privmessagesubmit' value = 'Send Message'></form>";
	}
	
	$connectionObject->close();
?>


</div>