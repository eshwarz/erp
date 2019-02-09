<?php
error_reporting(E_ERROR | E_PARSE);
require("../conn.php");
require_once("../platform/query.php");
require_once("../platform/escape_data.php");
require_once("../functions/functions.php");
$farmerId = $_REQUEST['farmerId'];
$receivedDate = $_REQUEST['date'];
$type = $_REQUEST['type'];
//creating new bill entry in the farmer_bills in case of type == new
if ($type == 'new')
{
    $bill_db = new query;
    $bill_db->insert('farmer_bills','farmer_id,date',"".$farmerId.",'".$receivedDate."'");
}

$getVillage = new query;
$getVillageRecord = $getVillage->select("village_id,name","farmers","id=".$farmerId);
$villageId = $getVillageRecord[0]["village_id"];
$farmerName = ucwords($getVillageRecord[0]["name"]);

$db = new query;
function calculateTotals ($bagsArray,$totalCostsArray,$farmerId,$date)
{
	for ($m=0;$m<count($totalCostsArray);$m++)
	{
		$netTotal = $netTotal+$totalCostsArray[$m];
	}
	for ($n=0;$n<count($bagsArray);$n++)
	{
		$bagCount = $bagCount+$bagsArray[$n];
	}
	//deductions.
	$db = new query;
	$records = $db->select("cash,commission,amali","farmer_deductions");
	
	$cashFactor = $records[0]['cash'];
	$commissionFactor = $records[0]['commission'];
	$amaliFactor = $records[0]['amali'];
	
	$cash = ($cashFactor*$netTotal)/100;						//percentage
	$commission = ($commissionFactor*$netTotal)/100;	      //percentage
	$amali = $amaliFactor*$bagCount;							//per bag
	
	$deductions = $cash+$commission+$amali;
	$grandTotal = ceil($netTotal-$deductions);

    //getting the deductions from the database to insert them into the bill.
    
    $bill_db = new query;
    $bill_records = $bill_db->select('id','farmer_bills',"farmer_id=$farmerId AND date='$date'");
    $bill_id = $bill_records[0]['id'];
    // $bill_advance = (int) $bill_records[0]['advance'];
    // $bill_freight = (int) $bill_records[0]['freight'];
    // $bill_misc = (int) $bill_records[0]['misc'];
    // $deduction_amount = $bill_advance + $bill_freight + $bill_misc;
    
    $expenses_db = new query;
    $expenses_records = $expenses_db->select('id,description,money','farmer_expenses',"bill_id=$bill_id");

    //getting credit payments for particular bills.
    $credit_db = new query;
    $credit_payment = $credit_db->select('*','farmer_credit_payments','bill_id='.$bill_id);
	?>
    <table class="bill_width">
    	<tr class="bcd brd_tds border">
            <td width="172px" class="first"></td>
        	<td width="102px"></td>
            <td width="102px" align="center"><?php echo $bagCount." Bags"; ?></td>
            <td width="102px" class="last"><?php echo "Rs ".$netTotal." /-"; ?></td>
        </tr>
    </table>
  
		
	<div class="fl bill_half_width">
    <table cellpadding="5" class="bill_width_print">
    	<tr>
        	<td class="bcd fb" colspan="2" align="center">Deductions</td>
        </tr>
    	<tr>
			<td class="fb" align="right">Cash:</td>
			<td><?php echo "Rs ".$cash." /-"; ?></td>
		</tr>
        <tr>
			<td class="fb" align="right">Commission:</td>
			<td><?php echo "Rs ".$commission." /-"; ?></td>
		</tr>
        <tr>
			<td class="fb" align="right">Hamali:</td>
			<td><?php echo "Rs ".$amali." /-"; ?></td>
		</tr>
        <tr>
			<td class="fb bcd" align="right">Total Deductions:</td>
			<td class="bcd"><?php echo "Rs ".ceil($deductions)." /-"; ?></td>
		</tr>
    </table>
  </div>
  
  <div class="fl bill_half_width">
	<table cellpadding="5" class="bill_width_print">
        <tr>
            <td class="fb bcd" colspan="2" align="center">Totals</td>
        </tr>
		<tr>
			<td class="fb">Net Total</td>
            <td><?php echo "Rs ".$netTotal." /-"; ?></td>
		</tr>
        <tr>
			<td class="fb">Total Deductions</td>
			<td><?php echo "Rs ".ceil($deductions)." /-"; ?></td>
		</tr>
        <tr>
			<td class="fb bcd brd_b">Gross Total</td>
			<td class="bcd brd_b" id="grand_total" grand_total="<?php echo $grandTotal; ?>"><?php echo "Rs ".$grandTotal." /-"; ?></td>
		</tr>
        <?php
        /*
		<tr>
			<td class="fb">Advance</td>
			<td class="tdTextBox"><input type="text" id="advance" value="<?php echo $bill_advance; ?>" onKeyUp="deduct('grandTotal','advance,freight,miscellaneous','afterAdvance');" onfocus="select_value_on_focus(this.id);" /></td>
		</tr>
		<tr>
			<td class="fb">Freight</td>
			<td class="tdTextBox"><input type="text" id="freight" value="<?php echo $bill_freight; ?>" onKeyUp="deduct('grandTotal','advance,freight,miscellaneous','afterAdvance');" onfocus="select_value_on_focus(this.id);"/></td>
		</tr>
		<tr>
			<td class="fb">Miscellaneous</td>
			<td class="tdTextBox"><input type="text" id="miscellaneous" value="<?php echo $bill_misc; ?>" onKeyUp="deduct('grandTotal','advance,freight,miscellaneous','afterAdvance');" onfocus="select_value_on_focus(this.id);" /></td>
		</tr>
        */
        ?>
        <?php
        for ($p = 0; $p < count($expenses_records); $p++)
        {
            $total_expenses += $expenses_records[$p]['money'];
            ?>
            <tr class="hidden_link" id="remove_<?php echo $expenses_records[$p]['id']; ?>">
                <td class="fb"><?php echo $expenses_records[$p]['description']; ?></td>
                <td>
                    <span class="custom_deduction"><?php echo $expenses_records[$p]['money']; ?></span>
                    <a href="#" id="<?php echo $expenses_records[$p]['id']; ?>" class="remove_expense hide">X</a>
                </td>
            </tr>
            <?php
        }
        $labourHandlingCharges = floor($netTotal / 100); // 1% of the net total
        $furtherCalculations = $grandTotal - $total_expenses - $labourHandlingCharges; 
        $afterDeduction = $grandTotal - $total_expenses - $labourHandlingCharges;
        ?>
        <input type="hidden" value="<?php echo $furtherCalculations; ?>" id="grandTotal" />
        <tr id="result_expenses" class="dontPrint">
            <td colspan="2" align="right"><a href="#" class="box_link" onclick="ajaxpage('bills/add_expense.php?bill_id=<?php echo $bill_id; ?>','lb_content'); open_lb('popup','popup_panel'); return false;">Add new expense</a></td>
        </tr>
        <tr>
            <td class="fb">Handling Charges</td>
            <td><span id="labour_handling_charges" labourHandlingCharges="<?php echo $labourHandlingCharges; ?>"><?php echo "Rs ".$labourHandlingCharges." /-"; ?></span></td>
        </tr>
		<tr>
			<td class="fb">Remaining Balance</td>
			<td><span id="afterAdvance" afterAdvance="<?php echo $afterDeduction; ?>" afterDeduction="<?php echo $afterDeduction; ?>"><?php echo "Rs ".$afterDeduction." /-"; ?></span></td>
		</tr>
        <tr id="pay_credit_link" class="dontPrint">
            <td colspan="2" align="right">
                <a href="#" class="box_link" onclick="ajaxpage('bills/pay_credit.php?farmer_id=<?php echo $farmerId; ?>&bill_id=<?php echo $bill_id; ?>','lb_content'); open_lb('popup','popup_panel'); return false;">Pay Credit or Dues?</a>
            </td>
        </tr>
        <?php
        for ($p=0;$p<count($credit_payment);$p++)
        {
            $total_credit_payment += $credit_payment[$p]['credit'];
            ?>
            <tr class="hidden_link" id="remove_credit_<?php echo $credit_payment[$p]['id']; ?>">
                <td class="fb">
                    <div class="pr">
                        <div class="pa arrange_date_tool_tip dn hide">
                            <div class="tool_tip_content fl">Payed on <?php echo $credit_payment[$p]['date']; ?></div>
                            <div class="mt10 rightArrow fl"></div>
                        </div>
                        Credit Payment
                    </div>
                    
                </td>
                <td>
                    <span class="credit_payments">
                        <?php echo $credit_payment[$p]['credit']; ?>
                    </span>
                    <a href="#" id="<?php echo $credit_payment[$p]['id']; ?>" class="remove_credit hide">X</a>
                </td>
            </tr>
            <?php
        }
        $final_bill = $afterDeduction - $total_credit_payment;
        ?>
        <span class="custom_deduction dn">0</span>
        <span class="credit_payments dn">0</span>
        <tr id="pay_credit_results" class="border">
            <td class="fb first">Cash Paid</td>
            <td class="fb last"><span id="final_bill" final_bill="<?php echo $final_bill; ?>"><?php echo "Rs ".$final_bill." /-"; ?></span></td>
        </tr>
	</table>
	</div>
    <div class="cbo"></div>
	<?php
    $f_bill = farmer_bill($bill_id);
    if (empty($f_bill['payed_to']))
    {
        ?>
        <div class="cbo mt5 dontPrint">
            <a href="#" onclick="if ($(this).html() == 'Pay this bill') {$(this).html('Pay this bill (Canel)');} else {$(this).html('Pay this bill');} $('#payed_to_form').toggle(); $('#payed_to').css({'color':'#333'}); return false;" id="payed_to_button" class="box_link p0">Pay this bill</a>
            <span id="payed_to_form" class="dn">
                <input type="text" value="" id="payed_to" style="margin-left:-5px" />
                <input type="hidden" value="<?php echo $bill_id; ?>" id="bill_id" style="margin-left:-5px" />
                <button onclick="jqAjaxForm('POST','bills/farmer_bill_paid.php','payed_to,bill_id','payed_to_result','inside');" class="button" style="padding:0px 5px;line-height:22px;margin-left:-5px;">Save</button>
            </span>
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="fr print_mt10">Bill received by <b><?php echo ucwords($f_bill['payed_to']); ?></b></div>
        <?php
    }
	$netTotal = 0;
}
?>


<div class="wa bce brd_b">
    <div class="wa p10 cf tc bbg fb dontPrint">Farmer Bill for <?php echo $farmerName; ?> (<?php echo $receivedDate; ?>)</div>
    <div class="pt20 pb20">

        <div class="p20">
        <?php
        if (!empty($receivedDate))
        {
            $excludedIds;
            //costs array and bags array for calculating the total money received by the farmer.
            $totalCosts;
            $totalBags;
            $date;
            $dateNew; //keeping trak of previous date.
            $db = new query;
            $records = $db->select("date,farmer_id,lot_id","lots","farmer_id=".$farmerId." AND date='".$receivedDate."' AND pending=0","time",1,0,1000);
            $num = "SELECT farmer_id FROM lots WHERE farmer_id=".$farmerId." AND pending=0";
            $numResult = mysql_query($num);
            $count = mysql_num_rows($numResult);
            
            for ($m=0;$m<count($records);$m++)
            {
                $excludedFlag = 0;
                
                $checkLotId = $records[$m]["lot_id"];
                for ($n=0;$n<count($excludedIds);$n++)
                {
                    if ($excludedIds[$n] == $checkLotId)
                    {
                        $excludedFlag = 1;
                    }
                }
                
                if ($excludedFlag != 1)
                {
                    $farmerId = $records[$m]["farmer_id"];
                    $date = $records[$m]["date"];
                    
                    //checking dates
                    if ($date != $dateNew && !empty($totalCosts))
                    {
                        calculateTotals($totalBags,$totalCosts,$farmerId,$receivedDate);
                        $totalCosts = NULL;
                        $totalBags = NULL;
                        echo "</div>";
                    }
                    
                    //div for center push.
                    ?>
                    <div class='pr bill_bg ma bill_width'>
                    <div class="pa dontPrint" style="top:6px;right:0px;">
                        <a id="print_button" href="#" class="button" onclick="window.print();return false;">Print Bill</a>
                    </div>
                    <?php
                    //printing farmer's details.
                    $getVillage = new query;
                    $getVillageRecord = $getVillage->select("village_id,name","farmers","id=".$farmerId);
                    $villageId = $getVillageRecord[0]["village_id"];
                    $farmerName = ucwords($getVillageRecord[0]["name"]);
                    
                    $getVillageName = $getVillage->select("village","villages","id=".$villageId);
                    $villageName = ucwords($getVillageName[0]["village"]);
                    
                    ?>
                    
                    <?php
                    $bill_db_dup = new query;
                    $bill_records = $bill_db_dup->select('id','farmer_bills',"farmer_id=$farmerId AND date='$date'");
                    $bill_id_dup = intval($bill_records[0]['id']);
                    $farmer_bill = farmer_bill($bill_id_dup);
                    // var_dump($farmer_bill);
                    ?>
                    <span id="payed_to_result">
                        <?php
                        if (!empty($farmer_bill['payed_to']))
                        {
                            ?>
                            <div align="center" class="brd_print print_pad success_notification tc" id="payed_bill" onmouseover="$('#print_button').hide();" onmouseout="$('#print_button').show();">
                                This bill has been payed to <b><?php echo ucwords($farmer_bill['payed_to']); ?></b> on <?php echo $farmer_bill['payed_on']; ?>
                            </div>
                            <?php
                        }
                        else
                        {
                            ?>
                            <div align="center" class="brd_print print_pad error_reporter tc" id="payed_bill" onmouseover="$('#print_button').hide();" onmouseout="$('#print_button').show();">
                                This bill has not been payed to anyone yet.
                            </div>
                            <?php
                        }
                        ?>
                    </span>
                    <div></div>
                    <div class="tc fb brd_b bcd p5 company_head" style="margin-top:-1px;">
                    	<?php
						$company = new query;
						$companyRecords = $company->select("name,town","company");
						$companyName = $companyRecords[0]["name"];
						$companyTown = $companyRecords[0]["town"];
						echo $companyName;
						?>
                    </div>
                    
                    <div class="p5 print_pad">
                    	<span class="fb">Farmer:</span> <?php echo $farmerName; ?>
                        <span class="fr fb">Bill no: __________</span>
                    </div>
                    <div class="p5 print_pad">
                    	<span class="fb">Village:</span> <?php echo $villageName; ?>
                        <span class="fr"><span class="fb">Date: </span><?php echo date('d-m-Y', strtotime($receivedDate)); ?></span>
                    </div>
                    <div class="print_pad"></div>
                    <table cellpadding="2" class="bill_width">
                        <tr class="brd_b bcc brd_tds">
                            <th width="170px" align="left">Cost per 100 Kgs</th>
                            <th width="100px" align="left">Total Weight</th>
                            <th width="100px">Bags</th>
                            <th width="100px" align="left">Total Cost</th>
                        </tr>
                    </table>
                    <?php
                    
                    $getFarmer = new query;
                    $farmerRecords = $getFarmer->select("farmer_id,buyer_id,lot_id,lot_number,cost,total_cost,quality,date","lots","farmer_id=".$farmerId." AND pending=0","date",0,0,1000);
                    for ($i=0;$i<count($farmerRecords);$i++)
                    {
                        $lotId = $farmerRecords[$i]["lot_id"];;
                        $buyerId = $farmerRecords[$i]["buyer_id"];
                        $qualityId = $farmerRecords[$i]["quality"];
                        $lotNumber = $farmerRecords[$i]["lot_number"];
                        $cost = $farmerRecords[$i]["cost"];
                        $totalCost = $farmerRecords[$i]["total_cost"];
                        
                        //checking date.
                        $dateNew = $farmerRecords[$i]["date"];
                        if ($date == $dateNew)
                        {
                            //array for exclusions.
                            $excludedIds[] = $lotId;
                            //costs array and bags array for calculating the total money received by the farmer.
                            $totalCosts[] = $totalCost;
                            $totalBags[] = $lotNumber;
                            //lat farmer check.
                            $lastFarmerId = $farmerId;
                            
                            //print the farmer transactions.
                            //buyer name
                            $getBuyer = new query;
                            $getBuyerName = $getBuyer->select("name,short_name","buyers","id=".$buyerId);
                            $buyerName = ucwords($getBuyerName[0]["short_name"]);
                            
                            //quality
                            $getQuality = new query;
                            $getQualityName = $getQuality->select("quality","quality","id=".$qualityId);
                            $quality = $getQualityName[0]["quality"];
                            
                            //total weight.
                            $totalWeight;
                            $getWeight = new query;
                            $weights = $getWeight->select("weight","weights","lot_id=".$lotId);
                            $individualWeights;
                            
                            for ($j=0;$j<count($weights);$j++)
                            {
                                if ($j==0)
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
                            <table cellpadding="2" class="bill_width"s>
                                <tr>
                                    <td width="172px"><?php echo "Rs ".$cost." /-"; ?></td>
                                    <td width="102px"><?php echo $totalWeight." Kgs"; ?></td>
                                    <td width="102px" align="center"><?php echo $lotNumber; ?></td>
                                    <td width="102px"><?php echo "Rs ".$totalCost." /-"; ?></td>
                                </tr>
                            </table>
                            <?php
                            $totalWeight = "";
                        }
                    }
                }
            }
            if ($count > 0)
            {
                calculateTotals($totalBags,$totalCosts,$farmerId,$receivedDate);
            }
            else
            {
                echo "<div class='tc'>No Lists found!</div>";	
            }
            echo "</div>";
        }
        ?>
        </div>
    </div>
</div>