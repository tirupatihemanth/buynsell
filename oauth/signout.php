<?php
require 'oauth_config.php';
$delimiter= $_SERVER[REQUEST_URI];
$array=explode("/", $delimiter);
$redirect_uri = "http://$_SERVER[HTTP_HOST]/$array[1]";
@session_start();
session_destroy();
$signoutURL = AUTH_SERVER . CMD_SIGNOUT . "?response_type=". RESPONSE_TYPE ."&client_id=" . CLIENT_ID . "&redirect_uri=" . $redirect_uri . "&scope=". SCOPE . "&state=" . STATE;
header('Location:'.$signoutURL);
