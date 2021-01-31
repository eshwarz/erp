<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$con = mysql_connect("localhost","root","");
if (!$con)
{
	die("Could not connect!");
}
mysql_select_db("tamarind",$con) or header('Location:install.php');
?>