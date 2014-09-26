<?php
echo "
  <style>
  ul#header{
       }      
   ul#header li{
    font-size:20px;
    display : inline;
   }
   ul#header li a{
    background-color: blue;
    color:white;
    padding:10px 20px;
	border:1px solid black;
    border-radius: 0px 0px 5px 5px;
   }
   ul#header li a:hover{
    background-color: green;
   }
   </style>
  <html>
    <ul id = 'header'>
    <li><a href = 'afterlogin.php'>Home</a></li>
    <li><a href = 'newpost.php'>New Post</a></li>
    <li><a href = 'posts.php?myposts=1'>My Posts</a></li>
    <li><a href = 'posts.php?allposts=1'>All Posts</a></li>
    <li><a href = 'updateprofile.php'>Update Profile</a></li>
    <li><a href = 'logout.php'>Signout</a></li>
    </ul>
  </html>

";

?> 
