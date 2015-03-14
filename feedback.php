<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location :/buynsell/index.php?exp=1");
		exit();
	}
?>

<?php
	include "db.php";
	include "dnb.html";
	if(isset($_POST['feedback'])){
		$connection = mysqli_connect($WEBHOST,$USER,$PASSWORD,$DATABASE);
		if(!$connection)
			die("Could not connect to the Database ".Mysql_error());
		$result = mysqli_query($connection,"INSERT INTO feedback(ufriendly,bugs,improvements,user_id) VALUE('{$_POST['ufriendly']}','{$_POST['bugs']}','{$_POST['improvements']}','{$_SESSION['user_id']}')");
		if(!$result){
			die("mysql query over the database error has occured ".Mysql_error());
		}
		echo "<br /><br /><div class='alert alert-success'>Thank you for your valuable feedback! We will surely look into it ASAP. Mother Promise!</span>";
	}
?>
<html>
	<body>
        <div class='container col-xs-10 col-xs-offset-1'>
		<br /><br />
		
            <div class='col-xs-10 col-xs-offset-1'>
                <div class='jumbotron'><h4>Hi,</h4><h3><small> We at WebOps are really enthusiastic to listen to your suggestions to make this site better. And we would be really happy if you could take some time off to give us your feedback below</small><br></h3></div>
			<form method = POST action = feedback.php>

				<p>1. Do you find this page user friendly?</p>
				<input type = "radio" name = "ufriendly" value = "yes"> Yes</input>
				<input type = "radio" name = "ufriendly" value = "no"> No</input><br>
				<p>2. If you find any bugs or any problems with the functionality of the site please send the details below:</p>
				<textarea class = "form-control" id = "editor1" name = "bugs"></textarea><br>
	    		<p>3. If you can think of some improvements to the site put them below:</p>
	    		<textarea class = "form-control" id = "editor2" name = "improvements"></textarea>
	    		<br />
	    		<button class='btn btn-default' type = submit name = "feedback" value = "Submit" >Send</button>
			</form>
            <br>
            <div class='alert alert-warning'>
			For any other queries please drop a mail to instituteWebops@gmail.com
        </div>
    </div>
<br><br>
    
</div>
	</body>
</html>
