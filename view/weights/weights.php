<?php
error_reporting(5);
$date = $_REQUEST['weightDate'];
$showBy = $_REQUEST['showBy'];
require("../../conn.php");
require_once("../../platform/query.php");
require_once("../../platform/escape_data.php");
require_once("../../functions/functions.php");
require_once("weightSearch.php");
$settings = settings();
$pending = $_REQUEST['pending'];
$db = new query;

if ($pending == 1)
{
	$records = $db->select("*","lots","date='".$date."' AND pending=1");
}
else
{
	$records = $db->select("*","lots","date='".$date."' AND pending=0");
}
if (!empty($date))
{
	if ($showBy == "all")	//shows all the weights of a date.
	{
		?>
		<div class="wa p10 fb tc print_tc pr">
			<?php if ($pending == 1) { echo "Pending list dated on "; } else { echo "Weight list dated on "; } ?><?php echo $date; ?>
			<div class="pa dontPrint" style="top:10px;right:225px;">
	      <a href="#" class="button" onclick="window.print();return false;">Print Weight list</a>
	    </div>
		</div>
		<table cellpadding="5" align="center" class="bill_width_print">
			<tr class="brd_b bcd brd_tds print_all_borders">
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
				<th class="dontPrint">Edit/Delete</th>
			</tr>
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
				
				if($records[$i]['buyer_id'] != 0)
				{
					$buyer = new query;
					$buyerRecord = $buyer->select("name","buyers","id=".$records[$i]['buyer_id']);
					$buyerName = ucwords($buyerRecord[0]['name']);
				}
				else
				{
					$buyerName = '';
				}
				//total weight and individual weights (individual buyers in case)
				$totalWeight = 0;
				$getWeight = new query;
				$weights = $getWeight->select("*","weights","lot_id=".$records[$i]['lot_id']);
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
				<tr class="hidden_link print_all_borders" id="result_lot_<?php echo $records[$i]['lot_id']; ?>">
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
					<td><?php echo $individualWeights; ?></td>
					<td align="center"><?php echo $totalWeight; ?></td>
					<td align="center"><?php echo $records[$i]['total_cost'] ?></td>
					<td><?php echo $buyerName; ?></td>
					<td class="last dontPrint">
						<a href="#" class="remove_lot hide" id="<?php echo $records[$i]['lot_id']; ?>">X</a>
						<a href="#" class="edit_lot hide mr5" id="" onclick="ajaxpage('view/weights/edit_weight.php?id=<?php echo $records[$i]['lot_id']; ?>','lb_content'); open_lb('popup','popup_panel'); return false;">Edit</a>
					</td>
				</tr>
				<?php
			}
			?>
		</table>
		<?php
	}
	else if ($showBy == "farmer")	//shows weights of a date by farmer
	{
		weightSearch("view/weights/view_by_farmer.php",$date,$pending);
	}
	else if ($showBy == "buyer")
	{
		weightSearch("view/weights/view_by_buyer.php",$date,$pending);
	}
	else if ($showBy == "village")
	{
		weightSearch("view/weights/view_by_village.php",$date,$pending);
	}
}
?>
<div class="dn" id="remove_logs"></div>