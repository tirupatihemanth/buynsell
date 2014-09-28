<?php
	include "db.php";
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location: /buynsell/index.php?exp=1");
		exit();
	}

?>
<?php
	include "header.php";
	$connection = mysql_connect($WEBHOST,$USER,$PASSWORD);
	if(!$connection){
		die("Mysql connection to the database failed ".Mysql_error());
	}
	mysql_select_db($DATABASE,$connection);
		
	if( !isset($_GET['user_id']) || ( $_SESSION['user_id'] == $_GET['user_id'] )){

		$userinfo = mysql_query("SELECT * FROM userinfo WHERE id = '{$_SESSION['user_id']}'",$connection);
			if(!$userinfo)
				die("Mysql query error has occured".Mysql_error());
		$userarray = mysql_fetch_array($userinfo);
		echo "<br /><br /><br /><br /><a href = 'updateprofile.php'>Update Profile</a><br /><br />";
	}

	else{

		$userinfo = mysql_query("SELECT * FROM userinfo WHERE id = '{$_GET['user_id']}'",$connection);
			if(!$userinfo)
				die("Mysql query error has occured".Mysql_error());
		$userarray = mysql_fetch_array($userinfo);
		echo "<br /><br /><br /><br />";
	}
	if(mysql_num_rows($userinfo)==0)
		die("No such user exists");
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
	mysql_close($connection);
?>