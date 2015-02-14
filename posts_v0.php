<?php
session_start ();
require_once 'functions.php';
sessionCheck ();
?>

<!DOCTYPE HTML>
<html>
<!-- To change the color of the secondary navbar make the changes at the following locations:
        1. Change the rgb values of the site color below (Line 32)
        2. Change the rgb values of the site color in 'dnb_bootstrap.css'
Note: A Sass implementation can make this easier. Please look into that if you can
-->
<head>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="dnb.css">
<style>
#dnb_sec {
	-skrollr-animation-name: animation1;
}

@
-skrollr-keyframes animation1 { 0 {
	margin-top: 0px;
	position: relative;
	<!--
	Site
	Color
	-->
	background-color
	:
	rgba(
	230
	,
	126
	,
	34
	,
	1
	);
	<!--
	Site
	Color
	-->
}

top {
	margin-top: 0px;
	position: fixed;
	background-color: rgba(255, 255, 255, 0.99);
}
}
</style>
</head>

<body>
	<div id="skrollr-body">

		<div class='col-xs-12' id='dnb_primary' data-0="top:0px;"
			data-40="top:-140px;">
			<nav>
				<ul>
					<li class='col-xs-5 col-md-3 pull-left'><span class='col-xs-12'
						id='dnb_logo'>
							<p>
								<b>Students&nbsp;</b>Portal
							</p>
					</span></li>



					<li class='col-xs-5 col-md-6'>
						<div class="input-group col-xs-12">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">Go</button>
							</span> <input type="text" class="form-control"
								placeholder="Search">
						</div>
					</li>

				</ul>
			</nav>
		</div>

		<div id='dnb_sec' class='dnb_secondary col-xs-12'>
			<nav>
				<span class='col-xs-2'><div class='btn2 col-xs-12 pull-left'
						id='dnb_secondary_logo' data-0="color:rgb(255,255,255)"
						data-50="color:rgb(0,0,0)">
						<b>Buy&nbsp;</b>&amp;<b>&nbsp;Sell</b>&nbsp;
					</div> </span>

				<div class="hidden-sm hidden-xs col-md-2 dropdown pull-right">
					<a class="pull-right dropdown-toggle" data-toggle="dropdown"
						href="#"> <span class="btn2 glyphicon glyphicon-user pull-right"
						data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)"
						aria-hidden="true">
                                <?php echo $_SESSION['user_fullname']; ?>
                                <span class="caret"></span>
					</span>
					</a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
						<li><a href="#">Option 1</a></li>
						<li><a href="oauth/signout.php">Logout</a></li>
					</ul>
				</div>

				<div class='col-xs-1 ad pull-right'>
					<button type="button" class="btn btn-success">Post an Ad</button>
				</div>
				<ul class='col-xs-6'>

					<li class='hidden-xs col-sm-3 col-md-3 col-lg-2'>
						<div class='btn2'>
							<a data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)"
								href="/html/"> Books </a>
						</div>
					</li>
					<li class='hidden-xs col-sm-3 col-md-3 col-lg-2'>
						<div class='btn2'>
							<a data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)"
								href="/css/"> Mobiles </a>
						</div>
					</li>
					<li class='hidden-xs col-sm-3 col-md-3 col-lg-2'>
						<div class='btn2'>
							<a data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)"
								href="/js/"> Coupons </a>
						</div>
					</li>
					<li class='hidden-xs hidden-sm hidden-md col-lg-2'>
						<div class='btn2'>
							<a data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)"
								href="/jquery/"> Electronics </a>
						</div>
					</li>
					<li class='hidden-xs hidden-sm hidden-md col-lg-2'>
						<div class='btn2'>
							<a data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)"
								href="/jquery/"> Stationery </a>
						</div>
					</li>
					<li class='col-xs-12 col-sm-3 col-md-3 col-lg-2'>
						<div class="dropdown btn2">
							<a class="dropdown-toggle" type="button" id="dropdownMenu1"
								data-toggle="dropdown" aria-expanded="true"
								data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)"> More
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu"
								aria-labelledby="dropdownMenu1">
								<li class='visible-xs'><a href="#">Secretaries</a></li>
								<li class='visible-xs'><a href="#">Office</a></li>
								<li class='visible-xs'><a href="#">Services</a></li>
								<li><a href="#">Schroeter</a></li>
								<li><a href="#">Alumni</a></li>
								<li class='hidden-lg'><a href="#">Techsoc</a></li>
								<li class='hidden-lg'><a href="#">Litsoc</a></li>

							</ul>
						</div>
					</li>
				</ul>
			</nav>
		</div>
	</div>

	<div class='content col-xs-10 col-xs-offset-1'>
		<!--Insert content replacing the para and heading below-->

		<div class='col-xs-12'>
			<div class='col-xs-12'>
				<h4 style='background-color: #505050; color: white; padding: 10px;'>Top
					Deals</h4>
				<hr>

<?php
include "carousal.php";
echo "<div class='col-xs-4 wrap_offer'>";
include "offers.php";
echo "</div></div>";

echo "<br><br><br>";
echo "<hr><div class='col-xs-12'>";
// if (! isset ( $_SESSION ['user_id'] )) {
// 	header ( "Location: /buynsell/index.php?exp=1" );
// 	exit ();
// }

if (isset ( $_GET ['myposts'] ) && $_GET ['myposts'] == 1) {
	
	echo "<h4 style='background-color:#505050;color:white;padding:10px;'>Your Posts</h4>";
	$status = "myposts=1";
	include "mini_menu.php";
	if (isset ( $_GET ['tag_id'] )) {
		$result_items = mysqli_query ( $connection, "SELECT * FROM items,item_tags WHERE items.item_id = item_tags.item_id AND items.user_id = '{$_SESSION['user_id']}' AND item_tags.tag_id = '{$_GET['tag_id']}' ORDER BY timestamp DESC" );
		if (! $result_items)
			die ( "Mysql query error has occured " . mysql_error () );
		$result_items_rows = mysqli_num_rows ( $result_items );
		if ($result_items_rows == 0)
			echo "<span>Nothing to see here move along :)</span>";
		else {
			for($i = 0; $i < $result_items_rows; $i ++) {
				$array = mysqli_fetch_array ( $result_items );
				echo "<a href='viewpost.php?myposts=1&item_id=" . $array ['item_id'] . "'>";
				echo "<div class='item col-xs-3'><div class='item_details'>";
				// echo "<span style = 'color:red'>Post Number: ".($i+1)."</span><br />";
				echo "<span class='text-center'><h4> " . $array ['item_name'] . "</h4></span><br />";
				echo "<img class='center-block' src='photos_items/" . $array ['user_id'] . $array ['item_id'] . "' alt='404' height='200px' width='200px'>";
				echo "<span class='center-block'><p class='text-center price'>Rs. " . $array ['price'] . "</p></span></div></div>";
				// echo "<span>Description:<br /><span style = 'color:green'>".$array['description']."</span></span>";
				// echo "<span>Reason for selling:<br /><span style = 'color:green'>".$array['reason']."</span></span><br /><br><br>";
				echo "</a>";
			}
		}
	} else {
		$result_items = mysqli_query ( $connection, "SELECT * FROM items WHERE user_id = '{$_SESSION['user_id']}' ORDER BY timestamp DESC" );
		if (! $result_items)
			die ( "Mysql query error" . mysql_error () );
		if (mysqli_num_rows ( $result_items ) == 0)
			echo "<p>You haven't made any posts. To post something click <a href='newpost.php'>here</a> or click post an AD at the top of the page</a></p>";
		for($i = 0; $i < mysqli_num_rows ( $result_items ); $i ++) {
			$array = mysqli_fetch_array ( $result_items );
			echo "<a href = 'viewpost.php?myposts=1&item_id=" . $array ['item_id'] . "'>";
			echo "<div class='item col-xs-3'><div class='item_details'>";
			// echo "<span style = 'color:red'>Post Number: ".($i+1)."</span><br />";
			echo "<span class='text-center'><h4> " . $array ['item_name'] . "</h4></span><br />";
			echo "<img class='center-block' src='photos_items/" . $array ['user_id'] . $array ['item_id'] . "' alt='404' height='200px' width='200px'>";
			echo "<span class='center-block'><p class='text-center price'>Rs. " . $array ['price'] . "</p></span></div></div>";
			// echo "<span>Description:<br /><span style = 'color:green'>".$array['description']."</span></span>";
			// echo "<span>Reason for selling:<br /><span style = 'color:green'>".$array['reason']."</span></span><br /><br><br>";
			echo "</a>";
		}
	}
} 

else if (isset ( $_GET ['allposts'] ) && $_GET ['allposts'] == 1) {
	
	echo "<h4 style='background-color:#505050;color:white;padding:10px;'>All Deals</h4>";
	$status = "allposts=1";
	include "mini_menu.php";
	if (isset ( $_GET ['tag_id'] )) {
		
		$result_items = mysqli_query ( $connection, "SELECT * FROM items,item_tags WHERE items.item_id = item_tags.item_id AND item_tags.tag_id = '{$_GET['tag_id']}' ORDER BY timestamp DESC" );
		if (! $result_items)
			die ( "Mysql query error has occured " . mysql_error () );
		$result_items_rows = mysqli_num_rows ( $result_items );
		if ($result_items_rows == 0)
			echo "<span>Nothing to see here move along :)</span>";
		else {
			for($i = 0; $i < $result_items_rows; $i ++) {
				$array = mysqli_fetch_array ( $result_items );
				echo "<a href = 'viewpost.php?allposts=1&item_id=" . $array ['item_id'] . "'>";
				echo "<div class='item col-xs-3'><div class='item_details'>";
				// echo "<span style = 'color:red'>Post Number: ".($i+1)."</span><br />";
				echo "<span class='text-center'><h4> " . $array ['item_name'] . "</h4></span><br />";
				echo "<img class='center-block' src='photos_items/" . $array ['user_id'] . $array ['item_id'] . "' alt='404' height='200px' width='200px'>";
				echo "<span class='center-block'><p class='text-center price'>Rs. " . $array ['price'] . "</p></span>";
				// echo "<span>Description:<br /><span style = 'color:green'>".$array['description']."</span></span>";
				// echo "<span>Reason for selling:<br /><span style = 'color:green'>".$array['reason']."</span></span><br /><br><br>";
				echo "</div><div class='user_details'><span style = 'color:blue'><b>User Details:<br /></b></span>";
				
				$userdetails = mysqli_query ( $connection, "SELECT * FROM userinfo WHERE id = '{$array['user_id']}'" );
				if (! $userdetails)
					die ( "Mysql error in query" . mysql_error () );
				$userarray = mysqli_fetch_array ( $userdetails );
				echo "<span><span color: green>User Name: </span><span>" . $userarray ['fullname'] . "</span><br />";
				echo "<span><span color: green>RollNumber: </span><span>" . $userarray ['rollno'] . "</span><br />";
				echo "<span><span color: green>Hostel: </span><span>" . $userarray ['hostel'] . "</span><br />";
				echo "<span><span color: green>Room Number: </span><span>" . $userarray ['roomno'] . "</span><br />";
				echo "<span><span color: green>email id: </span><span>" . $userarray ['emailid'] . "</span><br />";
				// include "comments.php";
				echo "<br><br></div></div>";
				echo "</a>";
			}
		}
	} else {
		$con = mysqli_connect ( $WEBHOST, $USER, $PASSWORD, $DATABASE );
		// Check connection
		if (mysqli_connect_errno ()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error ();
		}
		
		$result = mysqli_query ( $con, "SELECT * FROM items" ) or die ( mysqli_error ( $con ) );
		
		for($i = 0; $i < mysqli_num_rows ( $result ); $i ++) {
			$array = mysqli_fetch_array ( $result );
			echo "<a href = 'viewpost.php?allposts=1&item_id=" . $array ['item_id'] . "'>";
			echo "<div class='item col-xs-3'><div class='item_details'>";
			// echo "<span style = 'color:red'>Post Number: ".($i+1)."</span><br />";
			echo "<span class='text-center'><h4> " . $array ['item_name'] . "</h4></span><br />";
			echo "<img class='center-block' src='photos_items/" . $array ['user_id'] . $array ['item_id'] . "' alt='404' height='200px' width='200px'>";
			echo "<span class='center-block'><p class='text-center price'>Rs. " . $array ['price'] . "</p></span>";
			// echo "<span>Description:<br /><span style = 'color:green'>".$array['description']."</span></span>";
			// echo "<span>Reason for selling:<br /><span style = 'color:green'>".$array['reason']."</span></span><br /><br><br>";
			echo "</div><div class='user_details'><span style = 'color:blue'><b>User Details:<br /></b></span>";
			
			$userdetails = mysqli_query ( $connection, "SELECT * FROM userinfo WHERE id = '{$array['user_id']}'" );
			if (! $userdetails)
				die ( "Mysql error in query" . mysql_error () );
			$userarray = mysqli_fetch_array ( $userdetails );
			echo "<span><span color: green>User Name: </span><span>" . $userarray ['fullname'] . "</span><br />";
			echo "<span><span color: green>RollNumber: </span><span>" . $userarray ['rollno'] . "</span><br />";
			echo "<span><span color: green>Hostel: </span><span>" . $userarray ['hostel'] . "</span><br />";
			echo "<span><span color: green>Room Number: </span><span>" . $userarray ['roomno'] . "</span><br />";
			echo "<span><span color: green>email id: </span><span>" . $userarray ['emailid'] . "</span><br />";
			// include "comments.php";
			echo "<br><br></div></div>";
			echo "</a>";
		}
	}
}

?>
  </div>
		</div>

	</div>

	<script type="text/javascript" src="skrollr.stylesheets.js"></script>
	<script type="text/javascript" src="skrollr.js"></script>
	<script type="text/javascript">skrollr.init();</script>
</body>
</html>