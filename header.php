<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		
		<style>
			.dropdown:hover .dropdown-menu {
							display: block;
							}
							
			.nav-top1{
						margin-bottom: 0px;
						border:0px;
						}
			.navbar-inverse, .navbar-default{
			border-radius:0px;
			}
			
			.nav-top{
			padding-top:1rem;
			background-color:#057778;
			}
			.input-lg{
			border-radius:0px;
			border:1px solid #f0f0f0;
			}
			.btn{
			border-radius:0px;
			}
			.search{
			padding-top:1rem;
			color:white;
			font-size:25px;
			}
			.item:hover{
			box-shadow:2px 2px 2px #a0a0a0;
			border:1px solid #a0a0a0;
			}
			.user_details{
			display: none;
			
			}
			.item{
			height:300px;
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
		<nav class="navbar navbar-default nav-top1" role="navigation">
			<div class="col-xs-12 col-md-12  nav-top">
				<a href="posts.php?allposts=1"><div class="col-xs-2">
						<img src="logo2.jpg" class="pull-right" height="100px;">
				</div></a>
			
				<div class="col-xs-10 pull-right">
					<div  class="col-xs-12 col-md-12 ">
						<div class="col-xs-6 col-md-6">
							<h4><span class="glyphicon glyphicon-search search col-xs-1"></span> </h4>
							<input type="text" class ="input-lg col-xs-10" placeholder ="Search">
						</div>
					
						<div class="col-xs-6 pull-right" >
							<a href="newpost.php">
							<button type="button" class="col-xs-8 btn btn-warning btn-lg pull-right">POST an AD</button>
							</a>
						</div>
					</div>
				</div>
			</div>		
		</nav>
		
		<nav class="col-xs-10 col-xs-offset-1 navbar navbar-inverse nav-bottom" role="navigation">
			<div  class="col-xs-12">
				<div class=" col-xs-9 ">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<div class="nav nav-pills menu-links">
							<ul class="nav navbar-nav pull-left">
							
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">ELETRONICS<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>	
								 <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">ACCESSORIES <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>	
								 <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">MEN <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
								 <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">WOMEN <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>	
								 <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">BOOKS <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>	
								 <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">VEHICLES<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>				
								 <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">MORE <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
		
								
								
							</ul>
						</div>
					</div>
				</div>
		
		
		<ul class="nav navbar-nav pull-right">
							
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>&nbspMY ACCOUNT<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li role="presentation"><a role="menuitem"  href="afterlogin.php">My Profile</a></li>
            <li role="presentation"><a role="menuitem"  href="posts.php?myposts=1">My Posts</a></li>
            <li role="presentation"><a role="menuitem"  href="updateprofile.php">Settings</a></li>
            <li class="divider"></li>
            <li role="presentation"><a role="menuitem"  href=#>Feedback</a></li>
            <li class="divider"></li>
            <li role="presentation"><a role="menuitem"  href="logout.php">Logout</a></li>
          </ul>
        </li>	
		</ul>
		
				
			</div>
		</nav>		
	
		
	</body>
	

</html>