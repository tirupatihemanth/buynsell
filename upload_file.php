<?php
	$validextns = array("gif","jpeg","jpg","png");
	$temp = explode(".",$_FILES["photos"]["name"]);
	$currentextn = end($temp);
	for($i = 0;$i<4;$i++){
		if($_FILES["photos"]["type"]== "image/".$validextns[$i]){
			if($_FILES["photos"]["size"]<10000000)
				break;
			else{
				$error = 1;
				echo "<span style = color:red>make sure the size of the pic is less than 10MB</span>";
			}
		}
		else if($i == 4){
			$error = 1;
			echo "<span style = color:red>file extension must be one among 'gif', 'jpeg','jpg','png'</span>";
		}
	}
	if($error == 0){
			if(file_exists("photos_items/".$_FILES["photos"]["tmp_name"])){
			echo "<span style = color:red>You have uploaded a file with same name before<br /></span>";
			$error = 1;
		}
	}


/*	if($_FILES["photos"]["error"]>0)
		echo "Error Uploading Your file: ".$_FILES["photos"]["error"]."<br />";
	else{
//		echo "Upload: ".$_FILES['photos']["name"]."<br />";
//		echo "Type: ".$_FILES['photos']['type']."<br />";
//		echo "size: ".$_FILES['photos']['size']."<br />";
//		echo "Stored in: ". $_FILES["photos"]["tmp_name"]."<br />";

	}

*/



?> 
