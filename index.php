<?php

session_start();
require_once "functions.php";
$_SESSION['user_rollno'] = "CS13B027";
redirectTo( "afterlogin.php" );
require 'oauth/oauth_config.php';
require 'oauth/oauth.php';
$oauth = new OAuth ();
$oauth->init ();
if ($oauth->authCode) {
	$_SESSION ['authcode'] = $oauth->authCode;
}
if ($oauth->user ['loggedIn']) {
	$_SESSION ['user_rollno'] = $oauth->user ['username'];
	$connectionObject = getConnection ();
	$resultObject = queryDB ( $connectionObject, "SELECT rollno FROM userinfo where rollno = '{$_SESSION['user_rollno']}' ");
	
	if (! $resultObject->num_rows) {
		queryDB ( $connectionObject, "INSERT INTO userinfo (rollno, count) VALUES ('{$_SESSION['user_rollno']}',1)" );
		redirectTo ( "updateprofile.php?firsttime=1" );
	}
	$connectionObject->close ();
	// print_r($_SESSION);
	redirectTo ( "afterlogin.php" );
} else {
	echo "<a href='$oauth->signinURL'>Sign In</a> ";
}

/*
 *
 * $connection = mysql_connect($WEBHOST,$USER,$PASSWORD);
 * if(!$connection){
 * die("Mysql connection with the database failed".mysql_error());
 * }
 * mysql_select_db($DATABASE,$connection);
 *
 * if(isset($_SESSION['user_id']) && !isset($_GET['exp'])){
 * redirectTo("afterlogin.php");
 * }
 * else if(!isset($_SESSION['user_id']) && isset($_COOKIE['user_id']) && !isset($_GET['exp'])){
 * //echo "blah is here"."<br />";
 * //echo $_COOKIE['rollnum'];
 *
 * $_SESSION['user_id'] = $_COOKIE['user_id'];
 * //echo "id for user".$_COOKIE['user_id'];
 * $result = mysql_query("SELECT count FROM userinfo where id = '{$_SESSION['user_id']}'");
 * $result = mysql_fetch_array($result);
 * $count = $result[0];
 * $count++;
 * $result = mysql_query("UPDATE userinfo SET count = '{$count}' WHERE id = '{$_SESSION['user_id']}'",$connection);
 * redirectTo("afterlogin.php");
 * }
 *
 * if(isset($_POST['login'])){
 * $rollnum = $_POST["rollno"];
 * $hashed_passwd = sha1($_POST["password"]);
 * $result = mysql_query("SELECT * FROM userinfo WHERE rollno = '{$rollnum}' AND password = '{$hashed_passwd}'", $connection);
 * if(mysql_num_rows($result)==1){
 * $user = mysql_fetch_array($result);
 * //$_SESSION['rollnum'] = $user['rollno'];
 *
 * $_SESSION['user_id'] = $user['id'];
 * $status = setcookie("user_id",$_SESSION['user_id'],time()+30*24*3600);
 * //$_COOKIE['user_id'] = $_SESSION['user_id'];
 * //echo "$_COOKIE['user_id']";
 * $_SESSION['count'] = $user['count']+1;
 * //$_COOKIE['count'] = $_SESSION['count'];
 *
 * $result = mysql_query("UPDATE userinfo SET count = '{$_SESSION['count']}' WHERE id = '{$_SESSION['user_id']}'",$connection);
 *
 * if(!$result)
 * die("Mysql_query error ".mysql_error());
 *
 * if($_SESSION['count'] == 1)
 * redirectTo("updateprofile.php");
 * else ;
 * redirectTo("afterlogin.php");
 * }
 * else{
 * echo "<span style = 'color:red'><b>Invalid rollnum or Password. Please make sure that you you use your LDAP password???</b></span>";
 * }
 * }
 * mysql_close($connection);
 * ?>
 *
 *
 * <!DOCTYPE HTML>
 * <html>
 * <!-- To change the color of the secondary navbar make the changes at the following locations:
 * 1. Change the rgb values of the site color below (Line 32)
 * 2. Change the rgb values of the site color in 'dnb_bootstrap.css'
 * Note: A Sass implementation can make this easier. Please look into that if you can
 * -->
 * <head>
 * <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
 *
 * <!-- Latest compiled and minified CSS -->
 * <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
 *
 * <!-- Optional theme -->
 * <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
 *
 * <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
 * <!-- Latest compiled and minified JavaScript -->
 * <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
 * <link rel="stylesheet" type="text/css" href="dnb.css">
 * <style>
 * #text{
 *
 * font-family: "PT Serif", serif;;
 *
 * }
 *
 *
 * #table{
 * padding-top:10px;
 * width:420px;
 * margin:auto;
 * border:1px #FFFFFF;
 *
 * }
 * #back{
 * background-color:#f6f6f6 ;
 * z-index: -10;
 * }
 *
 * #login{
 * background-color: #FFFFFF;
 * margin:auto;
 * height:300px;
 * width:500px;
 * border-radius: 5px;
 * box-shadow: 1px 1px 15px;
 *
 * }
 *
 *
 *
 * #dnb_sec {
 * -skrollr-animation-name:animation1;
 * }
 *
 * @-skrollr-keyframes animation1 {
 * 0 {
 * margin-top:0px;
 * position:relative;
 *
 * <!--Site Color -->
 * background-color:rgba(230, 126, 34,1);
 * <!--Site Color-->
 * }
 *
 * top {
 * margin-top:0px;
 * position:fixed;
 * background-color:rgba(255, 255, 255,0.99);
 * }
 * }
 *
 * </style>
 * </head>
 *
 * <body>
 * <div id="skrollr-body">
 *
 * <div class='col-xs-12' id='dnb_primary' data-0="top:0px;" data-40="top:-140px;">
 * <nav>
 * <ul>
 * <li class='col-xs-5 col-md-3 pull-left'>
 * <span class='col-xs-12' id='dnb_logo'>
 * <p><b>Students&nbsp;</b>Portal</p>
 * </span>
 * </li>
 *
 *
 *
 * <li class='col-xs-5 col-md-6'>
 * <div class="input-group col-xs-12">
 * <span class="input-group-btn">
 * <button class="btn btn-default" type="button">Go</button>
 * </span>
 *
 * <input type="text" class="form-control" placeholder="Search">
 * </div>
 * </li>
 *
 * </ul>
 * </nav>
 * </div>
 *
 * <div id = 'dnb_sec' class='dnb_secondary col-xs-12'>
 * <nav>
 * <span class='col-xs-2'><div class='btn2 col-xs-12 pull-left' id='dnb_secondary_logo' data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)">
 * Information<b>&nbsp;Portal</b>&nbsp;</div>
 * </span>
 *
 * <span class='col-xs-2 dropdown'><div class='btn2 col-xs-12 pull-left' data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)" data-toggle="dropdown">
 * <b>Alaknanda&nbsp;Hostel&nbsp;</b><span class="caret"></span>
 * </div>
 * <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
 * <li><a href="#">Option 1</a></li>
 * <li><a href="#">Option 2</a></li>
 * <li><a href="#">Option 3</a></li>
 * <li><a href="#">Option 4</a></li>
 * <li><a href="#">Option 5</a></li>
 * <li><a href="#">Option 6</a></li>
 * </ul></span>
 *
 * <div class="hidden-sm hidden-xs col-md-2 dropdown pull-right">
 * <a class="pull-right dropdown-toggle col-xs-12" data-toggle="dropdown" href="#">
 * <span class="col-xs-12 btn2 glyphicon glyphicon-user pull-right" data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)" aria-hidden="true">
 * Username
 * <span class="caret"></span>
 * </span>
 * </a>
 * <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
 * <li><a href="#">Option 1</a></li>
 * <li><a href="#">Option 2</a></li>
 * </ul>
 * </div>
 *
 * <ul class='col-xs-6'>
 *
 * <li class='hidden-xs col-sm-3 col-md-3 col-lg-2'>
 * <div class='btn2'>
 * <a data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)" href="/html/">
 * Secretaries
 * </a>
 * </div>
 * </li>
 * <li class='hidden-xs col-sm-3 col-md-3 col-lg-2'>
 * <div class='btn2'>
 * <a data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)" href="/css/">
 * Office
 * </a>
 * </div>
 * </li>
 * <li class='hidden-xs col-sm-3 col-md-3 col-lg-2'>
 * <div class='btn2'><a data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)" href="/js/">
 * Services
 * </a>
 * </div>
 * </li>
 * <li class='hidden-xs hidden-sm hidden-md col-lg-2'>
 * <div class='btn2'>
 * <a data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)" href="/jquery/">
 * Litsoc
 * </a>
 * </div>
 * </li>
 * <li class='hidden-xs hidden-sm hidden-md col-lg-2'>
 * <div class='btn2'>
 * <a data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)" href="/jquery/">
 * TechSoc
 * </a>
 * </div>
 * </li>
 * <li class='col-xs-12 col-sm-3 col-md-3 col-lg-2'>
 * <div class="dropdown btn2">
 * <a class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true" data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)">
 * More
 * <span class="caret"></span>
 * </a>
 * <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
 * <li class='visible-xs'><a href="#">Secretaries</a></li>
 * <li class='visible-xs'><a href="#">Office</a></li>
 * <li class='visible-xs'><a href="#">Services</a></li>
 * <li><a href="#">Schroeter</a></li>
 * <li><a href="#">Alumni</a></li>
 * <li class='hidden-lg'><a href="#">Techsoc</a></li>
 * <li class='hidden-lg'><a href="#">Litsoc</a></li>
 *
 * </ul>
 * </div>
 * </li>
 * </ul>
 * </nav>
 * </div>
 * </div>
 *
 * <div class='content col-xs-10 col-xs-offset-1'>
 * <?php
 * if(isset($_GET['exp']) && $_GET['exp'] == 1){
 * echo "<span style = 'color:red'><b>You page got expired.., Please Login again!!!</b></span>";
 * }
 * if(isset($_GET['logout']) && $_GET['logout'] == 1){
 * echo "<span style='color:red'><b>You have logged out successfully </b> </span>";
 * }
 *
 * ?>
 *
 *
 *
 * <div id= "back">
 * <div id = "login">
 * <div id ="table">
 * <h3 id="text" >
 * <b> Log In </b>
 * <hr>
 * </h3>
 * <form method = "POST" action="index.php">
 * <div class="form-group">
 * <label for="exampleInputEmail1">Roll No.</label>
 * <input type="text" name = "rollno" class="form-control" id="exampleInputEmail1" placeholder="Roll No.">
 * </div>
 * <div class="form-group">
 * <label for="exampleInputPassword1">Password</label>
 * <input type="password" name = "password" class="form-control" id="exampleInputPassword1" placeholder="Password">
 * </div>
 * <input type="submit" class="btn btn-primary" name = "login" value = "Login"></input>
 * <div class="form-group">
 * </form>
 * </div>
 * </div>
 * </div>
 * <!--Insert content replacing the para and heading below-->
 * </div>
 *
 * <script type="text/javascript" src="skrollr.stylesheets.js"></script>
 * <script type="text/javascript" src="skrollr.js"></script>
 * <script type="text/javascript">skrollr.init();</script>
 * </body>
 * </html>
 */
?>