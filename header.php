<?php
echo "
  <style>
   ul#header li{
    font-size:20px;
    display : inline;
   }
   ul#header li a{
    background-color: blue;
    color:white;
    padding:10px 20px;
    border-radius: 4px 4px 0 0;
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