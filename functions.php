<?php
	
	// All the functions necessary for the project
	require_once 'db.php';
	
	function sessionCheck(){
		if(!isset($_SESSION['user_rollno'])){
			redirectTo("index.php");
		}	
	}
	
	function redirectTo($address) {
		header ( "Location: $address" );
		exit ();
	}
	
	function getConnection() {
		global $WEBHOST;
		global $USER;
		global $PASSWORD;
		global $DATABASE;
		
		$connectionObject = new mysqli ( $WEBHOST, $USER, $PASSWORD, $DATABASE );
		
		if ($connectionObject->connect_errno) {
			die ( "Mysql connection to database failed: " . $connectionObject->connect_error );
		}
		
		return $connectionObject;
	}
	
	
	function queryDB(mysqli $connectionObject, $query) {
		$resultObject = $connectionObject->query ( $query );
		if (! $resultObject) {
			die ( "Mysql query failed: " . $connectionObject->error );
		}
		return $resultObject;
	}
	
?>

