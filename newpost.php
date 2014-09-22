<?php
  include "db.php";
  session_start();
  if(!isset($_SESSION['user_id'])){
    header("Location: /buynsell/index.php?exp=1");
    exit();
  }
?>


<?php
	
	$error = 0;
    $connection = mysql_connect($WEBHOST, $USER, $PASSWORD);
    mysql_select_db($DATABASE,$connection);
    
    if (isset($_POST['post'])){
    
    include "upload_file.php";
    if($error == 0){
	    $result = mysql_query("INSERT INTO items(item_name,price,description,reason,user_id) VALUE('{$_POST['item_name']}', '{$_POST['price']}', '{$_POST['description']}', '{$_POST['reason']}','{$_SESSION['user_id']}')", $connection);

	    if(!$result)
	        die("mysql_query error has occured".mysql_error());

	    $result = mysql_query("SELECT item_id,user_id FROM items WHERE user_id = '{$_SESSION['user_id']}' ORDER BY timestamp DESC ");
	    
	    if(!$result)
	        die("mysql_query error has occured".mysql_error());
	    //echo mysql_num_rows($result);
	    $result = mysql_fetch_array($result);
	    //print_r($result);
	    $item_id = $result['item_id'];
	    //echo $item_id;
	    
	    //$_FILES["photos"]["tmp_name"] = "".$_FILES["photos"]["tmp_name"].$_SESSION['user_id'].$item_id;
	    //echo "$_FILES['photos']['tmp_name']";
		move_uploaded_file($_FILES["photos"]["tmp_name"],"photos_items/".$_SESSION['user_id'].$item_id.$_FILES["photos"]["name"]);

	    if(isset($_POST['category'])){
	      
	      for($i=0;$i<8;$i++){
		if(isset($_POST['category'][$i])){
		//echo $_POST['category'][$i];
		$result = mysql_query("SELECT * FROM tags WHERE tag_name = '{$_POST['category'][$i]}'");
		
		if(!$result)
		  die("mysql_query error has occured".mysql_error());
		  
		if(mysql_num_rows($result)==1){
		  $result = mysql_fetch_array($result);
		  $tag_id = $result['tag_id'];
		}
		else
		  die("mysql_query error has occured".mysql_error());
		
		$result = mysql_query("INSERT INTO item_tags(item_id,tag_id) value('{$item_id}', '{$tag_id}')", $connection);
		if(!$result)
		  die("mysql_query error has occured".mysql_error());
	      
		}
	      }
	    
	    }
	}
    if($error == 0)
    echo "<span style= 'color:green'><b>Your posts has been successfully posted. Check your posts or All posts to have a look at it</b></span>";
    mysql_close($connection);
  }

?>

<html>
  <head>
    <title>BUYNSELL@IITM</title>
    <script src = "./ckeditor/ckeditor.js"></script>
  </head>
  <body>
    <?php
      include "header.php";
    ?>
    <h1>
      New Post
    </h1>
    <p>
      <h3>
	Very Few Suggestions:
      <h3>
      <p>
	Try to be precise in giving description and reasons for selling. Please choose the appropriate tags so that we can show the most relavant information to the buyers
      </p>
      <form method="post" action = "newpost.php" enctype = "multipart/form-data">
	    <p>
		Enter the name of the object you would like to sell precisely below:
	    </p>
	    <p>
		Name:<input type ="text" name = "item_name"></input>
	    </p>
	    <p>
		Selling Price(in Rs):<input type = "number" name="price"></input>
	    </p>
	    <p>
	      Please choose related tags from below:
	    </p>
	    <p>
	      <input type = "checkbox" name = "category[]" value = "mobiles">Mobiles</input>
	      <input type = "checkbox" name = "category[]" value = "tablets">Tablets</input>
	      <input type = "checkbox" name = "category[]" value = "laptops">Laptops</input>
	      <input type = "checkbox" name = "category[]" value = "electronic devices">Electronic Devices</input>
	      <input type = "checkbox" name = "category[]" value = "cycles">Cycles</input>
	      <input type = "checkbox" name = "category[]" value = "academics">Academics Related</input>
	      <input type = "checkbox" name = "category[]" value = "eatables">Eatables</input>
	      <input type = "checkbox" name = "category[]" value = "others">others</input>
	    </p>
	    <p>Upload genuine photos of your product</p>
	    <input type = "file" name = "photos"></input>
	    <p>
		Brief Description:
	    </p>
	    <textarea class = "ckeditor" id = "editor1" name = "description"></textarea>
	    <script> CKEDITOR.replace('editor1');</script>
	    <p>
	      Specific reason for selling your product:
	    </p>
	    <textarea class = "ckeditor" id = "editor2" name = "reason"></textarea>
	    <script> CKEDITOR.replace('editor2');</script>
	    <br />
	    <input type = "submit" name = "post" value = "post"></input>
	</form>
    </p>
  </body>
</html> 
