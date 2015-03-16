<?php

	$validextns = array("gif","jpeg","jpg","png");
	//print_r($_FILES['photos']['name']);
	
	
	for($j = 0;$j<3;$j++){
		for($i=0;$i<sizeof($_FILES['photos']['name']);$i++){
			
			if($_FILES["photos"]["type"][$j]== "image/".$validextns[$i]){
				if($_FILES["photos"]["size"][$j]<10000000)
					break;
				else{
					$errorFile = 1;
					echo "<span style = color:red>make sure the size of the pic is less than 10MB</span>";
					break;
				}
				break;
			}
			else if($i == 3){
				$errorFile = 1;
				echo "<span style = color:red>The photo numbered ".$j."you have uploaded must of the file type 'gif', 'jpeg','jpg','png'</span>";
			}
				
		}
			
	}
	
?> 
