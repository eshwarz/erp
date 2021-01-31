<?php
require_once('../conn.php');
require_once("../platform/error_reporting.php");
require_once("../platform/query.php");
$id = $_REQUEST['id'];
$db = new query($con);
$db->delete('quality','id='.$id);
echo "quality with id ".$id." is deleted";
?>