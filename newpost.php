<?php
require_once 'functions.php';
session_start ();
sessionCheck ();
?>
<html>
<body>
<?php
include "dnb.html";

$connectionObject = getConnection ();
if (isset ( $_POST ['post'] )) {
	// print_r($_POST['category']);
	$errorFile = 0;
	$errorName = 0;
	$errorPrice = 0;
	$errorReason = 0;
	$errorDescription = 0;
	
	include "upload_file.php";
	if(strlen($_POST['item_name']) == 0 || strlen($_POST['item_name'])>50){
		$errorName = 1;
	}
	if($_POST['price'] <=0 || $_POST['price']>1000000){
		$errorPrice = 1;
	}
	if(strlen($_POST['description']) == 0 || strlen($_POST['description'] > 1000)){
		$errorDescription = 1;
	}
	if(strlen($_POST['reason']) == 0 || strlen($_POST['description']) > 1000){
		$errorReason = 1;
	}
	
	if ($errorFile || $errorName || $errorPrice || $errorDescription || $errorReason == 0){
		
		queryDB ( $connectionObject, "INSERT INTO items(item_name,price,description,reason,user_id) VALUE('{$_POST['item_name']}', '{$_POST['price']}', '{$_POST['description']}', '{$_POST['reason']}','{$_SESSION['user_id']}')" );
		
		$resultObject = queryDB ( $connectionObject, "SELECT item_id FROM items WHERE user_id = '{$_SESSION['user_id']}' ORDER BY timestamp DESC " );
		
		$result = $resultObject->fetch_array ();
		$item_id = $result ['item_id'];
		
		for($i=0;$i<sizeof($_FILES["photos"]["name"]);$i++){
			$ext = end((explode("/", $_FILES["photos"]["type"][$i])));
			move_uploaded_file($_FILES["photos"]["tmp_name"][$i],"photos_items/".$item_id.$i.".".$ext);
		
		}
		//print_r($_POST['category']);
		echo "<br />";
		if (isset ( $_POST ['category'] )) {
			$tags = Array();
			$resultObject = queryDB($connectionObject, "SELECT * FROM tags");
			
			for($i=0;$i<$resultObject->num_rows;$i++){
				$result = $resultObject->fetch_array();
				$tags[$result[1]] = $result[0];
			}
			$query = "";
			
			//Using multi query to decrease the number of data base access
			
			for($i = 0; $i < 12; $i ++) {
				if (isset ( $_POST ['category'] [$i] )) {
					$query.= "INSERT INTO item_tags(item_id,tag_id) value('{$item_id}', '{$tags[$_POST['category'][$i]]}');";
				}
			}
				
			if(!$connectionObject->multi_query($query)){
				die ( "Mysql query failed: " . $connectionObject->error );
			}
			
		}
		
		echo "<div class='alert alert-success'><b><br /><br /><br /><br />Your posts has been successfully posted. Check My posts or All posts to have a look at it</b></div>";
	}
	
	else{
		
		if($errorFile == 1){
			echo "Error File Upload<br />";
		}
		
		if($errorName == 1){
			echo "Please fill in a valid Item Name(<50 Characters)<br />";
		}
		
		if($errorReason == 1){
			echo "Reason field cannot be empty<br />";
		}
		
		if($errorPrice == 1){
			echo "Please enter valid price of the object<br />";
		}
		
		if($errorDescription == 1){
			echo "Please enter valid Description <br />";
		}
			
	}
	$connectionObject->close ();
}

?>
		<div class='container col-xs-10 col-xs-offset-1'>
		<h2>Post a New Ad</h2>
        <hr>
		<div>
			<h4>
				<h5><b>Suggestions:</b></h5>
			<small>
				<ul>
					<li>Try to be precise in giving description and reasons for
						selling.</li>
					<li>Please choose the appropriate tags so that we can show the most
						relavant information to the buyers (Use ctrl+click for multiple tags)
			
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
				<select class="form-control" name="category[]" id="sel1" multiple>
								<option value="academics"> Academics </option>
								<option value="fccoupons">Coupons</option>
								<option value="electronics">Electronics</option>
								<option value="laptops">Laptops</option>
								<option value="mobiles">Mobiles</option>
								<option value="accessories">Stationery</option>
								<option value="others">Clothing</option>
								<option value="academics">Books</option>
								<option value="cycles">Cycles</option>
								<option value="others">Other Catgories</option>
				</select>
              </div>
              <div class="form-group">
                <p class="help-block">Please upload a maximum of 3 good quality photographs of the Item</p>
                <label for="InputPic1">Upload Picture 1:</label>
                <input type="file" name="photos[]" id="InputPic1">
              </div>
              <div class="form-group">
                <label for="InputPic2">Upload Picture 2:</label>
                <input type="file" name="photos[]" id="InputPic2">
              </div>
              <div class="form-group">
                <label for="InputPic3">Upload Picture 3:</label>
                <input type="file" name="photos[]" id="InputPic3">
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
