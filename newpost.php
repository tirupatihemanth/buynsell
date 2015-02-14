<?php
require_once 'functions.php';
session_start ();
sessionCheck();
?>
<html>
<head>
<title>BUYNSELL@IITM</title>
<script src="./ckeditor/ckeditor.js"></script>
<script src="bootstrap/jquery-1.11.1"></script>
<script src="bootstrap/jquery-2.1.1"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<style>
#container {
	width: 1220px;
	margin: 10px auto 0px;
	background-color: rgba(255, 255, 204, .1);
	border-radius: 20px;
	border: 2px solid black;
	padding-left: 15px;
	padding-right: 15px;
	box-shadow: 10px 10px 20px;
	margin-bottom: 20px;
}

select, input.fat {
	font-size: 20px;
	box-shadow: 2px 2px 10px;
	padding: 7px 5px;
	margin: 10px 0;
	width: 100%;
	display: block;
	border-radius: 5px;
	border: none;
}

#button {
	font-size: 20px;
	box-shadow: 2px 2px 10px;
	padding: 7px 5px;
	margin: 10px;
	width: 150px;
	display: block;
	border-radius: 5px;
	border: none;
}

table {
	width: 50%;
	margin: 20px;
}

tr {
	height: 25px;
}
</style>
</head>

<body>
<?php
include "header.php";

$connectionObject = getConnection();
if (isset ( $_POST ['post'] )) {
	echo $_POST['category'];
	$error = 0;
	include "upload_file.php";
	if ($error == 0) {
		
		queryDB($connectionObject, "INSERT INTO items(item_name,price,description,reason,user_id) VALUE('{$_POST['item_name']}', '{$_POST['price']}', '{$_POST['description']}', '{$_POST['reason']}','{$_SESSION['user_id']}')");
		
		//$result = mysql_query ( "SELECT item_id FROM items WHERE user_id = '{$_SESSION['user_id']}' ORDER BY timestamp DESC " );
		$resultObject = queryDB($connectionObject,"SELECT item_id FROM items WHERE user_id = '{$_SESSION['user_id']}' ORDER BY timestamp DESC "  );
		
		$result = $resultObject->fetch_array();
		//$result = mysql_fetch_array ( $result );
		// print_r($result);
		$item_id = $result ['item_id'];
		// echo $item_id;
		$name = $_FILES ["photos"] ["name"];
		$ext = end ( (explode ( ".", $name )) );
		// $_FILES["photos"]["tmp_name"] = "".$_FILES["photos"]["tmp_name"].$_SESSION['user_id'].$item_id;
		// echo "$_FILES['photos']['tmp_name']";
		move_uploaded_file ( $_FILES ["photos"] ["tmp_name"], "photos_items/" . $_SESSION ['user_id'] . $item_id . "." . $ext );
		
		if (isset ( $_POST ['category'] )) {
			
			queryDB($connectionObject, $query);
			for($i = 0; $i < 7; $i ++) {
				if (isset ( $_POST ['category'] [$i] )) {
					// echo $_POST['category'][$i];
					
					$result = mysql_query ( "SELECT tag_id FROM tags WHERE tag_name = '{$_POST['category']}'" );
					
					if (! $result)
						die ( "mysql_query error has occured" . mysql_error () );
					
					if (mysql_num_rows ( $result ) == 1) {
						$result = mysql_fetch_array ( $result );
						$tag_id = $result ['tag_id'];
					} else
						die ( "mysql_query error has occured" . mysql_error () );
					
					$result = mysql_query ( "INSERT INTO item_tags(item_id,tag_id) value('{$item_id}', '{$tag_id}')", $connection );
					if (! $result)
						die ( "mysql_query error has occured" . mysql_error () );
				}
			}
		}
	}
	
	if ($error == 0)
		echo "<span style= 'color:green'><b><br /><br /><br /><br />Your posts has been successfully posted. Check My posts or All posts to have a look at it</b></span>";
	$connectionObject->close();
}

?>
		<div id="container">
		<h1 style="margin-left: 40%;">
			<b><u>NEW POST</u></b>
		</h1>

		<div>
			<h3>
				<b>Suggestions:</b>
			</h3>
			<h3>
				<ul>
					<li>Try to be precise in giving description and reasons for
						selling.</li>
					<li>Please choose the appropriate tags so that we can show the most
						relavant information to the buyers
			
			</h3>
			</li>
			</ul>
			</h3>
		</div>
		<hr>
		<form method="post" role="form" action="newpost.php"
			enctype="multipart/form-data">
			<table>
				<tr>
					<td><label><h3>
								<b>Name Of Object:
							
							</h3>
							</b></label></td>
					<td><input class="fat " name="item_name" id="ex1" type="text"
						placeholder=" Ad Title"></td>
				</tr>

				<tr>
					<td><label for="ex2"><h3>
								<b>Selling Price(in Rs):<b>
							
							</h3></label></td>
					<td><input class="fat " type="text" name="price" class="input-lg  "
						id="ex2" placeholder="  Ruppees"></td>
				</tr>

				<div class="form-group">
					<tr>
						<td><label for="sel1"><h3>
									<b>Choose Category:</b>
								</h3></label></td>
						<td><select class="fat " name = "category" id="sel1">
								<option>- - - - - - - - - - - - - - - - -</option>
								<option>Electronics</option>
								<option>Accessories</option>
								<option>Mens Wear</option>
								<option>Women's Wear</option>
								<option>Books</option>
								<option>Vehicles</option>
								<option>More</option>
						</select></td>
					</tr>
				</div>
			</table>
			<div style="margin: 10px;">
				<h3>Upload genuine photos of your product</h3>

				<input id="button" style="width: 50%;" class=" btn btn-primary "
					type="file" placeholder="Browse" name="photos"></input> <input
					id="button" style="width: 50%;" class=" btn btn-primary "
					type="file" placeholder="Browse" name="photos"></input> <input
					id="button" style="width: 50%;" class=" btn btn-primary "
					type="file" placeholder="Browse" name="photos"></input>

				<h3>Brief Description:</h3>

				<textarea
					style="border-radius: 15px; box-shadow: 3px 3px 10px; width: 95%; height: 250px;"
					name="description"></textarea>
				<!-- i wanna remove the(class = "ckeditor" id = "editor1") part-->
				<script> CKEDITOR.replace('editor1');</script>

				<h3>Specific reason for selling your product:</h3>

				<textarea
					style="border-radius: 15px; box-shadow: 3px 3px 10px; width: 95%; height: 250px;"
					name="reason"></textarea>
				<!-- i wanna remove the(class = "ckeditor" id = "editor2") part-->
				<script> CKEDITOR.replace('editor2');</script>

				</br>
				<button id="button" type="submit" class="btn btn-primary btn-lg"
					name="post" value="post">POST</button>
			</div>
		</form>
	</div>
</body>
</html>
