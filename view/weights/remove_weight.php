<?php
require_once('../../conn.php');
require_once("../../platform/error_reporting.php");
require_once("../../platform/query.php");
$id = $_REQUEST['id'];
$db = new query;
$db->delete('weights','lot_id='.$id);
$db->delete('lots','lot_id='.$id);
echo "Weight list with id ".$id." is deleted";
?>