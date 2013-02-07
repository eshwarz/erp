<?php
error_reporting(5);
require("../../conn.php");
require_once("../../platform/query.php");
require_once("../../platform/escape_data.php");
$farmerId = $_REQUEST['farmerId'];
$receivedDate = $_REQUEST['date'];

$db =new query;

function calculateTotals ($bagsArray,$totalCostsArray)
{
	for ($m=0;$m<count($totalCostsArray);$m++)
	{
		$netTotal = $netTotal+$totalCostsArray[$m];
	}
	for ($n=0;$n<count($bagsArray);$n++)
	{
		$bagCount = $bagCount+$bagsArray[$n];
	}
	//deductions.
	$db = new query;
	$records = $db->select("cash,commission,amali","farmer_deductions");
	
	$cashFactor = $records[0]['cash'];
	$commissionFactor = $records[0]['commission'];
	$amaliFactor = $records[0]['amali'];
	
	$cash = ($cashFactor*$netTotal)/100;						//percentage
	$commission = ($commissionFactor*$netTotal)/100;	//percentage
	$amali = $amaliFactor*$bagCount;							//per bag
	
	$deductions = $cash+$commission+$amali;
	$grandTotal = $netTotal-$deductions;
	?>
    <table>
    	<tr class="bcd brd_tds">
        	<td width="102px" align="center"><?php echo "Rs ".$netTotal." /-"; ?></td>
            <td width="102px" align="center"><?php echo $bagCount." Bags"; ?></td>
            <td width="102px"></td>
            <td width="172px"></td>
        </tr>
    </table>
    
    <div class="fl">
	<table cellpadding="5">
    	<tr>
        	<td class="fb bcd" colspan="2" align="center">Totals</td>
        </tr>
		<tr>
        	<td><?php echo "Rs ".$netTotal." /-"; ?></td>
			<td class="fb">:Net Total</td>
		</tr>
        <tr>
			<td><?php echo "Rs ".$deductions." /-"; ?></td>
            <td class="fb">:Total Deductions</td>
		</tr>
        <tr>
			<td class="bcd brd_b"><?php echo "Rs ".$grandTotal." /-"; ?></td>
            <td class="fb bcd brd_b">:Grand Total</td>
		</tr>
	</table>
	</div>
    <div class="fl">
    <table cellpadding="5">
    	<tr>
        	<td class="bcd fb" colspan="2" align="center">Deductions</td>
        </tr>
    	<tr>
			<td class="fb" align="right">Cash:</td>
			<td><?php echo "Rs ".$cash." /-"; ?></td>
		</tr>
        <tr>
			<td class="fb" align="right">Commission:</td>
			<td><?php echo "Rs ".$commission." /-"; ?></td>
		</tr>
        <tr>
			<td class="fb" align="right">Amali:</td>
			<td><?php echo "Rs ".$amali." /-"; ?></td>
		</tr>
        <tr>
			<td class="fb bcd" align="right">Total Deductions:</td>
			<td class="bcd"><?php echo "Rs ".$deductions." /-"; ?></td>
		</tr>
    </table>
    </div>
    <div class="cbo"></div>
	<?php
	$netTotal = 0;
}
?>

<div class="p20">
<?php
if (!empty($receivedDate))
{
	$excludedIds;
	//costs array and bags array for calculating the total money received by the farmer.
	$totalCosts;
	$totalBags;
	$date;
	$dateNew; //keeping trak of previous date.
	$db = new query;
	$records = $db->select("date,farmer_id,lot_id","lots","farmer_id=".$farmerId." AND date='".$receivedDate."'","time",1,0,1000);
	$num = "SELECT farmer_id FROM lots WHERE farmer_id=".$farmerId;
	$numResult = mysql_query($num);
	$count = mysql_num_rows($numResult);
	
	for ($m=0;$m<count($records);$m++)
	{
		$excludedFlag = 0;
		
		$checkLotId = $records[$m]["lot_id"];
		for ($n=0;$n<count($excludedIds);$n++)
		{
			if ($excludedIds[$n] == $checkLotId)
			{
				$excludedFlag = 1;
			}
		}
		
		if ($excludedFlag != 1)
		{
			$farmerId = $records[$m]["farmer_id"];
			$date = $records[$m]["date"];
			
			//checking dates
			if ($date != $dateNew && !empty($totalCosts))
			{
				calculateTotals($totalBags,$totalCosts);
				$totalCosts = NULL;
				$totalBags = NULL;
				echo "</div>";
			}
			?>

			<?php
			//script for deciding whether bill is prepared already or has to be prepared...
			$bill_db = "SELECT id FROM farmer_bills WHERE date='".$receivedDate."' AND farmer_id=".$farmerId;
			$bill_db_result = mysql_query($bill_db);
			$bill_db_count = mysql_num_rows($bill_db_result);

			if ($bill_db_count == 0)
			{
				?>
				<div class="p10 bcc brd_b mt10 tc">
					Farmer Bill Dated on <span class="fb"><?php echo $date; ?></span>
					<a href="#" onclick="ajaxpage('bills/farmer_bill.php?farmerId=<?php echo $farmerId; ?>&date=<?php echo $receivedDate; ?>&type=new','mainContent');" class="button ml10">Prepare for Bill</a>
				</div>
				<?php
			}
			else
			{
				?>
				<div class="p10 bcc brd_b mt10 tc">
					Farmer Bill Dated on <span class="fb"><?php echo $date; ?></span>
					<a href="#" onclick="ajaxpage('bills/farmer_bill.php?farmerId=<?php echo $farmerId; ?>&date=<?php echo $receivedDate; ?>&type=edit','mainContent');" class="button ml10">Show/Edit Bill</a>
				</div>
				<?php
			}
			//div for center push.
			echo "<div class='ma' style='width:500px;'>";
			//printing farmer's details.
			$getVillage = new query;
			$getVillageRecord = $getVillage->select("village_id,name","farmers","id=".$farmerId);
			$villageId = $getVillageRecord[0]["village_id"];
			$farmerName = ucwords($getVillageRecord[0]["name"]);
			
			$getVillageName = $getVillage->select("village","villages","id=".$villageId);
			$villageName = ucwords($getVillageName[0]["village"]);
			
			?>
			<div class="p5"><span class="fb">Farmer:</span> <?php echo $farmerName; ?></div>
			<div class="p5"><span class="fb">Village:</span> <?php echo $villageName; ?></div>
			<table cellpadding="2">
				<tr class="brd_b bcc brd_tds">
					<th width="100px">Total Cost</th>
					<th width="100px">Bags</th>
					<th width="100px">Total Weight</th>
					<th width="170px">Cost per 100 Kgs</th>
				</tr>
			</table>
			<?php
			
			$getFarmer = new query;
			$farmerRecords = $getFarmer->select("farmer_id,buyer_id,lot_id,lot_number,cost,total_cost,quality,date","lots","farmer_id=".$farmerId,"date",0,0,1000);
			for ($i=0;$i<count($farmerRecords);$i++)
			{
				$lotId = $farmerRecords[$i]["lot_id"];;
				$buyerId = $farmerRecords[$i]["buyer_id"];
				$qualityId = $farmerRecords[$i]["quality"];
				$lotNumber = $farmerRecords[$i]["lot_number"];
				$cost = $farmerRecords[$i]["cost"];
				$totalCost = $farmerRecords[$i]["total_cost"];
				
				//checking date.
				$dateNew = $farmerRecords[$i]["date"];	
				/*
				$timeArray = getdate($timestamp);
				$mdayNew = $timeArray["mday"];
				$monNew = $timeArray["mon"];
				$yearNew = $timeArray["year"];
				*/
				if ($date == $dateNew)
				{
					//array for exclusions.
					$excludedIds[] = $lotId;
					//costs array and bags array for calculating the total money received by the farmer.
					$totalCosts[] = $totalCost;
					$totalBags[] = $lotNumber;
					//lat farmer check.
					$lastFarmerId = $farmerId;
					
					//print the farmer transactions.
					//buyer name
					$getBuyer = new query;
					$getBuyerName = $getBuyer->select("name,short_name","buyers","id=".$buyerId);
					$buyerName = ucwords($getBuyerName[0]["short_name"]);
					
					//quality
					$getQuality = new query;
					$getQualityName = $getQuality->select("quality","quality","id=".$qualityId);
					$quality = $getQualityName[0]["quality"];
					
					//total weight.
					$totalWeight;
					$getWeight = new query;
					$weights = $getWeight->select("weight","weights","lot_id=".$lotId);
					$individualWeights;
					
					for ($j=0;$j<count($weights);$j++)
					{
						if ($j==0)
						{
							$individualWeights = $weights[$j]["weight"];
						}
						else
						{
							$individualWeights = $individualWeights.",".$weights[$j]["weight"];
						}
						$totalWeight = $totalWeight+$weights[$j]["weight"];
					}
					
					?>
					<table cellpadding="2">
						<tr>
							<td width="102px"><?php echo "Rs ".$totalCost." /-"; ?></td>
							<td width="102px"><?php echo $lotNumber; ?></td>
							<td width="102px"><?php echo $totalWeight." Kgs"; ?></td>
							<td width="172px"><?php echo "Rs ".$cost." /-"; ?></td>
						</tr>
					</table>
					<?php
					$totalWeight = "";
				}
			}
		}
	}
	if ($count > 0)
	{
		calculateTotals($totalBags,$totalCosts);
	}
	else
	{
		echo "<div class='tc'>No Lists found!</div>";	
	}
	echo "</div>";
}
?>
</div>