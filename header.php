<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<script src="bootstrap/jquery-1.11.1"></script>
		<script src="bootstrap/jquery-2.1.1"></script><!-- Latest compiled and minified CSS -->	
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"><!-- Optional theme -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css"><!-- Latest compiled and minified JavaScript -->
		<script src="bootstrap/js/bootstrap.min.js"></script>
		
		<style>
			#contain{
				width:1892px;								/* when we give excat width then on changing the screen size things wont move, if we had written width:100%; then tthings would change on changing the screen size*/ 
				margin:auto;
				}

			#container1{
				background-image: url("https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRBhyjc_CfciODIJ4F_zZDMbROQrIl11PjZlZ3G_yuK79hsFMXL");
    			background-repeat: repeat-x;
				margin-bottom: 0px;
				border:0px;

				}

			#container2{
				background-image: url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsjVDm77qgzb-iE2pf6MBiT8txuFQ7Z4kpk0wWRwRkfYbar1Cz0w");
				background-repeat: repeat-x;
				height:36px;
				box-shadow: 2px 2px 2px;
				border-radius: 4px;
				margin-top:-10px;
				}

			.dropdown:hover .dropdown-menu {
				display: block;
				}

			

			#image{
				margin-left:50px;
				box-shadow: 2px,2px 2px;
				height:100px;
				width:300px;
				}

			#button{
				font-size: 20px;
				box-shadow: 2px 2px	10px;
				padding: 7px 5px;
				margin: 10px 0;
				width: 150px;
				display: block;
				border-radius: 5px;
				border: none;
				}

			#ad{
				height:60px;
				position: relative;
				left:0px;
				top:10px;
				width: 200px;

				}

			#search{
				position: relative;
				left:-350px;
				top:16px;
				width: 650px;

				}

			#span{

				font-size: 20px;
				position: relative;
				left:250px;
				top:-30px;
				}
			
			a.one:link {
    			color:rgba(255,255,255,0.99);
				}			

			a.one:visited {
    			color: rgba(255,255,255,0.99);
				}

			a.one:hover {
			    color: #000000;
				}

			#left{
				width:1500px;
				float:left;
				
				}

			#right{
				width:300px;
				float:right;
				margin-top:10px;
				
				}

			#display{
				display:inline-block;
				padding-right: 10px;
				margin-top:10px;
				margin-left:10px;
				}


			
		</style>
		<script>
		$(document).ready(function(){
		$('.item').hover(
	 function(){
	 $(this).find('.user_details').show();
	 $(this).find('.item_details').hide();},
	 function(){
	 $('.user_details').hide();
	 $('.item_details').show();}
	 	 
	 );
	 })
		</script>
	</head>
	

	<body>
		<div id="contain">
			<nav id="container1" role="navigation">
				<div style="display:inline-block;" >
					<a href="posts.php?allposts=1">
						<img id="image" src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQMYwkYT2amKmpIo3FbhkAWcLOWKe_B6c_YSq1Riefr0gnZCqWV">
					</a>

					<a id="span" class="one" target="_blank"  href="http://students.iitm.ac.in/"> <span class="glyphicon glyphicon-user"></span><i><u>Student Portal</u></i></a> 
	<!----> 		<a id="span" class="one" target="_blank" style=" margin:100px; " href="http://google.com"> <span class="glyphicon glyphicon-globe"></span><i><u>Google</u></i></a>
	<!-- no link-->	<a id="span" class="one" target="_blank"  href=""> <span class="glyphicon glyphicon-phone"></span><i><u>Mobile APP</u></i></a>
	<!----> 		<input id="search" class ="input-lg" type="text"placeholder ="Search">
					<a href="newpost.php"><button id="ad" class=" btn btn-danger btn-lg"type="button">POST an AD</button></a>
				</div>		
			</nav>
	
			<nav id="container2">
				<h4><em>
					<div id="left">
						<div id="display" style="margin-left:500px;" class="dropdown">
					        <a class="dropdown-toggle" style="color:gray; " href="#"  data-toggle="dropdown">ELETRONICS<span class="caret"></span></a>
				        	<ul class="dropdown-menu" role="menu">
					            <li><a href="#">Action</a></li>
					            <li><a href="#">Another action</a></li>
					            <li><a href="#">Something else here</a></li>
					            <li class="divider"></li>
					            <li><a href="#">Separated link</a></li>
					            <li class="divider"></li>
					            <li><a href="#">One more separated link</a></li>
				        	</ul>
					    </div>	

						<div id="display" class="dropdown">
					        <a style="color:gray;" href="#" class="dropdown-toggle" data-toggle="dropdown">ACCESSORIES <span class="caret"></span></a>
					        <ul class="dropdown-menu" role="menu">
					            <li><a href="#">Action</a></li>
					            <li><a href="#">Another action</a></li>
					            <li><a href="#">Something else here</a></li>
					            <li class="divider"></li>
					            <li><a href="#">Separated link</a></li>
					            <li class="divider"></li>
					            <li><a href="#">One more separated link</a></li>
					        </ul>
					    </div>

						<div id="display" class="dropdown">
					        <a style="color:gray;" href="#" class="dropdown-toggle" data-toggle="dropdown">MEN <span class="caret"></span></a>
					        <ul class="dropdown-menu" role="menu">
					            <li><a href="#">Action</a></li>
					            <li><a href="#">Another action</a></li>
					            <li><a href="#">Something else here</a></li>
					            <li class="divider"></li>
					            <li><a href="#">Separated link</a></li>
					            <li class="divider"></li>
					            <li><a href="#">One more separated link</a></li>
					        </ul>
				        </div>
						<div id="display" class="dropdown">
					        <a style="color:gray;" href="#" class="dropdown-toggle" data-toggle="dropdown">WOMEN <span class="caret"></span></a>
					        <ul class="dropdown-menu" role="menu">
					            <li><a href="#">Action</a></li>
					            <li><a href="#">Another action</a></li>
					            <li><a href="#">Something else here</a></li>
					            <li class="divider"></li>
					            <li><a href="#">Separated link</a></li>
					            <li class="divider"></li>
					            <li><a href="#">One more separated link</a></li>
					        </ul>
					    </div>	
						<div id="display" class="dropdown">
					        <a style="color:gray;" href="#" class="dropdown-toggle" data-toggle="dropdown">BOOKS <span class="caret"></span></a>
					        <ul class="dropdown-menu" role="menu">
					            <li><a href="#">Action</a></li>
					            <li><a href="#">Another action</a></li>
					            <li><a href="#">Something else here</a></li>
					            <li class="divider"></li>
					            <li><a href="#">Separated link</a></li>
					            <li class="divider"></li>
					            <li><a href="#">One more separated link</a></li>
					        </ul>
				        </div>	
						<div id="display" class="dropdown">
					        <a style="color:gray;" href="#" class="dropdown-toggle" data-toggle="dropdown">VEHICLES<span class="caret"></span></a>
					        <ul class="dropdown-menu" role="menu">
					            <li><a href="#">Action</a></li>
					            <li><a href="#">Another action</a></li>
					            <li><a href="#">Something else here</a></li>
					            <li class="divider"></li>
					            <li><a href="#">Separated link</a></li>
					            <li class="divider"></li>
					            <li><a href="#">One more separated link</a></li>
					        </ul>
				        </div>				
						<div id="display" class="dropdown">
					        <a style="color:gray;" href="#" class="dropdown-toggle" data-toggle="dropdown">MORE <span class="caret"></span></a>
					        <ul class="dropdown-menu" role="menu">
					            <li><a href="#">Action</a></li>
					            <li><a href="#">Another action</a></li>
					            <li><a href="#">Something else here</a></li>
					            <li class="divider"></li>
					            <li><a href="#">Separated link</a></li>
					            <li class="divider"></li>
					            <li><a href="#">One more separated link</a></li>
					        </ul>
				        </div>
					</div>
			
					<div id="right">
						<div  class="dropdown">
					        <a style="color:gray;"href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>MY ACCOUNT<span class="caret"></span></a>
					        <ul class="dropdown-menu" role="menu">
					            <li role="presentation"><a role="menuitem"  href="viewprofile.php">My Profile</a></li>
					            <li role="presentation"><a role="menuitem"  href="posts.php?myposts=1">My Posts</a></li>
					            <li role="presentation"><a role="menuitem"  href="updateprofile.php">Settings</a></li>
					            <li class="divider"></li>
					            <li role="presentation"><a role="menuitem"  href="feedback.php">Feedback</a></li>
					            <li class="divider"></li>
					            <li role="presentation"><a role="menuitem"  href="oauth/signout.php">Logout</a></li>
					        </ul>
					   </div>	
					</div>
				</em></h4>
			</nav>
		</div>	
	</body>
</html>