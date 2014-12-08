<?php
error_reporting(E_ERROR | E_PARSE);
$date = $_REQUEST['auctionDate'];
$showBy = $_REQUEST['showBy'];
require("../../conn.php");
require_once("../../platform/query.php");
require_once("../../platform/escape_data.php");
require_once("../../functions/functions.php");
require_once("auctionSearch.php");
$settings = settings();
$db = new query;
$records = $db->select("*","auction_list","date='".$date."'");

if (!empty($date))
{
	if ($showBy == "all")	//shows all the auctions of a date.
	{
		?>
		<div class="wa p10 fb tc pr print_tc">
			Auctions dated on <?php echo $date; ?>
			<div class="pa dontPrint" style="top:10px;left:225px;">
	      <a href="#" class="button" onclick="activate_auction_sorter();">Start Sorting</a>
	    </div>
			<div class="pa dontPrint" style="top:10px;right:225px;">
	      <a href="#" class="button" onclick="window.print();return false;">Print Auction list</a>
	    </div>
		</div>
		<table cellpadding="5" align="center" id="auction_sorter" class="tablesorter bill_width_print">
			<thead>
				<tr class="brd_b bcd brd_tds print_all_borders" style="cursor:pointer;">
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
					<th class="dontPrint">Edit/Delete</th>
				</tr>
			</thead>
			<?php
			for ($i=0;$i<count($records);$i++)
			{
				$farmer = new query;
				$farmerRecord = $farmer->select("name,village_id","farmers","id=".$records[$i]['farmer_id']);
				$farmerName = ucwords($farmerRecord[0]['name']);
				$villageId = $farmerRecord[0]['village_id'];
				
				$village = new query;
				$villageRecord = $farmer->select("village","villages","id=".$villageId);
				$villageName = ucwords($villageRecord[0]['village']);
				
				$quality = new query;
				$qualityRecord = $farmer->select("quality","quality","id=".$records[$i]['quality']);
				$qualityName = $qualityRecord[0]['quality'];
				
				$buyer = new query;
				$buyerRecord = $buyer->select("name","buyers","id=".$records[$i]['buyer_id']);
				$buyerName = ucwords($buyerRecord[0]['name']);
				?>
				<tr class="hidden_link print_all_borders" id="result_auction_<?php echo $records[$i]['id']; ?>">
					<?php 
					if ($settings['serial_numbers'])
					{
						?>
						<td class="first"><?php echo $records[$i]['serial']; ?></td>
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
					<td align="center"><?php echo $records[$i]['cost']; ?></td>
					<td align="center"><?php echo $records[$i]['lot_number']; ?></td>
					<td><?php echo $buyerName; ?></td>
					<td class="last dontPrint">
						<a href="#" class="remove_auction hide" id="<?php echo $records[$i]['id']; ?>">X</a>
						<a href="#" class="edit_auction hide mr5" id="" onclick="ajaxpage('view/auctions/edit_auction.php?id=<?php echo $records[$i]['id']; ?>','lb_content'); open_lb('popup','popup_panel'); return false;">Edit</a>
					</td>
				</tr>
				<?php
			}
			?>
		</table>
		<?php
	}
	else if ($showBy == "farmer")	//shows auctions of a date by farmer
	{
		auctionSearch("view/auctions/view_by_farmer.php",$date);
	}
	else if ($showBy == "buyer")
	{
		auctionSearch("view/auctions/view_by_buyer.php",$date);
	}
	else if ($showBy == "village")
	{
		auctionSearch("view/auctions/view_by_village.php",$date);
	}
}
?>
<div id="remove_logs" class="dn"></div>