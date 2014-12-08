<?php
error_reporting(E_ERROR | E_PARSE);
require("../conn.php");
require_once("../platform/query.php");
require_once("../platform/escape_data.php");
require_once("../functions/functions.php");
$farmerId = $_REQUEST['farmer'];
$farmerName = escape_data($_REQUEST['farmer_new']);

$village = $_REQUEST['village'];
$quality = $_REQUEST['quality'];
$buyer = $_REQUEST['buyer'];
$cost = $_REQUEST['cost'];
$lotNumber = $_REQUEST['lotNumber'];
$serialNumber = escape_data($_REQUEST['serialNumber']);
$settings = settings();

if ($cost == "Cost"||$lotNumber == "Lot Number"||empty($quality)||empty($buyer))
{
	?>
   	<div class="tc db wa pt20 pb5"><span class="errorReporter">All fields required!</span></div>
    <?php
}
else
{
	if (empty($farmerId))//newFarmerModule
	{
		$db = new query;
		$db->insert("farmers","village_id,name","".$village.",'".$farmerName."'");
		$record = $db->select("id","farmers","name='".$farmerName."'");
		$farmerId = $record[0]['id'];
	}
	
	//storing auction details into auction_list.
	//$date = date("Y-m-d");
	$date = calculateDate();
	if ($serialNumber == 'Serial Number')
		$serialNumber = 0;
		
	$dbcall = new query;
	$dbcall->insert("auction_list","serial,lot_number,quality,farmer_id,buyer_id,cost,date","'".$serialNumber."',".$lotNumber.",".$quality.",".$farmerId.",".$buyer.",".$cost.",'".$date."'");
		
	?>
    <div class="tc bcc db wa p10"><?php echo "Auction List stored!"; ?></div>
    <?php
}