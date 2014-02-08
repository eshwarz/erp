<?php
error_reporting(5);
$buyerId = $_REQUEST['buyerId'];
$date = $_REQUEST['date'];
require_once("../../conn.php");
require_once("../../platform/query.php");
require_once("../../functions/functions.php");

$buyerDetails = new query;
$buyerRecord = $buyerDetails->select("*","buyers","id=".$buyerId);

if (!empty($date))
{
	?>
	<div class="p20">
	<?php
	/*
	?>
	<div class="fb tc p10">
		<?php echo $buyerRecord[0]['name']." (".$buyerRecord[0]['short_name'].") - ".ucwords($buyerRecord[0]['town']); ?>
	</div>
	*/

	// bill links condition goes here..
	//script for deciding whether bill is prepared already or has to be prepared...
	$bill_db = "SELECT id FROM buyer_bills WHERE date='".$date."' AND buyer_id=".$buyerId;
	$bill_db_result = mysql_query($bill_db);
	$bill_db_count = mysql_num_rows($bill_db_result);

	if ($bill_db_count == 0)
	{
		?>
		<div class="p10 bcc brd_b mt10 mb10 tc">
			Buyer Bill Dated on <span class="fb"><?php echo $date; ?></span>
			<a href="#" onclick="ajaxpage('bills/buyer/buyer_bill.php?buyer_id=<?php echo $buyerId; ?>&date=<?php echo $date; ?>&type=new','mainContent');" class="button ml10">Prepare for Bill</a>
		</div>
		<?php
	}
	else
	{
		?>
		<div class="p10 bcc brd_b mt10 mb10 tc">
			Buyer Bill Dated on <span class="fb"><?php echo $date; ?></span>
			<a href="#" onclick="ajaxpage('bills/buyer/buyer_bill.php?buyer_id=<?php echo $buyerId; ?>&date=<?php echo $date; ?>&type=edit','mainContent');" class="button ml10">Show/Edit Bill</a>
		</div>
		<?php
	}
	// bill links condition ends here
	?>
	<table cellpadding="5" align="center">
		<tr class="brd_b bcd brd_tds">
			<th>Farmer</th>
			<th>Bags</th>
			<th>Quality</th>
			<th>Cost per 100 Kgs</th>
			<th>Weight</th>
			<th>Total</th>
		</tr>
		
		<?php
		$totalsArray;
		$bagsArray;
		$db = new query;
		if ($settings['multiple_buyers'] == 1)
		{
			$records = $db->select("*","lots,weights","weights.buyer_id=".$buyerId." AND lots.date='".$date."'");
		}
		else
		{
			$records = $db->select("lot_id,quality,lot_number,farmer_id,cost,total_cost","lots","buyer_id=".$buyerId." AND date='".$date."'");
		}
		
		for ($i=0;$i<count($records);$i++)
		{
			$totalsArray[] = $records[$i]['total_cost'];
			$bagsArray[] = $records[$i]['lot_number'];
			
			$totalCost = $records[$i]['total_cost'];
			$bags = $records[$i]['lot_number'];
			$weight = round(($records[$i]['total_cost']/$records[$i]['cost'])*100);
			$cost = $records[$i]['cost'];
			$dbCall = new query;
			$record = $dbCall->select("quality","quality","id=".$records[$i]['quality']);
			$quality = $record[0]['quality'];
			$record = $dbCall->select("name","farmers","id=".$records[$i]['farmer_id']);
			$farmer = ucwords($record[0]['name']);
			?>
			<tr>
				<td><?php echo $farmer; ?></td>
				<td><?php echo $bags; ?></td>
				<td><?php echo $quality; ?></td>
				<td><?php echo $cost; ?></td>
				<td><?php echo $weight; ?></td>
				<td><?php echo $totalCost; ?></td>
			</tr>
			<?php
		}
		
		//calculating totals.
		$netTotal = 0;
		for ($j=0;$j<count($totalsArray);$j++)
		{
			$netTotal = $netTotal+$totalsArray[$j];
		}
		$totalBags = 0;
		for ($k=0;$k<count($totalsArray);$k++)
		{
			$totalBags = $totalBags+$bagsArray[$k];
		}
		?>
		<tr class="brd_b bcd brd_tds">
			<td></td>
			<td><?php echo $totalBags; ?></td>
			<td></td>
			<td></td>
			<td></td>
			<td><?php echo "Rs ".$netTotal." /-"; ?></td>
		</tr>
		<?php
		$additions = new query;
		$additionRecord = $additions->select("commission,loading,labour,	gumastha,bags,amc,rusum,gumastha_new","buyer_additions");
		$commissionFactor = $additionRecord[0]['commission'];	//percentage
		$loadingFactor = $additionRecord[0]['loading']	;				//per bag
		$labourFactor = $additionRecord[0]['labour'];					//per bag
		$gumasthaFactor = $additionRecord[0]['gumastha_new'];	//per bag
		$bagsFactor = $additionRecord[0]['bags'];						//per bag
		$amcFactor = $additionRecord[0]['amc'];							//percentage
		$rusumFactor = $additionRecord[0]['rusum'];					//per bag
		?>
		<tr>
			<td colspan="5" class="fb">Net total</td>
			<td align="right" style='padding-right:20px;'><?php echo get_float($netTotal); ?></td>
		</tr>
		<tr>
			<td colspan="5" class="fb">Commission (<?php echo $commissionFactor."%"; ?>)</td>
			<td align="right" style='padding-right:20px;'><?php echo $commission = get_float(($commissionFactor*$netTotal)/100); ?></td>
		</tr>
		<tr>
			<td colspan="5" class="fb">Loading (<?php echo "Rs ".$loadingFactor."/- per bag"; ?>)</td>
			<td align="right" style='padding-right:20px;'><?php echo $loading = get_float($loadingFactor*$totalBags); ?></td>
		</tr>
		<tr>
			<td colspan="5" class="fb">Labour (<?php echo "Rs ".$labourFactor."/- per bag"; ?>)</td>
			<td align="right" style='padding-right:20px;'><?php echo $labour = get_float($labourFactor*$totalBags); ?></td>
		</tr>
		<tr>
			<td colspan="5" class="fb">Accountant (<?php echo $gumasthaFactor."/- per bag"; ?>)</td>
			<td align="right" style='padding-right:20px;'><?php echo $gumastha = get_float($gumasthaFactor*$totalBags); ?></td>
		</tr>
		<tr>
			<td colspan="5" class="fb">Bags (<?php echo "Rs ".$bagsFactor."/- per bag"; ?>)</td>
			<td align="right" style='padding-right:20px;'><?php echo $bags = get_float($bagsFactor*$totalBags); ?></td>
		</tr>
		<tr>
			<td colspan="5" class="fb">AMC (<?php echo $amcFactor."%"; ?>)</td>
			<td align="right" style='padding-right:20px;'><?php echo $amc = get_float(($amcFactor*$netTotal)/100); ?></td>
		</tr>
		<tr>
			<td colspan="5" class="fb">Rusum (<?php echo "Rs ".$rusumFactor."/- per bag"; ?>)</td>
			<td align="right" style='padding-right:20px;'><?php echo $rusum = get_float($rusumFactor*$totalBags); ?></td>
		</tr>
        <tr>
        	<?php
			$grandTotal = $netTotal+$commission+$loading+$labour+$gumastha+$bags+$amc+$rusum;
			?>
			<td colspan="5" class="fb bcd brd_b">Grand Total</td>
			<td class="bcd brd_b"><?php echo "Rs ".$grandTotal." /-"; ?></td>
		</tr>
	</table>
	</div>
  <?php
}
//
?>