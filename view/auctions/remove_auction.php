<?php
require_once('../../conn.php');
require_once("../../platform/error_reporting.php");
require_once("../../platform/query.php");
$id = $_REQUEST['id'];
$db = new query;
$db->delete('auction_list','id='.$id);
echo "Auction with id ".$id." is deleted";
?>