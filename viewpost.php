

<?php
	require_once 'functions.php';
	session_start();
	sessionCheck();
	
	$connectionObject = getConnection();

	include "dnb.html";
	if(isset($_GET['item_id'])){

		
		$resultObject = queryDB($connectionObject, "SELECT items.*, userinfo.fullname, userinfo.id FROM items,userinfo WHERE items.user_id = userinfo.id AND items.item_id = '{$_GET['item_id']}'");
		$tagIdObject = queryDB($connectionObject, "SELECT tags.* FROM item_tags,tags where item_id = '{$_GET['item_id']}' AND tags.tag_id = item_tags.tag_id");
		$product = $resultObject->fetch_array(MYSQL_BOTH);
		
		
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
            $src = "photos_items/".$product['id'].$product['item_id']."0";
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
                $src = "photos_items/".$product['id'].$product['item_id'].$i;
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
        <div class="col-xs-8"><h4>Contact Seller:<br></h4><?php echo "<a href =viewprofile.php?user_id=".$product['user_id'].">".$product['fullname']."</a>"; ?></div>
        <div class="col-xs-12">
        <hr><h4>Reason for Selling<br><small><?php echo $product['reason']; ?></small></h4><hr>

        <?php		
		$array['item_id'] = $_GET['item_id'];
		include "comments.php";
        ?>
        </div>
    </div>
</div>