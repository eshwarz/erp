<?php
error_reporting(E_ERROR | E_PARSE);
$buyerId = $_REQUEST['buyer_id'];
$date = $_REQUEST['date'];
require_once("../../conn.php");
require_once("../../platform/query.php");
require_once("../../functions/functions.php");
$type = $_REQUEST['type'];

$buyerDetails = new query;
$buyerRecord = $buyerDetails->select("name,short_name,shop,town","buyers","id=".$buyerId);

if ($type == "new")
{
	$db = new query;
	$db->insert('buyer_bills','buyer_id,date',"".$buyerId.",'".$date."'");
}
$db = new query;
$get_bill_id = $db->select('*','buyer_bills',"buyer_id=".$buyerId." AND date='".$date."'");
$bill_id = intval ($get_bill_id[0]['id']);

$buyer = buyer_details ($buyerId);
?>

<div class="wa bce brd_b">
    <div class="wa p10 cf tc bbg fb dontPrint">Buyer Bill for <?php echo $buyer['name']; ?> (<?php echo $date; ?>)</div>
    <div class="pt20 pb20">
    <div class="p20">
    <div class="ma bill_bg bill_width pr">

    <div class="pa dontPrint" style="top:6px;right:0px;">
        <a href="#" class="button" onclick="window.print();return false;">Print Bill</a>
    </div>
<?php    
if (!empty($date))
{
	$company = company_details ();
	?>

	<!-- Buyer details goes here -->
	<div class="tc fb brd_b bcd p5 company_head">
	<?php
	echo $company['name'];
	?>
	</div>

	<div class="p5 print_pad">
		<span class="fb">Bill No: _______________</span>
		<div class="fb fr tr mt5">Commodity: Tamarind</div>
	</div>

	<div class="p5 print_pad">
		<span class="fb">Buyer:</span> <?php echo $buyer['name']; ?>
	  <span class="fr"><span class="fb">Date: </span><?php echo date('d-m-Y', strtotime($date)); ?></span>
	</div>

	<div class="p5 print_pad">
		<span class="fb">Town:</span> <?php echo $buyer['town']; ?>
	</div>

	<div class="p5 print_pad">
		<span class="fb">Buyer Address: __________________________________________</span>
	</div>

	<div class="p5 print_pad">
		<span class="fb">______________________________________________________</span>
	</div>

	<div class="p5 print_pad">
		<span class="fb">______________________________________________________</span>
	</div>

	<!-- Buyer details goes here -->

	<table cellpadding="5" align="center" class="bill_width">
		<tr class="brd_b bcd brd_tds">
			<th align="left">Farmer</th>
			<th>Village</th>
			<th>Bags</th>
			<th>Quality</th>
			<th>Cost per 100 Kgs</th>
			<th>Weight</th>
			<th>Total</th>
		</tr>
		
		<?php
		$sql = "SELECT *
						FROM lots AS l
						LEFT JOIN farmers AS f ON l.farmer_id = f.id
						LEFT JOIN villages AS v ON f.village_id = v.id
						WHERE l.buyer_id = {$buyerId} AND date = '{$date}'";
		$result = mysql_query($sql);

		$records = array();
		while ($row = mysql_fetch_array($result)) {
			$records[] = $row;
		}

		$totalsArray;
		$bagsArray;
		$weightsArray;
		// $db = new query;
		// $records = $db->select("lot_id,quality,lot_number,farmer_id,cost,total_cost","lots","buyer_id=".$buyerId." AND date='".$date."'");
		
		for ($i=0;$i<count($records);$i++)
		{
			$totalsArray[] = $records[$i]['total_cost'];
			$bagsArray[] = $records[$i]['lot_number'];
			
			$totalCost = $records[$i]['total_cost'];
			$bags = $records[$i]['lot_number'];
			$village = $records[$i]['village'];
			$weightsArray[] = $weight = round(($records[$i]['total_cost']/$records[$i]['cost'])*100);
			$cost = $records[$i]['cost'];
			$dbCall = new query;
			$record = $dbCall->select("quality","quality","id=".$records[$i]['quality']);
			$quality = $record[0]['quality'];
			$record = $dbCall->select("name","farmers","id=".$records[$i]['farmer_id']);
			$farmer = ucwords($record[0]['name']);
			?>
			<tr>
				<td><?php echo $farmer; ?></td>
				<td><?php echo $village; ?></td>
				<td align="center"><?php echo $bags; ?></td>
				<td align="center"><?php echo $quality; ?></td>
				<td align="center"><?php echo $cost; ?></td>
				<td align="center"><?php echo $weight; ?></td>
				<td class="fb" align="right"><?php echo $totalCost; ?></td>
			</tr>
			<?php
		}
		
		//calculating totals.
		$netTotal = array_sum($totalsArray);
		$totalBags = array_sum($bagsArray);
		$totalWeight = array_sum($weightsArray);

		?>
		<tr class="brd_b bcd brd_tds border">
			<td class="first"></td>
			<td></td>
			<td align="center" class="fb"><?php echo $totalBags; ?></td>
			<td></td>
			<td></td>
			<td align="center" class="fb"><?php echo $totalWeight; ?></td>
			<td align="right" class="last fb"><?php echo "Rs ".$netTotal." /-"; ?></td>
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
			<td colspan="6" class="fb" align="right">Net total</td>
			<td align="right" style="padding-right:20px;"><?php echo get_float($netTotal); ?></td>
		</tr>
		<tr>
			<td colspan="6" class="fb" align="right">Association</td>
			<td align="right" style="padding-right:20px;"><?php echo $commission = get_float(($commissionFactor*$netTotal)/100); ?></td>
		</tr>
		<tr>
			<td colspan="6" class="fb" align="right">Loading</td>
			<td align="right" style="padding-right:20px;"><?php echo $loading = get_float($loadingFactor*$totalBags); ?></td>
		</tr>
		<tr>
			<td colspan="6" class="fb" align="right">Kata</td>
			<td align="right" style="padding-right:20px;"><?php echo $labour = get_float($labourFactor*$totalBags); ?></td>
		</tr>
		<tr>
			<td colspan="6" class="fb" align="right">Accountant</td>
			<td align="right" style="padding-right:20px;"><?php echo $gumastha = get_float($gumasthaFactor*$totalBags); ?></td>
		</tr>
		<tr>
			<td colspan="6" class="fb" align="right">Special Packing Charges</td>
			<td align="right" style="padding-right:20px;"><?php echo $bags = get_float($bagsFactor*$totalBags); ?></td>
		</tr>
		<tr>
			<td colspan="6" class="fb" align="right">AMC</td>
			<td align="right" style="padding-right:20px;"><?php echo $amc = get_float(($amcFactor*$netTotal)/100); ?></td>
		</tr>
		<tr>
			<td colspan="6" class="fb" align="right">Rusum</td>
			<td align="right" style="padding-right:20px;"><?php echo $rusum = get_float($rusumFactor*$totalBags); ?></td>
		</tr>
		<tr>
			<?php
			$grandTotal = $netTotal+$commission+$loading+$labour+$gumastha+$bags+$amc+$rusum;
			$grandTotal = ceil($grandTotal);
			?>
			<td colspan="6" class="fb bcd brd_b" align="right">Grand Total</td>
			<td align="right" class="bcd brd_b fb" id="grand_total" grand_total="<?php echo $grandTotal; ?>" ><?php echo "Rs ".$grandTotal." /-"; ?></td>
		</tr>
		
		<?php
		$after_additions = $grandTotal;
		// Adding additions to the billed money.
		$additions = $db->select('*','buyer_expenses','bill_id='.$bill_id);
		for ($p=0;$p<count($additions);$p++)
		{
			$add_id = $additions[$p]['id'];
			?>
			<tr class="hidden_link" id="remove_addition_<?php echo $add_id; ?>">
				<td colspan="6" align="right" class="fb"><?php echo ucwords($additions[$p]['description']); ?></td>
				<td align="right" style="padding-right:20px;">
					<span class="custom_addition"><?php echo $additions[$p]['money']; ?></span>
					<a id="<?php echo $add_id; ?>" class="remove_addition hide" href="#">X</a>
				</td>
			</tr>
			<?php
			$after_additions += $additions[$p]['money'];
		}
		?>
		
		<!-- to avoid error calculation of the final bill -->
		<div class="custom_addition dn">0</div>
		<div class="custom_deduction dn">0</div>
		<!-- to avoid error calculation of the final bill -->

		<tr id="result_additions" class="dontPrint">
			<td colspan="6" align="right">
				<a href="#" class="box_link" onclick="ajaxpage('bills/buyer/add_addition.php?buyer_id=<?php echo $buyerId; ?>&bill_id=<?php echo $bill_id; ?>','lb_content'); open_lb('popup','popup_panel'); return false;">Add new addition</a>
			</td>
		</tr>

		<tr>
			<td align="right" class="fb" colspan="6">After Additions</td>
			<td align="right" id="after_additions" after_additions="<?php echo $after_additions; ?>"><?php echo "Rs ".$after_additions." /-"; ?></td>
		</tr>

		<tr id="" class="dontPrint">
			<td colspan="6" align="right">
				<a href="#" class="box_link" onclick="ajaxpage('bills/buyer/add_deduction.php?buyer_id=<?php echo $buyerId; ?>&bill_id=<?php echo $bill_id; ?>','lb_content'); open_lb('popup','popup_panel'); return false;">Add new Deduction</a>
			</td>
		</tr>
		<?php
		// payments from the credit accounts.
		$db = new query;
		$credit_usage = $db->select('*','buyer_credit_usage','bill_id='.$bill_id);
		$after_deductions = $after_additions;
		for ($p=0;$p<count($credit_usage);$p++)
		{
			$sub_id = $credit_usage[$p]['id'];
			?>
			<tr class="hidden_link" id="remove_deduction_<?php echo $sub_id; ?>">
				<td colspan="6" align="right" class="fb"><?php echo $credit_usage[$p]['description'] ?></td>
				<td>
					<span class="custom_deduction"><?php echo $credit_usage[$p]['money']; ?></span>
					<a id="<?php echo $sub_id; ?>" class="remove_deduction hide" href="#">X</a>
				</td>
			</tr>
			<?php
			$after_deductions -= $credit_usage[$p]['money'];
		}
		?>

		<tr id="result_deductions" class="border">
			<td align="right" class="first fb" colspan="6">Final Bill</td>
			<td align="right" class="last fb" id="final_bill" final_bill="<?php echo $after_deductions; ?>"><?php echo "Rs ".$after_deductions." /-"; ?></td>
		</tr>
	</table>
  <?php
}
?>
</div>
</div>
</div>
</div>