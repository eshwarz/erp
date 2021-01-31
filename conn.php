<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$con = mysqli_connect("localhost","thejbbiu_main","Lucky@2016");
if (!$con)
{
	die("Could not connect!");
}
mysqli_select_db("thejbbiu_tamarind",$con) or header('Location:install.php');
?>