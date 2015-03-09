<?php
if (isset ( $_POST ['pubsubmit'] )) {
	queryDB ( $connectionObject, "INSERT INTO comments(user_com_id,item_id,visibility,message) value('{$_SESSION['user_id']}','{$array['item_id']}',1,'{$_POST['pubcomment']}')" );
}

if (isset ( $_POST ['privsubmit'] )) {
	queryDB ( $connectionObject, "INSERT INTO comments(user_com_id,item_id,visibility,message) value('{$_SESSION['user_id']}','{$array['item_id']}',0,'{$_POST['privcomment']}')" );
	echo "<span style = 'background-color:green; color:white;'>message sent succesfully!!!</span><br />";
}

$comments = queryDB ( $connectionObject, "SELECT comments.message,comments.user_com_id,comments.timestamp,userinfo.rollno FROM comments,userinfo WHERE item_id = '{$array['item_id']}' AND comments.user_com_id = userinfo.id AND visibility = 1 ORDER BY timestamp ASC" );
$rows = $comments->num_rows;
?>
<h4>Public Comments <span class="badge"><?php echo $rows; ?></span></h4>
<div>
<?php
for($com = 0; $com < $rows; $com ++) {
	$comarray = $comments->fetch_array ();
	echo "<div class='well well-sm comments'><a href='viewprofile.php?user_id=" . $comarray ['user_com_id'] . "'>" . $comarray ['rollno'] . "</a>  " . $comarray ['message'] . "<br><h5><small>at ".$comarray ['timestamp']."</small></h5></div>";
}
?>
</div>
<?php

if (isset ( $_GET ['allposts'] ) && $_GET ['allposts'] == 1) {
	
	echo "<form method = 'post' action = 'viewpost.php?allposts=1&item_id=" . $array ['item_id'] . "'><textarea class='form-control' rows='1' name = 'pubcomment'></textarea><button class='btn btn-default' type='submit' name = 'pubsubmit' value = 'comment'>Submit</button></form>";
    echo '<hr><h4>Send a Private Message</h4>';
	echo "<form method = 'post' action = 'viewpost.php?allposts=1&item_id=" . $array ['item_id'] . "'><textarea class='form-control' rows='1' name = 'privcomment'></textarea><button class='btn btn-default' id = 'pubsubmit' type='submit' name = 'privsubmit' value = 'privcomment'>Send</button></form>";
}

if (isset ( $_GET ['myposts'] ) && $_GET ['myposts'] == 1) {
	echo "<form method = 'post' action = 'viewpost.php?myposts=1&item_id=" . $array ['item_id'] . "'><textarea class='form-control' rows='1' name = 'pubcomment'></textarea><button class='btn btn-default' type='submit' name = 'pubsubmit' value = 'comment'>Submit</button</form>";
}
//onClick='updateComments(".$array['item_id'].")'

?> 
