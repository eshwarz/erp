<?php
error_reporting(E_ERROR | E_PARSE);
require_once("../../conn.php");
$id = $_GET["id"];
if ($id == "alwl")
{
	$sql = "DELETE FROM auction_list";
	$result = mysqli_query($con, ($sql);
	if (!$result)
	{
		die("ERROR:".mysqli_connect_error());
	}

	$sql = "DELETE FROM weights";
	$result = mysqli_query($con, ($sql);

	$sql = "DELETE FROM lots";
	$result = mysqli_query($con, ($sql);

	header("Location:../?deleted=alwl");
}
?>