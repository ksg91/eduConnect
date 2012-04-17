<?php
session_start();
include("constants.php");
include("database.php");
include("layoutclasses.php");
include("talks.php");
include("users.php");
include("generalClasses.php");
include("pmclasses.php");
include("chatClasses.php");
include("groups.php");
include("searchClass.php");
$DB=new DatabaseCon();
$DB->connect();
?>