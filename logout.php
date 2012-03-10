<?php
include ("classes/includes.php");
session_unset();
session_destroy();
setCookie("email","",time()-3600);
setCookie("pw","",time()-3600);
header("Location:".ABS_PATH."/");
?>