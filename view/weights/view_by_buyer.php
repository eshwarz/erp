<?php
error_reporting(E_ERROR | E_PARSE);
require("../../conn.php");
require_once("../../platform/query.php");
require_once("../../platform/escape_data.php");
require_once("../../functions/functions.php");
$settings = settings();
$searchString = escape_data($_REQUEST['weightSearch']);
$date = $_REQUEST['weightSearchDate'];
$pending = $_REQUEST['pending'];
?>
<div class="tc fb">Results for buyer &quot;<?php echo $searchString; ?>&quot;</div>

<?php
$db = new query;
$record = $db->select("name,id","buyers","name LIKE '%".$searchString."%'","name",0,0,5);

//getting buyers array comprising of searchString in their name.
$buyersArray;
for ($i=0;$i<count($record);$i++)
{
	$buyersArray[] = $record[$i]['id'];
}

//looping through lots with conditions date and buyer_id.
for ($i=0;$i<count($buyersArray);$i++)
{
	//get buyer details and print them.
	$currentBuyer = $buyersArray[$i]; // iteration.
	$buyerDb = new query;
	$buyerRecord = $buyerDb->select("name,short_name,town,email","buyers","id=".$buyersArray[$i]);
	$buyerName = ucwords($buyerRecord[0]['name']);
	$buyerShortName = ucwords($buyerRecord[0]['short_name']);
	$town = $buyerRecord[0]['town'];
	
	if ($pending == 1)
	{
		$lots = "SELECT lot_id FROM lots WHERE date='".$date."' AND buyer_id=".$currentBuyer." AND pending=1";
	}
	else
	{
		$lots = "SELECT lot_id FROM lots WHERE date='".$date."' AND buyer_id=".$currentBuyer." AND pending=0";
	}

	$lotsResult = mysql_query($lots);
	if (!$lotsResult)
	{
		die("ERR:".mysql_error());
	}
	$count = mysql_num_rows($lotsResult);
	
	
	if ($count>0)
	{
		?>
		<div class="m20 wa p10 tc bcd brd_b">Weight list dated on <?php echo "<span class='fb bc'>".$date."</span>"; ?> for <?php echo "<span class='fb bc'>".$buyerName." (".$buyerShortName.") - ".$town."</span>"; ?> are NIL
    </div>
		<table cellpadding="5" align="center">
			<tr class="brd_b bcd brd_tds">
				<?php 
				if ($settings['serial_numbers'])
				{
					?>
					<th>S No</th>
					<?php
				}
				?>
				<th>Farmer</th>
				<th>Village</th>
				<th>Quality</th>
				<th>Cost per 100 Kg</th>
				<th>Lot No</th>
				<th>Individual Weights</th>
				<th>Total Weight</th>
				<th>Total Cost</th>
				<th>Buyer(s)</th>
				<th>Edit/Delete</th>
			</tr>
			<?php
			$lotsDb = new query;
			if ($pending == 1)
			{
				$records = $lotsDb->select("*","lots","date='".$date."' AND buyer_id=".$currentBuyer."  AND pending=1");
			}
			else
			{
				$records = $lotsDb->select("*","lots","date='".$date."' AND buyer_id=".$currentBuyer."  AND pending=0");
			}
			
			for ($j=0;$j<count($records);$j++)
			{
				$quality = new query;
				$qualityRecord = $quality->select("quality","quality","id=".$records[$j]['quality']);
				$qualityName = $qualityRecord[0]['quality'];
				
				$farmer = new query;
				$farmerRecord = $farmer->select("name,village_id","farmers","id=".$records[$j]['farmer_id']);
				$farmerName = ucwords($farmerRecord[0]['name']);
				$villageId = $farmerRecord[0]['village_id'];
				
				$village = new query;
				$villageRecord = $village->select("village","villages","id=".$villageId);
				$villageName = $villageRecord[0]['village'];

				//total weight and individual weights
				$totalWeight = 0;
				$getWeight = new query;
				$weights = $getWeight->select("*","weights","lot_id=".$records[$j]['lot_id']);
				$individualWeights;
				
				for ($k=0;$k<count($weights);$k++)
				{
					if($settings['multiple_buyers'] == 1)
					{
						if ($k == 0)
							$buyerName = get_buyer_by_id($weights[$k]['buyer_id']);
						else
						$buyerName = $buyerName.'<br/>'.get_buyer_by_id($weights[$k]['buyer_id']);
					}
					if ($k == 0)
					{
						$individualWeights = $weights[$k]["weight"];
					}
					else
					{
						$individualWeights = $individualWeights.",".$weights[$k]["weight"];
					}
					$totalWeight = $totalWeight+$weights[$k]["weight"];
				}
				?>
				<tr class="hidden_link border" id="result_lot_<?php echo $records[$j]['lot_id']; ?>">
					<?php
					if ($settings['serial_numbers'])
					{
						?>
						<td class="first"><?php echo $records[$j]['serial']; ?></td>
						<td><?php echo $farmerName; ?></td>
						<?php
					}
					else
					{
						?>
						<td class="first"><?php echo $farmerName; ?></td>
						<?php
					}
					?>
					<td><?php echo $villageName; ?></td>
					<td align="center"><?php echo $qualityName; ?></td>
					<td align="center"><?php echo $records[$j]['cost']; ?></td>
					<td align="center"><?php echo $records[$j]['lot_number']; ?></td>
					<td><?php echo $individualWeights; ?></td>
					<td align="center"><?php echo $totalWeight; ?></td>
					<td align="center"><?php echo $records[$j]['total_cost']; ?></td>
					<td><?php echo $buyerName; ?></td>
					<td class="last">
						<a href="#" class="remove_lot hide" id="<?php echo $records[$j]['lot_id']; ?>">X</a>
						<a href="#" class="edit_lot hide mr5" id="" onclick="open_lb('popup','popup_panel', true, function() { ajaxpage('view/weights/edit_weight.php?id=<?php echo $records[$j]['lot_id']; ?>','lb_content'); }); return false;">Edit</a>
					</td>
				</tr>
				<?php
			}
			?>
		</table>
		<?php
	}
	else
	{
		?>
        <div class="m20 wa p10 tc bcd brd_b">Weight list dated on <?php echo "<span class='fb bc'>".$date."</span>"; ?> for <?php echo "<span class='fb bc'>".$buyerName." (".$buyerShortName.") - ".$town."</span>"; ?> are NIL
        </div>
        <?php
	}
}
?>