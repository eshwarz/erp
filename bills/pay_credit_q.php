<?php
require_once('../platform/error_reporting.php');
require("../conn.php");
require_once("../platform/query.php");
$farmer_id = $_REQUEST['farmer_id'];
$bill_id = $_REQUEST['bill_id'];
$credit = intval($_REQUEST['credit']);


if (!empty($credit))
{
	//inserting into the farmer_credit_payments table.
	$payment_date = date('Y-m-d');
	$db = new query($con);
	$db->insert('farmer_credit_payments','farmer_id,bill_id,credit,date',"$farmer_id,$bill_id,$credit,'$payment_date'");
	$credit_payment = $db->select('id','farmer_credit_payments',"bill_id=".$bill_id." AND credit=".$credit." AND date='$payment_date'",'date',1,0,1);
	
	//counting 
	$get_db = new query($con);
	$get_db_record = $get_db->select('credit','farmer_accounts','farmer_id='.$farmer_id);
	
	if (count($get_db_record) == 0)
	{
		//inserting into the accounts (opening new account for the farmer) .
		$db = new query($con);
		$db->insert('farmer_accounts','farmer_id,credit',"$farmer_id,-$credit");
	}
	else
	{
		//updating the existing farmer account.
		$old_credit = $get_db_record[0]['credit'];
		$new_credit = $old_credit - $credit;
		$db = new query($con);
		$db->update('farmer_accounts','credit',$new_credit,'farmer_id='.$farmer_id);
	}

	?>

	<tr class="hidden_link" id="remove_credit_<?php echo $credit_payment[0]['id']; ?>">
		<td class="fb">Credit Payment</td>
		<td>
			<span class="credit_payments"><?php echo $credit; ?></span>
			<a href="#" id="<?php echo $credit_payment[0]['id']; ?>" class="remove_credit hide">X</a>
		</td>
	</tr>
	<script type="text/javascript">
		var finalBillSelector = $('#final_bill');
		// var finalBill = finalBillSelector.attr('final_bill');
		// var newFinalBill = parseInt(finalBill) - <?php echo $credit; ?>;
		// finalBillSelector.attr('final_bill', newFinalBill);
		// finalBillSelector.html('Rs '+newFinalBill+' /-');
		calculateFarmerFinalBill();
	</script>
	<?php
}
?>