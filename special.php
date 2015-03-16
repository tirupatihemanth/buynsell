<?php
	require_once 'functions.php';
	session_start();
	sessionCheck();
	
	$connectionObject = getConnection();

	include "dnb.html";
    if(isset($_POST['order'])){
        $resultObject = queryDB ( $connectionObject, "SELECT * from userinfo WHERE rollno = '{$_SESSION['user_rollno']}'" );
	    $result = $resultObject->fetch_array ( MYSQLI_BOTH );
        
        if (strlen ( $result ['fullname'] ) == 0 || strlen ($result ['hostel'])  == 0) {echo "<div class='alert alert-danger'>Please update your profile with your full name, hostel and room number to avail this offer</div>";} else{
        if($_POST['number']<3){
        $insert = "INSERT INTO special VALUES ('".$result['fullname']."','".$result['rollno']."','".$result['hostel']."','".$_POST['size']."','".$_POST['number']."','".$result['roomno']."')";
        $in = queryDB ( $connectionObject, $insert);
        echo "<div class='alert alert-success'>Thank you. Your order has been completed.</div>";
        }else{echo "<div class='alert alert-danger'>You can only order a maximum of two t-shirts</div>";}
        }
    }
	if(isset($_GET['item_id'])){
		
		$resultObject = queryDB($connectionObject, "SELECT items.*, userinfo.fullname FROM items,userinfo WHERE items.user_id = userinfo.id AND items.item_id = '{$_GET['item_id']}'");
		$tagIdObject = queryDB($connectionObject, "SELECT tags.* FROM item_tags,tags where item_id = '{$_GET['item_id']}' AND tags.tag_id = item_tags.tag_id");
		$product = $resultObject->fetch_array(MYSQL_BOTH);
		

		/*echo "<h3>Images</h3>";
		for($i=0;$i<2;$i++){
			$src = "photos_items/".$product['item_id'].$i;
			if(file_exists($src.".jpeg")){
				echo "<img src=".$src.".jpeg style='width:256px;height:256px' /><br />";
			}
			else if(file_exists($src.".gif")){
				echo "<img src=".$src.".gif style='width:256px;height:256px'/><br />";
			}
			else if(file_exists($src.".png")){
				echo "<img src=".$src.".png style='width:256px;height:256px'/><br />";
			}
		}
		
		echo "Name: <br />".$product['item_name']."<br /><br />";
		echo "Price: <br />".$product['price']."<br /><br />";
		echo "Description: <br />".$product['description']."<br /><br />";
		echo "Reason for selling: <br />".$product['reason']."<br /><br />";
		
		echo "<h3>Tags</h3>";
		
		$tagNames = Array();
		$resultObject = queryDB($connectionObject, "SELECT * FROM tags");
			
		for($i=0;$i<$resultObject->num_rows;$i++){
			$result = $resultObject->fetch_array(); 
			$tagNames[$result[0]] = $result[1];
		}
		echo "<ul>";
		for($i=0;$i<$tagIdObject->num_rows;$i++){
			$tagId = $tagIdObject->fetch_array();
			echo "<li>".$tagNames[$tagId[0]]."</li>";
		}
		echo "</ul>";
		echo "<br /><br />";
		
		echo "<p style = 'color:red'>Caution: The info in this page is as provided by the seller and buynsell or Insti Webops have no responsibility over the quality of the products</p>";
		$array['item_id'] = $_GET['item_id'];
		include "comments.php";

		*/
	}
	else{
		echo "Nothing to see here, Move Along :)";
    }
?>

<div class="col-xs-10 col-xs-offset-1 container">
    <h3><?php echo $product['item_name'];?><hr></h3>

    <div class="col-md-4 col-xs-12">
        <?php
            echo "<h4>Images</h4>";
            $src = "photos_items/special";
            if(file_exists($src.".jpeg")){
                    echo "<a href='".$src.".jpeg'><img src=".$src.".jpeg class='col-xs-8'/></a>";
                }
                else if(file_exists($src.".gif")){
                    echo "<a href='".$src.".gif'><img src=".$src.".gif class='col-xs-8'/></a>";
                }
                else if(file_exists($src.".png")){
                    echo "<a href='".$src.".png'><img src=".$src.".png class='col-xs-8'/></a>";
            }
        ?>
        <div class='col-xs-4'>
            <?php
                for($i=0;$i<3;$i++){
                $src = "photos_items/special".$i;
                if(file_exists($src.".jpeg")){
                    echo "<a href='".$src.".jpeg'><img src=".$src.".jpeg class='col-xs-12'/></a>";
                }
                else if(file_exists($src.".gif")){
                    echo "<a href='".$src.".gif'><img src=".$src.".gif class='col-xs-12'/></a>";
                }
                else if(file_exists($src.".png")){
                    echo "<a href='".$src.".png'><img src=".$src.".png class='col-xs-12'/></a>";
                }
            }
            
        ?>
            </div>
        <div class='col-xs-12'>
        <hr><h4>Description<br><small><?php echo $product['description']; ?></small></h4><hr>
            <?php
            echo "<h4>Tags</h4>";
		
            $tagNames = Array();
		$resultObject = queryDB($connectionObject, "SELECT * FROM tags");
			
		for($i=0;$i<$resultObject->num_rows;$i++){
			$result = $resultObject->fetch_array(); 
			$tagNames[$result[0]] = $result[1];
		}
		echo "<ul>";
		for($i=0;$i<$tagIdObject->num_rows;$i++){
			$tagId = $tagIdObject->fetch_array();
			echo "<li>".$tagNames[$tagId[0]]."</li>";
            
            }
            echo "</ul>";
?>
        </div>
            <?php
            echo "<br /><br />";

            echo "<div class='alert alert-danger col-xs-12'>Caution: The info in this page is as provided by the seller and buynsell or Insti Webops have no responsibility over the quality of the products</div>";
        ?>
    </div>
    <div class="col-xs-12 col-md-8">
        <div class="col-xs-4"><h3>Rs. <?php echo $product['price'];?> </h3></div>
        <div class="col-xs-8"><h4>Contact Seller:<br></h4>Admin</div>
        <div class="col-xs-12">
        <hr><h4>Reason for Selling<br><small><?php echo $product['reason']; ?></small></h4><hr>

        <?php		
		$array['item_id'] = $_GET['item_id'];
		//include "comments.php";
        ?>
        <div class='alert alert-warning'>Please note that you can order only once. Any multiple order will not be recorded.</div>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]."?item_id=00";?>">
          
            <div class="radio">
              <label>
                <input type="radio" name="size" id="optionsRadios1" value="S" checked>
                S
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="size" id="optionsRadios2" value="M">
                M
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="size" id="optionsRadios3" value="L" checked>
                L
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="size" id="optionsRadios4" value="XL">
                XL
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="size" id="optionsRadios5" value="XXL">
                XXL
              </label>
            </div>
          <div class="form-group">
            <label for="number">Number of T Shirts</label>
            <input type="number" class="form-control" name='number' id="number" placeholder="Number (Maximum of 2)">
          </div>
          <button type="submit" name="order" values="order" class="btn btn-default">Complete Order</button>
        </form>
        </div>
    </div>
</div>