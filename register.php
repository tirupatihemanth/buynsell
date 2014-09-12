<?php
    $connection = mysql_connect("localhost","hemanth","0808122582");
    mysql_select_db("userinfo_buynsell",$connection);
    if(isset($_POST["signup"])){
	$fullname = $_POST["usr_name"];
	$rollnum = $_POST["rollno"];
	$email = $_POST["email"];
	$passwd1 = $_POST["password1"];
	$passwd2 = $_POST["password2"];
	if($passwd1 == $passwd2){
	    $hashed_pwd = sha1($passwd1);
	}
	else{
	    header("Location: /index.php?err
	}
    }
?>