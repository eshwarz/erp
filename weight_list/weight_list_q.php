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

if ($cost == "Cost" || $lotNumber == "Lot Number" || empty($quality))
{
	?>
 	<div class="tc db wa pt20 pb5">
 		<span class="errorReporter">All fields required!</span>
 	</div>
  <?php
}
else
{
	if (empty($farmerId))//newFarmerModule
	{
		$db = new query($con);
		$db->insert("farmers","village_id,name","".$village.",'".$farmerName."'");
		$record = $db->select("id","farmers","name='".$farmerName."'");
		$farmerId = $record[0]['id'];	
	}
	
	//storing lot details into lots and getting lot_id.
	//$date = date("Y-m-d");
	$date = calculateDate();
	if ($serialNumber == 'Serial Number')
		$serialNumber = 0;
		
	//checking whether lot is pending or not.
	$pending_flag = 0;
	for ($m=1;$m<=$lotNumber;$m++)
	{
		if ($_REQUEST["bag".$m] == 0)
		{
			$pending_flag = 1;
			break;
		}
	}

	$dbcall = new query($con);
	if ($pending_flag == 0)
	{
		$dbcall->insert("lots","serial,lot_number,quality,farmer_id,buyer_id,cost,date","'".$serialNumber."',".$lotNumber.",".$quality.",".$farmerId.",".$buyer.",".$cost.",'".$date."'");
	}
	else
	{
		$dbcall->insert("lots","serial,lot_number,quality,farmer_id,buyer_id,cost,pending,date","'".$serialNumber."',".$lotNumber.",".$quality.",".$farmerId.",".$buyer.",".$cost.",1,'".$date."'");
	}
	
	$record = $dbcall->select("lot_id","lots","farmer_id=".$farmerId." AND buyer_id=".$buyer."","time",1,0,1);
	$lotId = $record[0]['lot_id'];
	
	//storing weights using lot_id after deducting 2 kgs from each bag.
	$totalWeight = 0;

	//getting weight deduction.
	$db_deduction = new query($con);
	$record = $db_deduction->select('*','weight_deduction');
	$deduction = $record[0]['weight_deduction'];

	for ($m=1;$m<=$lotNumber;$m++)
	{
		if ($_REQUEST["bag".$m] != 0)
		{
			$bag = $_REQUEST["bag".$m]-$deduction;
			$totalWeight = $totalWeight+$bag;
		}
		else
		{
			$bag = 0;
			$totalWeight = $totalWeight+$bag;
		}
		
		if ($_REQUEST['buyer'.$m] == '')
			$bag_buyer = 0;
		else
			$bag_buyer = $_REQUEST['buyer'.$m];

		$dbcall->insert("weights","lot_id,buyer_id,weight","".$lotId.",".$bag_buyer.",".$bag."");
	}
	
	//calculating total cost and storing it.
	$totalCost = $totalWeight*($cost/100);
	$dbcall->update("lots","total_cost",$totalCost,"lot_id=".$lotId);
	
	?>
    <div class="tc bcc db wa p10"><?php if ($pending_flag == 1) { echo "Sent to pending list!"; } else { echo "Total Cost: Rs ".$totalCost." /-"; } ?></div>
    <?php
}