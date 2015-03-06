<?php
if (isset ( $_POST ['pubsubmit'] )) {
	queryDB ( $connectionObject, "INSERT INTO comments(user_com_id,item_id,visibility,message) value('{$_SESSION['user_id']}','{$array['item_id']}',1,'{$_POST['pubcomment']}')" );
}

if (isset ( $_POST ['privsubmit'] )) {
	queryDB ( $connectionObject, "INSERT INTO comments(user_com_id,item_id,visibility,message) value('{$_SESSION['user_id']}','{$array['item_id']}',0,'{$_POST['privcomment']}')" );
	echo "<span style = 'background-color:green; color:white;'>message sent succesfully!!!</span><br />";
}

echo "<span style = 'color:green'>Public Comments(visible to all)</span><br />";
$comments = queryDB ( $connectionObject, "SELECT comments.message,comments.user_com_id,userinfo.rollno FROM comments,userinfo WHERE item_id = '{$array['item_id']}' AND comments.user_com_id = userinfo.id AND visibility = 1 ORDER BY timestamp ASC" );
$rows = $comments->num_rows;

echo "<div id='comments'>";

for($com = 0; $com < $rows; $com ++) {
	$comarray = $comments->fetch_array ();
	echo "<span style = 'background-color: yellow'>" . ($com + 1) . ". <a href='viewprofile.php?user_id=" . $comarray ['user_com_id'] . "'>" . $comarray ['rollno'] . "</a> :  " . $comarray ['message'] . "</span><br />";
}

echo "</div>";

if (isset ( $_GET ['allposts'] ) && $_GET ['allposts'] == 1) {
	
	echo "<form method = 'post' action = 'viewpost.php?allposts=1&item_id=" . $array ['item_id'] . "'><textarea name = 'pubcomment'></textarea><input type='submit'name = 'pubsubmit' value = 'comment'></form>";
	echo "<span style = 'color:green'>Send A Private Message To the Seller(can be seen only by seller)</span><br />";
	echo "<form method = 'post' action = 'viewpost.php?allposts=1&item_id=" . $array ['item_id'] . "'><textarea name = 'privcomment'></textarea><input id = 'pubsubmit' type='submit' name = 'privsubmit' value = 'privcomment'></form>";
}

if (isset ( $_GET ['myposts'] ) && $_GET ['myposts'] == 1) {
	echo "<form method = 'post' action = 'viewpost.php?myposts=1&item_id=" . $array ['item_id'] . "'><textarea name = 'pubcomment'></textarea><input type='submit' name = 'pubsubmit' value = 'comment'></form>";
}
//onClick='updateComments(".$array['item_id'].")'

?> 
