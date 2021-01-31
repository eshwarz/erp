<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$con = mysql_connect("localhost","thejbbiu_main","Lucky@2016");
if (!$con)
{
	die("Could not connect!");
}
mysql_select_db("thejbbiu_tamarind",$con) or header('Location:install.php');
?>