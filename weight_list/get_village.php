<?php
error_reporting(E_ERROR | E_PARSE);
require("../conn.php");
require("../platform/query.php");
$farmerId = $_REQUEST['farmer_id'];
$db = new query($con);
$records = $db->select("village_id","farmers","id=".$farmerId);
$village_id = $records[0]["village_id"];

$records = $db->select("village","villages","id=".$village_id);
echo $records[0]["village"];
?>