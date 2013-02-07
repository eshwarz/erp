<?php
$con = mysql_connect("localhost","root","");
if (!$con)
{
	die("Could not connect!");
}
mysql_select_db("tamarind",$con) or header('Location:install.php');
?>