<?php
error_reporting(E_ERROR | E_PARSE);
$buyerId = $_REQUEST['buyer'];
$date = $_REQUEST['date'];
require_once("../conn.php");
require_once("../platform/query.php");

$buyerDetails = new query;
$buyerRecord = $buyerDetails->select("name,short_name,shop,town","buyers","id=".$buyerId);

if (!empty($date))
{
	?>
	<div class="fb tc p10">
		<?php echo $buyerRecord[0]['name']." (".$buyerRecord[0]['short_name'].") - ".ucwords($buyerRecord[0]['town']); ?>
	</div>
	<table cellpadding="5" align="center">
		<tr class="brd_b bcd brd_tds">
			<th>Total</th>
			<th>Quality</th>
			<th>Bags</th>
			<th>Weight</th>
			<th>Cost per 100 Kgs</th>
			<th>Farmer</th>
		</tr>
		
		<?php
		$totalsArray;
		$bagsArray;
		$db = new query;
		$records = $db->select("lot_id,quality,lot_number,farmer_id,cost,total_cost","lots","buyer_id=".$buyerId." AND date='".$date."'");
		
		for ($i=0;$i<count($records);$i++)
		{
			$totalsArray[] = $records[$i]['total_cost'];
			$bagsArray[] = $records[$i]['lot_number'];
			
			$totalCost = $records[$i]['total_cost'];
			$bags = $records[$i]['lot_number'];
			$weight = ($records[$i]['total_cost']/$records[$i]['cost'])*100;
			$cost = $records[$i]['cost'];
			$dbCall = new query;
			$record = $dbCall->select("quality","quality","id=".$records[$i]['quality']);
			$quality = $record[0]['quality'];
			$record = $dbCall->select("name","farmers","id=".$records[$i]['farmer_id']);
			$farmer = ucwords($record[0]['name']);
			?>
			<tr>
				<td><?php echo $totalCost; ?></td>
				<td><?php echo $quality; ?></td>
				<td><?php echo $bags; ?></td>
				<td><?php echo $weight; ?></td>
				<td><?php echo $cost; ?></td>
				<td><?php echo $farmer; ?></td>
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
			<td><?php echo "Rs ".$netTotal." /-"; ?></td>
			<td></td>
			<td><?php echo $totalBags; ?></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<?php
		$additions = new query;
		$additionRecord = $additions->select("commission,loading,labour,	gumastha,bags,amc,rusum,gumastha_new","buyer_additions");
		$commissionFactor = $additionRecord[0]['commission'];	//percentage
		$loadingFactor = $additionRecord[0]['loading']	;				//per bag
		$labourFactor = $additionRecord[0]['labour'];					//per bag
		$gumasthaFactor = $additionRecord[0]['gumastha_new'];	//percentage
		$bagsFactor = $additionRecord[0]['bags'];						//per bag
		$amcFactor = $additionRecord[0]['amc'];							//percentage
		$rusumFactor = $additionRecord[0]['rusum'];					//percentage
		?>
		<tr>
			<td><?php echo $netTotal; ?></td>
			<td colspan="5" class="fb">Net total</td>
		</tr>
		<tr>
			<td><?php echo $commission = ($commissionFactor*$netTotal)/100; ?></td>
			<td colspan="5" class="fb">Commission (<?php echo $commissionFactor."%"; ?>)</td>
		</tr>
		<tr>
			<td><?php echo $loading = $loadingFactor*$totalBags; ?></td>
			<td colspan="5" class="fb">Loading (<?php echo "Rs ".$loadingFactor."/- per bag"; ?>)</td>
		</tr>
		<tr>
			<td><?php echo $labour = $labourFactor*$totalBags; ?></td>
			<td colspan="5" class="fb">Labour (<?php echo "Rs ".$labourFactor."/- per bag"; ?>)</td>
		</tr>
		<tr>
			<td><?php echo $gumastha = ($gumasthaFactor*$netTotal)/100; ?></td>
			<td colspan="5" class="fb">Accountant (<?php echo $gumasthaFactor."%"; ?>)</td>
		</tr>
		<tr>
			<td><?php echo $bags = $bagsFactor*$totalBags; ?></td>
			<td colspan="5" class="fb">Bags (<?php echo "Rs ".$bagsFactor."/- per bag"; ?>)</td>
		</tr>
		<tr>
			<td><?php echo $amc = ($amcFactor*$netTotal)/100; ?></td>
			<td colspan="5" class="fb">AMC (<?php echo $amcFactor."%"; ?>)</td>
		</tr>
		<tr>
			<td><?php echo $rusum = ($rusumFactor*$netTotal)/100; ?></td>
			<td colspan="5" class="fb">Rusum (<?php echo "Rs ".$rusumFactor."/- per bag"; ?>)</td>
		</tr>
        <tr>
        	<?php
			$grandTotal = $netTotal+$commission+$loading+$labour+$gumastha+$bags+$amc+$rusum;
			?>
			<td class="bcd brd_b"><?php echo "Rs ".$grandTotal." /-"; ?></td>
			<td colspan="5" class="fb bcd brd_b">:Grand Total</td>
		</tr>
	</table>
    <?php
}
?>