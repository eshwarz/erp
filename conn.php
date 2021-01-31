<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$con = mysqli_connect("localhost", "thejbbiu_main", "Lucky@2016", "thejbbiu_tamarind");
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
 	exit();
}
