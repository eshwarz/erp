<?php
require_once('../conn.php');
require_once("../platform/error_reporting.php");
require_once("../platform/query.php");
$id = $_REQUEST['id'];
$db = new query($con);
$db->delete('villages','id='.$id);
echo "village with id ".$id." is deleted";
?>