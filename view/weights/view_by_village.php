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
<div class="tc fb">Results for village &quot;<?php echo $searchString; ?>&quot;</div>

<?php
$db = new query($con);
$record = $db->select("village,id","villages","village LIKE '%".$searchString."%'","village",0,0,5);

//getting villages array comprising of searchString in their name.
$villagesArray;
for ($i=0;$i<count($record);$i++)
{
	$villagesArray[] = $record[$i]['id'];
}

//looping through lots with conditions date and village_id.

//for each village_id in the array.
for ($i=0;$i<count($villagesArray);$i++)
{
	//get village details and print them.
	$currentVillageId = $villagesArray[$i];
	$villageDb = new query($con);
	$villageRecord = $villageDb->select("village,id","villages","id=".$currentVillageId);
	$villageName = ucwords($villageRecord[0]['village']);
	
	//checking auction count for a village on particular date.
	$auctionCount = 0;
	if ($pending == 1)
	{
		$auctions = "SELECT farmer_id FROM lots WHERE date='".$date."' AND pending=1";
	}
	else
	{
		$auctions = "SELECT farmer_id FROM lots WHERE date='".$date."' AND pending=0";
	}
	$auctionsResult = mysqli_query($con, $auctions);
	while ($auctionsRow = mysqli_fetch_array($auctionsResult, MYSQLI_ASSOC))
	{
		$farmerId = $auctionsRow["farmer_id"];
		$getVillageId = "SELECT id,village_id FROM farmers WHERE id=".$farmerId;
		$getVillageIdResult = mysqli_query($con, $getVillageId);
		$getVillageIdRow = mysqli_fetch_array($getVillageIdResult, MYSQLI_ASSOC);
		$villageId = $getVillageIdRow["village_id"];
		
		if ($villageId == $currentVillageId)
		{
			$auctionCount++;
		}
	}
	if ($auctionCount>0)
	{
		?>
		<div class="m20 wa p10 tc bcd brd_b">Weight list dated on <?php echo "<span class='fb bc'>".$date."</span>"; ?> for <?php echo "<span class='fb bc'>".$villageName."</span>"; ?>
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
				<th>Cost per Kg</th>
				<th>Lot No</th>
				<th>Individual Weights</th>
				<th>Total Weight</th>
				<th>Total Cost</th>
				<th>Buyer(s)</th>
				<th>Edit/Delete</th>
			</tr>
			<?php
      //print auctions from auctions array.
      if ($pending == 1)
      {
      	$auctions = "SELECT lot_id,farmer_id FROM lots WHERE date='".$date."' AND pending=1";
      }
      else
      {
      	$auctions = "SELECT lot_id,farmer_id FROM lots WHERE date='".$date."' AND pending=0";
      }
			$auctionsResult = mysqli_query($con, $auctions);
			while ($auctionsRow = mysqli_fetch_array($auctionsResult, MYSQLI_ASSOC))
			{
				$farmerId = $auctionsRow["farmer_id"];
				$getVillageId = "SELECT id,village_id FROM farmers WHERE id=".$farmerId;
				$getVillageIdResult = mysqli_query($con, $getVillageId);
				$getVillageIdRow = mysqli_fetch_array($getVillageIdResult, MYSQLI_ASSOC);
				$villageId = $getVillageIdRow["village_id"];
				
				if ($villageId == $currentVillageId)
				{
					$currentAuction = $auctionsRow["lot_id"];
					$auctionDb = new query($con);
					$auctionRecord = $auctionDb->select("*","lots","lot_id=".$currentAuction);
					for ($k=0;$k<count($auctionRecord);$k++)
					{
						$quality = new query($con);
						$qualityRecord = $quality->select("quality","quality","id=".$auctionRecord[$k]['quality']);
						$qualityName = $qualityRecord[0]['quality'];
						
						$farmer = new query($con);
						$farmerRecord = $farmer->select("name","farmers","id=".$auctionRecord[$k]['farmer_id']);
						$farmerName = ucwords($farmerRecord[0]['name']);
						
						$buyer = new query($con);
						$buyerRecord = $buyer->select("name","buyers","id=".$auctionRecord[$k]['buyer_id']);
						$buyerName = ucwords($buyerRecord[0]['name']);
						
						//total weight and individual weights
						$totalWeight = 0;
						$getWeight = new query($con);
						$weights = $getWeight->select("*","weights","lot_id=".$currentAuction);
						$individualWeights;
						
						for ($j=0;$j<count($weights);$j++)
						{
							if($settings['multiple_buyers'] == 1)
							{
								if ($j == 0)
									$buyerName = get_buyer_by_id($weights[$j]['buyer_id']);
								else
								$buyerName = $buyerName.'<br/>'.get_buyer_by_id($weights[$j]['buyer_id']);
							}
							if ($j == 0)
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

						<tr class="hidden_link border" id="result_lot_<?php echo $currentAuction; ?>">
							<?php
							if ($settings['serial_numbers'])
							{
								?>
								<td class="first"><?php echo $auctionRecord[$k]['serial']; ?></td>
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
							<td align="center"><?php echo $auctionRecord[$k]['cost']; ?></td>
							<td align="center"><?php echo $auctionRecord[$k]['lot_number']; ?></td>
							<td><?php echo $individualWeights; ?></td>
							<td align="center"><?php echo $totalWeight; ?></td>
							<td align="center"><?php echo $auctionRecord[$k]['total_cost']; ?></td>
							<td><?php echo $buyerName; ?></td>
							<td class="last">
								<a href="#" class="remove_lot hide" id="<?php echo $currentAuction; ?>">X</a>
								<a href="#" class="edit_lot hide mr5" id="" onclick="open_lb('popup','popup_panel', true, function() { ajaxpage('view/weights/edit_weight.php?id=<?php echo $currentAuction; ?>','lb_content'); }); return false;">Edit</a>
							</td>
						</tr>
						<?php
					}
				}
			}
			?>
		</table>
        <?php
	}
	else
	{
		?>
		<div class="m20 wa p10 tc bcd brd_b">Weight list dated on <?php echo "<span class='fb bc'>".$date."</span>"; ?> for <?php echo "<span class='fb bc'>".$villageName."</span>"; ?> are NIL
		</div>
		<?php
	}
}
?>