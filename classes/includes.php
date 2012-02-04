<?php
session_start();
include("constants.php");
include("database.php");
include("layoutclasses.php");
include("talks.php");
include("users.php");
$DB=new DatabaseCon();
$DB->connect();
?>