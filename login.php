<?php
include ("classes/layoutclasses.php");
$html=new HtmlHeads();
$html->putHead();
echo "<body>";
echo "<div id=\"loginlogo\">";
echo "<table width=\"100%;\" > <tr>";
echo "<td style=\"margin:4px;width:73%;\"><img src=\"resource/logo.png\" alt=\"eduConnect Logo\" /></td><td width=\"20%\">";
echo "<table width=\"100%\" id=\"loginform\"><tr><td>Email:</td><td>Password:</td></tr>";
echo "<tr>";
echo "<form action=\"doLogin.php\" method=\"post\">";
echo "<td><input type=\"text\" name=\"un\" /></td>";
echo "<td><input type=\"password\" name=\"pw\" /></td>";
echo "</tr>";
echo "<td></td><td><input type=\"submit\" value=\"Login\" /></td></table>";
echo "</td><td></td>";
echo "</tr></table>";
echo "</div>";
echo "<table id=\"welcome\">";
echo "<td widht=\"60%\"></td>";
echo "<td width=\"40%\">";
echo "<h2 style=\"color:#404004;\">Stay Connected with Study, Everywhere, Anytime!</h2>";
echo "<ul>";
echo "<li><</li>";
echo "</td>";
echo "</table>";
$html->putFooter();
?>