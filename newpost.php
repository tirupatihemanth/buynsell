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
	$error = 0;
	include "upload_file.php";
	if ($error == 0) {
		
		queryDB ( $connectionObject, "INSERT INTO items(item_name,price,description,reason,user_id) VALUE('{$_POST['item_name']}', '{$_POST['price']}', '{$_POST['description']}', '{$_POST['reason']}','{$_SESSION['user_id']}')" );
		
		$resultObject = queryDB ( $connectionObject, "SELECT item_id FROM items WHERE user_id = '{$_SESSION['user_id']}' ORDER BY timestamp DESC " );
		
		$result = $resultObject->fetch_array ();
		$item_id = $result ['item_id'];
		
		for($i=0;$i<sizeof($_FILES["photos"]["name"]);$i++){
			$ext = end((explode("/", $_FILES["photos"]["type"][$i])));
			move_uploaded_file($_FILES["photos"]["tmp_name"][$i],"photos_items/".$_SESSION['user_id'].$item_id.$i.".".$ext);
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
	}
	
	if ($error == 0){
		echo "<span style= 'color:green'><b><br /><br /><br /><br />Your posts has been successfully posted. Check My posts or All posts to have a look at it</b></span>";
	}
	$connectionObject->close ();
}

?>
		<div id="container">
		<h1>
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
							
							</h3> </b></label></td>
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
						<td><input type="checkbox" name="category[]" value="academics">
							Academics <br />
							 <input type="checkbox" name="category[]"
							value="books"> Books <br /> 
							<input type="checkbox"
							name="category[]" value="accessories"> Mobile Accessories <br />
							
							<input type="checkbox" name="category[]" value="mobiles"> Phones and Tablets
							<br />
							 <input type="checkbox" name="category[]" value="laptops">
							Laptops <br /> <input type="checkbox" name="category[]"
							value="electronics"> Electronics <br /> 
							<input type="checkbox"
							name="category[]" value="cosmetics"> Cosmetics <br />
							 <input
							type="checkbox" name="category[]" value="eatables"> Eatables <br />
							
							<input type="checkbox" name="category[]" value="fccoupons"> Food
							Court Coupons <br /> 
							<input type="checkbox" name="category[]"
							vlaue="clothing"> Clothing <br /> 
							<input type="checkbox"
							name="category[]" value="cycles"> Cycles <br /> 
							<input
							type="checkbox" name="category[]" value="others"> Others <br />
							</td>
					</tr>
				</div>
			</table>
			<div style="margin: 10px;">
				<h3>Upload genuine photos of your product</h3>

				<input id="button" style="width: 50%;" class=" btn btn-primary "
					type="file" placeholder="Browse" name="photos[]"></input> 
					
					<input
					id="button" style="width: 50%;" class=" btn btn-primary "
					type="file" placeholder="Browse" name="photos[]"></input> 
					
					<input
					id="button" style="width: 50%;" class=" btn btn-primary "
					type="file" placeholder="Browse" name="photos[]"></input>

				<h3>Brief Description:</h3>

				<textarea name="description"></textarea>
				<!-- i wanna remove the(class = "ckeditor" id = "editor1") part-->
				<script> CKEDITOR.replace('editor1');</script>

				<h3>Specific reason for selling your product:</h3>

				<textarea name="reason"></textarea>
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
