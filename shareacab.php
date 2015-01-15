<?php
  include "db.php";
  session_start();
  if(!isset($_SESSION['user_id'])){
    header("Location: /buynsell/index.php?exp=1");
    exit();
  }
?>
<?php
if(isset($_POST["shareacab"])){
	
}

?>
<html>
	<title>
		BUYNSELL@IITM
	</title>
	<head>
		SHARE A CAB
	</head>
	<body>
		<p>Provide the exact departure time of the cab and the place</p>
		<form action = "shareacab.php" method="POST">
			<p>
				Cab Service Provider:<input type="text" name="serviceprovider"></input>
			</p>
			<p>
				Departure Point: <input type="text" name="departure point"></input>
			</p>
			<p>
				Journey Date: <input type="date" name="journey date"></input>
			</p>
			<p>
				departure Time: <input type="time" name="departure time"></input>
			</p>
			<p>
				Other details & concerns:<br /> <textarea name="cabdetails"></textarea>
			</p>
			<input type="submit" name="shareacab" value="shareacab"></input>
		</form>
	</body>
</html>