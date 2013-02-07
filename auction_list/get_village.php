<?php
error_reporting(5);
require("../conn.php");
require("../platform/query.php");
$farmerId = $_REQUEST['farmer_id'];
$db = new query;
$records = $db->select("village_id","farmers","id=".$farmerId);
$village_id = $records[0]["village_id"];

$records = $db->select("village","villages","id=".$village_id);
echo $records[0]["village"];
?>