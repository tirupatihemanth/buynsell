
<!DOCTYPE HTML>
<?php
  include "db.php";
  session_start();
  if(!isset($_SESSION['user_id'])){
    header("Location: /buynsell/index.php?exp=1");
    exit();
  }
?>

 <?php
  $connection = mysql_connect($WEBHOST, $USER, $PASSWORD);
  if(!$connection)
    die("Mysql connection with the database failed".mysql_error());
  mysql_select_db($DATABASE,$connection);
  $result = mysql_query("SELECT * from userinfo WHERE id = '{$_SESSION['user_id']}'",$connection);
  if(!$result)
    die("Mysql query failed".mysql_error());
  $result = mysql_fetch_array($result);
  $_SESSION['rollnum'] = $result['rollno'];
  $_SESSION['fullname'] = $result['fullname'];

  mysql_close($connection);
  
 ?>

<html>
    <!-- To change the color of the secondary navbar make the changes at the following locations:
        1. Change the rgb values of the site color below (Line 32)
        2. Change the rgb values of the site color in 'dnb_bootstrap.css'
Note: A Sass implementation can make this easier. Please look into that if you can
-->
    <head>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="dnb.css">  
        <link rel="stylesheet" type="text/css" href="posts.css">  

        <style>
            #dnb_sec {
                -skrollr-animation-name:animation1;
            }

            @-skrollr-keyframes animation1 {
                0 {
                    margin-top:0px;
                    position:relative;
                    
                    <!--Site Color -->
                    background-color:rgba(230, 126, 34,1);
                    <!--Site Color-->
                }

                top {
                    margin-top:0px;
                    position:fixed;
                    background-color:rgba(255, 255, 255,0.99);
                }
            }
            
       </style>
    </head>
    
    <body>
        <div id="skrollr-body">
            
            <div class='col-xs-12' id='dnb_primary' data-0="top:0px;" data-40="top:-140px;">
                <nav>
                    <ul>
                        <li class='col-xs-5 col-md-3 pull-left'>
                            <span class='col-xs-12' id='dnb_logo'>
                                <p><b>Students&nbsp;</b>Portal</p>
                            </span>
                        </li>
                        

                        
                        <li class='col-xs-5 col-md-6'>
                            <div class="input-group col-xs-12">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Go</button>
                                </span>
                                
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                        </li>

                    </ul>
                </nav>
            </div>
        <?php 
                $connection = mysqli_connect($WEBHOST, $USER, $PASSWORD,$DATABASE);

                if(!$connection)
                die("Mysql connection with the database failed".mysql_error());

                $userdetails = mysqli_query($connection,"SELECT * FROM userinfo WHERE id = '{$_SESSION['user_id']}'");
                if(!$userdetails)die("Mysql error in query".mysql_error());
                $userarray = mysqli_fetch_array($userdetails);
        ?>      
            <div id = 'dnb_sec' class='dnb_secondary col-xs-12'>
                <nav>
                    <span class='col-xs-2'><div class='btn2 col-xs-12 pull-left' id='dnb_secondary_logo' data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)">
                        <b>Buy&nbsp;</b>&amp;<b>&nbsp;Sell</b>&nbsp;</div>
                    </span>
                    
                    <div class="hidden-sm hidden-xs col-md-2 dropdown pull-right">
                        <a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="btn2 glyphicon glyphicon-user pull-right" data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)" aria-hidden="true">
                                <?php echo $userarray['fullname']; ?>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li><a href="#">Option 1</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                    
                    <div class='col-xs-1 ad pull-right'><button type="button" class="btn btn-success">Post an Ad</button></div>
                    <ul class='col-xs-6'>
                        
                        <li class='hidden-xs col-sm-3 col-md-3 col-lg-2'>
                            <div class='btn2'>
                                <a data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)" href="/html/">
                                    Books
                                </a>
                            </div> 
                        </li>
                        <li class='hidden-xs col-sm-3 col-md-3 col-lg-2'>
                            <div class='btn2'>
                                <a data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)" href="/css/">
                                    Mobiles
                                </a>
                            </div>
                        </li>
                        <li class='hidden-xs col-sm-3 col-md-3 col-lg-2'>
                            <div class='btn2'><a data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)" href="/js/">
                                Coupons
                                </a>
                            </div>
                        </li>
                        <li class='hidden-xs hidden-sm hidden-md col-lg-2'>
                            <div class='btn2'>
                                <a data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)" href="/jquery/">
                                Electronics
                                </a>
                            </div>
                        </li>
                        <li class='hidden-xs hidden-sm hidden-md col-lg-2'>
                            <div class='btn2'>
                                <a data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)" href="/jquery/">
                                    Stationery
                                </a>
                            </div>
                        </li>
                        <li class='col-xs-12 col-sm-3 col-md-3 col-lg-2'>
                            <div class="dropdown btn2">
                                <a class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true"  data-0="color:rgb(255,255,255)" data-50="color:rgb(0,0,0)">
                                    More
                                    <span class="caret"></span>
                                </a>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
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
            
	    <?php
	      $connection = mysql_connect($WEBHOST,$USER,$PASSWORD);
	      if(!$connection)
		die("Mysql connection with the dtatabase failed".mysql_error());
		
	      mysql_select_db($DATABASE,$connection);
	      
	      $result = mysql_query("SELECT * FROM userinfo WHERE rollno = '{$_SESSION['rollnum']}'");
	      if(mysql_num_rows($result)==1){
		$user = mysql_fetch_array($result);
		$_SESSION['fullname'] = $user['fullname'];
	      }
	     if($_SESSION['fullname']=="")
		echo "<br /><br />BUYNSELL@IITM WELCOMES ". $_SESSION['rollnum'];
	      else
	echo "BUYNSELL@IITM WELCOMES ". $_SESSION['fullname'];

	    ?>
            
	<div>
	<p>We thank you for joining our project of making the Life At IITM more peaceful!!!</p>
	<p>You have some unused products and would like to sell them It's simple now.  Post Below:</p>
	<p>We would like to Introduce to our all new news feed. This feed contans some important notifications such as comments on your posts and also private messages sent to you</p>
<<<<<<< Updated upstream
	<p>Wanna share a cab with some one?</p>
	<a href="shareacab.php">SHARE A CAB</a>
	<h3>Public comments on your posts</h3>
=======
	<div class='col-xs-6 cmt_box'><h3>Public comments on your posts</h3>
>>>>>>> Stashed changes
	<?php
	$pubcomments = mysql_query("SELECT comments.user_com_id,comments.message,userinfo.rollno FROM items, comments, userinfo WHERE items.item_id = comments.item_id AND items.user_id = '{$_SESSION['user_id']}' AND userinfo.id = comments.user_com_id AND visibility = 1",$connection);
	if(!$pubcomments)
	  die("Mysql query error has occured".mysql_error());
	$rows = mysql_num_rows($pubcomments);
//	echo "<br />blah blah blah<br />";
//	print_r($rows);
	if($rows == 0){
	  echo "<span style = 'background-color:#f7f7f7'>Nothing to see here move along :)</span><br />";
	}
	else{
	  for($i = 0;$i<$rows;$i++){
	    $array = mysql_fetch_array($pubcomments);
	    echo "<div class='posts col-xs-12'><span class='cmt_text col-xs-12'><a href='viewprofile.php?user_id=".$array['user_com_id']."'>".$array['rollno']."</a> commented on your post</span><br />";
	    echo "<span class='cmt_main col-xs-12'>".$array['message']."</span></div>";
	  }
    }?></div>
        <div class='col-xs-6 cmt_box'><?php
	echo "<h3>Some private messages you have got</h3>";
	$privcomments = mysql_query("SELECT comments.user_com_id, comments.message, userinfo.rollno FROM items, comments,userinfo WHERE items.item_id = comments.item_id AND user_id = '{$_SESSION['user_id']}' AND userinfo.id = comments.user_com_id AND visibility = 0",$connection);
	if(!$privcomments)
	  die("Mysql query error has occured".mysql_error());
	$rows = mysql_num_rows($privcomments);
	if($rows == 0){
	  echo "<span style = 'background-color:#f7f7f7'>Nothing to see here move along :)</span><br />";
	}
	else{
	  for($i = 0;$i<$rows;$i++){

	    $array = mysql_fetch_array($privcomments);
	    echo "<div class='posts col-xs-12'><span class='cmt_text col-xs-12'><a href='viewprofile.php?user_id=".$array['user_com_id']."'>".$array['rollno']."</a> sent a new private message</span><br />";
	    echo "<span class='cmt_main col-xs-12'>".($i+1).". ".$array['message']."</span><br /></div>";
	  }
	}
	mysql_close($connection);
	
            ?></div>
	</div>
            
        </div>
    
    <script type="text/javascript" src="skrollr.stylesheets.js"></script>
    <script type="text/javascript" src="skrollr.js"></script>
    <script type="text/javascript">skrollr.init();</script>
    </body>
</html>
