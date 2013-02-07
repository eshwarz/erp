<?php
error_reporting(5);
require("../../conn.php");
require_once("../../platform/query.php");
require_once("../../platform/escape_data.php");
require_once("../../functions/functions.php");
$settings = settings();
$searchString = escape_data($_REQUEST['auctionSearch']);
$date = $_REQUEST['auctionSearchDate'];
?>
<div class="tc fb">Results for farmer &quot;<?php echo $searchString; ?>&quot;</div>

<?php
$db = new query;
$record = $db->select("name,id","farmers","name LIKE '%".$searchString."%'","name",0,0,5);

//getting farmers array comprising of searchString in their name.
$farmersArray;
for ($i=0;$i<count($record);$i++)
{
	$farmersArray[] = $record[$i]['id'];
}

//looping through lots with conditions date and farmer_id.
for ($i=0;$i<count($farmersArray);$i++)
{
	//get farmer details and print them.
	$currentFarmer = $farmersArray[$i]; // iteration.
	$farmerDb = new query;
	$farmerRecord = $farmerDb->select("name,village_id","farmers","id=".$farmersArray[$i]);
	$farmerName = ucwords($farmerRecord[0]['name']);
	$villageId = $farmerRecord[0]['village_id'];
	
	$villageRecord = $farmerDb->select("village","villages","id=".$villageId);
	$villageName = ucwords($villageRecord[0]['village']);
	
	
	$auctions = "SELECT id FROM auction_list WHERE date='".$date."' AND farmer_id=".$currentFarmer;
	$auctionsResult = mysql_query($auctions);
	if (!$auctionsResult)
	{
		die("ERR:".mysql_error());
	}
	$count = mysql_num_rows($auctionsResult);
	
	
	if ($count>0)
	{
		?>
		<div class="m20 wa p10 tc bcd brd_b">Auctions dated on <?php echo "<span class='fb bc'>".$date."</span>"; ?> for <?php echo "<span class='fb bc'>".$farmerName." - ".$villageName."</span>"; ?></div>
		<table cellpadding="5" align="center">
			<tr class="brd_b bcd brd_tds">
				<?php 
				if ($settings['serial_numbers'])
				{
					?>
					<th>S No</th>
					<?php
				}?>
				<th>Farmer</th>
				<th>Village</th>
				<th>Quality</th>
				<th>Cost</th>
				<th>Lot Number</th>
				<th>Buyer</th>
				<th>Edit/Delete</th>
			</tr>
			<?php
			$auctionsDb = new query;
			$records = $auctionsDb->select("*","auction_list","date='".$date."' AND farmer_id=".$currentFarmer);
			for ($j=0;$j<count($records);$j++)
			{
				$quality = new query;
				$qualityRecord = $quality->select("quality","quality","id=".$records[$j]['quality']);
				$qualityName = $qualityRecord[0]['quality'];
				
				$buyer = new query;
				$buyerRecord = $buyer->select("name","buyers","id=".$records[$j]['buyer_id']);
				$buyerName = ucwords($buyerRecord[0]['name']);
				
				?>
				<tr class="hidden_link border" id="result_auction_<?php echo $records[$j]['id']; ?>">
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
					<td><?php echo $records[$j]['cost']; ?></td>
					<td align="center"><?php echo $records[$j]['lot_number']; ?></td>
					<td><?php echo $buyerName; ?></td>
					<td class="last">
						<a href="#" class="remove_auction hide" id="<?php echo $records[$j]['id']; ?>">X</a>
						<a href="#" class="edit_auction hide mr5" id="" onclick="ajaxpage('view/auctions/edit_auction.php?id=<?php echo $records[$j]['id']; ?>','lb_content'); open_lb('popup','popup_panel'); return false;">Edit</a>
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
        <div class="m20 wa p10 tc bcd brd_b">Auctions dated on <?php echo "<span class='fb bc'>".$date."</span>"; ?> for <?php echo "<span class='fb bc'>".$farmerName." - ".$villageName."</span>"; ?> are NIL
        </div>
        <?php
	}
}
?>