<?php
require_once 'functions.php';
session_start ();
sessionCheck();
?>
<html>
<body>
<?php
include "dnb.html";

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
		<div id="container" class='col-xs-10 col-xs-offset-1'>
		<h2>Post a New Ad</h2>
        <hr>
		<div>
			<h4>
				<b>Suggestions:</b>
			<small>
				<ul>
					<li>Try to be precise in giving description and reasons for
						selling.</li>
					<li>Please choose the appropriate tags so that we can show the most
						relavant information to the buyers
			
			</li>
			</ul>
            </small>
            </h4>
		</div>
		<hr>
            <form method="post" role="form" action="newpost.php"
			enctype="multipart/form-data">
              <div class='col-md-6 col-xs-12'>
              <div class="form-group">
                <label for="InputItemName">Item Name</label>
                <input type="text" class="form-control" name="item_name" id="InputItemName" placeholder="Enter Item Name">
              </div>
              <div class="form-group">
                <label for="InputItemCost">Item Cost</label>
                <input type="text" class="form-control" name="price" id="InputItemCost" placeholder="In Rs.">
              </div>
              <div class="form-group">
				<label for="InputCategory">Choose Category</label>
				<select class="form-control" name="category" id="sel1" multiple>
								<option>Electronics</option>
								<option>Accessories</option>
								<option>Mens Wear</option>
								<option>Women's Wear</option>
								<option>Books</option>
								<option>Vehicles</option>
								<option>None of the Above</option>
				</select>
              </div>
              <div class="form-group">
                <p class="help-block">Please upload a maximum of 3 good quality photographs of the Item</p>
                <label for="InputPic1">Upload Picture 1:</label>
                <input type="file" name="photos" id="InputPic1">
              </div>
              <div class="form-group">
                <label for="InputPic2">Upload Picture 2:</label>
                <input type="file" name="photos" id="InputPic2">
              </div>
              <div class="form-group">
                <label for="InputPic3">Upload Picture 3:</label>
                <input type="file" name="photos" id="InputPic3">
              </div>
                  </div>
                <div class='col-md-6 col-xs-12'>
				<div class="form-group">
                	<label for="editor1">Brief Description:</label>
                    <textarea class="form-control" name="description" id='editor1'></textarea>
                </div>
                <div class="form-group">
				    <label for="editor2">Reason for Selling:</label>
                    <textarea class="form-control" name="reason" id='editor2'></textarea>
                </div>
				</br>
				<button type="submit" class="btn btn-primary btn-lg"
					name="post" value="post">POST</button>
                </div>
            </form>
            
		
	</div>
</body>
</html>
