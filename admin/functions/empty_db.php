<?php
error_reporting(5);
require_once("../../conn.php");
$id = $_GET["id"];
if ($id == "alwl")
{
	$sql = "DELETE FROM auction_list";
	$result = mysql_query($sql);
	if (!$result)
	{
		die("ERROR:".mysql_error());
	}

	$sql = "DELETE FROM weights";
	$result = mysql_query($sql);

	$sql = "DELETE FROM lots";
	$result = mysql_query($sql);

	header("Location:../?deleted=alwl");
}
?>