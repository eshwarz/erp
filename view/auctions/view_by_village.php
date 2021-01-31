<?php
error_reporting(E_ERROR | E_PARSE);
require("../../conn.php");
require_once("../../platform/query.php");
require_once("../../platform/escape_data.php");
require_once("../../functions/functions.php");
$settings = settings();
$searchString = escape_data($_REQUEST['auctionSearch']);
$date = $_REQUEST['auctionSearchDate'];
?>
<div class="tc fb">Results for village &quot;<?php echo $searchString; ?>&quot;</div>

<?php
$db = new query;
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
	$villageDb = new query;
	$villageRecord = $villageDb->select("village,id","villages","id=".$currentVillageId);
	$villageName = ucwords($villageRecord[0]['village']);
	
	//checking auction count for a village on particular date.
	$auctionCount = 0;
	$auctions = "SELECT farmer_id FROM auction_list WHERE date='".$date."'";
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
		<div class="m20 wa p10 tc bcd brd_b">Auctions dated on <?php echo "<span class='fb bc'>".$date."</span>"; ?> for <?php echo "<span class='fb bc'>".$villageName."</span>"; ?>
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
				<th>Cost</th>
				<th>Lot Number</th>
				<th>Buyer</th>
				<th>Edit/Delete</th>
			</tr>
			<?php
      //print auctions from auctions array.
      $auctions = "SELECT id,farmer_id FROM auction_list WHERE date='".$date."'";
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
					$currentAuction = $auctionsRow["id"];
					$auctionDb = new query;
					$auctionRecord = $auctionDb->select("*","auction_list","id=".$currentAuction);
					for ($k=0;$k<count($auctionRecord);$k++)
					{
						$quality = new query;
						$qualityRecord = $quality->select("quality","quality","id=".$auctionRecord[$k]['quality']);
						$qualityName = $qualityRecord[0]['quality'];
						
						$farmer = new query;
						$farmerRecord = $farmer->select("name","farmers","id=".$auctionRecord[$k]['farmer_id']);
						$farmerName = ucwords($farmerRecord[0]['name']);
						
						$buyer = new query;
						$buyerRecord = $buyer->select("name","buyers","id=".$auctionRecord[$k]['buyer_id']);
						$buyerName = ucwords($buyerRecord[0]['name']);
						
						?>
						<tr class="hidden_link border" id="result_auction_<?php echo $auctionsRow['id']; ?>">
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
							<td><?php echo $auctionRecord[$k]['cost']; ?></td>
							<td align="center"><?php echo $auctionRecord[$k]['lot_number']; ?></td>
							<td><?php echo $buyerName; ?></td>
							<td class="last">
								<a href="#" class="remove_auction hide" id="<?php echo $auctionsRow['id']; ?>">X</a>
								<a href="#" class="edit_auction hide mr5" id="" onclick="ajaxpage('view/auctions/edit_auction.php?id=<?php echo $auctionsRow['id']; ?>','lb_content'); open_lb('popup','popup_panel'); return false;">Edit</a>
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
		<div class="m20 wa p10 tc bcd brd_b">Auctions dated on <?php echo "<span class='fb bc'>".$date."</span>"; ?> for <?php echo "<span class='fb bc'>".$villageName."</span>"; ?> are NIL
		</div>
		<?php
	}
}
?>