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
<div class="tc fb">Results for Buyer &quot;<?php echo $searchString; ?>&quot;</div>

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
	
	$auctions = "SELECT id FROM auction_list WHERE date='".$date."' AND buyer_id=".$currentBuyer;
	$auctionsResult = mysql_query($auctions);
	$count = mysql_num_rows($auctionsResult);
	
	if ($count>0)
	{
		?>
		<div class="m20 wa p10 tc bcd brd_b">Auctions dated on <?php echo "<span class='fb bc'>".$date."</span>"; ?> for <?php echo "<span class='fb bc'>".$buyerName." (".$buyerShortName.") - ".$town."</span>"; ?></div>
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
			$records = $auctionsDb->select("*","auction_list","date='".$date."' AND buyer_id=".$currentBuyer);
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
        <div class="m20 wa p10 tc bcd brd_b">Auctions dated on <?php echo "<span class='fb bc'>".$date."</span>"; ?> for <?php echo "<span class='fb bc'>".$buyerName." (".$buyerShortName.") - ".$town."</span>"; ?> are NIL
        </div>
        <?php
	}
}
?>