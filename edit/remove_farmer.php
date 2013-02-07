<?php
require_once('../conn.php');
require_once("../platform/error_reporting.php");
require_once("../platform/query.php");
$id = $_REQUEST['id'];
$db = new query;
$db->delete('farmers','id='.$id);
echo "farmers with id ".$id." is deleted";
?>