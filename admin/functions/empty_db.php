<?php
error_reporting(E_ERROR | E_PARSE);
require_once("../../conn.php");
$id = $_GET["id"];
if ($id == "alwl")
{
	$sql = "DELETE FROM auction_list";
	$result = mysqli_query($sql);
	if (!$result)
	{
		die("ERROR:".mysql_error());
	}

	$sql = "DELETE FROM weights";
	$result = mysqli_query($sql);

	$sql = "DELETE FROM lots";
	$result = mysqli_query($sql);

	header("Location:../?deleted=alwl");
}
?>