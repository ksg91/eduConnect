<?php
session_start();
include("constants.php");
include("database.php");
include("layoutclasses.php");
include("talks.php");
include("users.php");
include("generalClasses.php");
$DB=new DatabaseCon();
$DB->connect();
?>