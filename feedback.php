<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location :/buynsell/index.php?exp=1");
		exit();
	}
?>

<?php
	include "db.php";
	include "header.php";
	if(isset($_POST['feedback'])){
		$connection = mysqli_connect($WEBHOST,$USER,$PASSWORD,$DATABASE);
		if(!$connection)
			die("Could not connect to the Database ".Mysql_error());
		$result = mysqli_query($connection,"INSERT INTO feedback(ufriendly,bugs,improvements,user_id) VALUE('{$_POST['ufriendly']}','{$_POST['bugs']}','{$_POST['improvements']}','{$_SESSION['user_id']}')");
		if(!$result){
			die("mysql query over the database error has occured ".Mysql_error());
		}
		echo "<br /><br /><br /><br /><span style = 'color:green'>Thank You For Your Valuable feedback We will surely look into it :)</span>";
	}
?>
<html>
	<script src = "./ckeditor/ckeditor.js"></script>
	<body>
		<br /><br /><br /><br />
		<p>We at WebOps are really enthusiastic to listen to your suggestions to make this site help you more. Kindly put it in your valuable feedback here.</p>

			<form method = POST action = feedback.php>

				<p>Do You think this the page is user friendly?</p>
				<input type = "radio" name = "ufriendly" value = "yes">YES</input>
				<input type = "radio" name = "ufriendly" value = "no">NO</input>
				<p>If you find any bugs or any problems with the functionality of the site put them below:</p>	
				<textarea class = "ckeditor" id = "editor1" name = "bugs"></textarea>
	    		<script> CKEDITOR.replace('editor1');</script>
	    		<p>If you can think of some improvements to the site put them below:</p>
	    		<textarea class = "ckeditor" id = "editor2" name = "improvements"></textarea>
	    		<script> CKEDITOR.replace('editor2');</script>
	    		<br />
	    		<input type = submit name = "feedback" value = "Submit" ></submit>
			</form>
			for any other queries please drop a mail to IstituteWebops@gmail.com
	</body>
</html>