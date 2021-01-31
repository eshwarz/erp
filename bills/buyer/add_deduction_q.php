<?php
require_once('../../platform/error_reporting.php');
require("../../conn.php");
require_once("../../platform/query.php");
require_once("../../platform/escape_data.php");
$buyer_id = $_REQUEST['buyer_id'];
$bill_id = $_REQUEST['bill_id'];
$money = intval($_REQUEST['money']);
$description = escape_data($_REQUEST['description']);

if (!empty($money))
{
	//inserting into the farmer_credit_payments table.
	$payment_date = date('Y-m-d');
	$db = new query($con);
	$db->insert('buyer_credit_usage','buyer_id,bill_id,money,description,date',"$buyer_id,$bill_id,$money,'$description','$payment_date'");
	$deduction = $db->select('id','buyer_credit_usage',"bill_id=".$bill_id." AND money=".$money." AND date='$payment_date'",'date',1,0,1);
	?>

	<tr class="hidden_link" id="remove_deduction_<?php echo $deduction[0]['id']; ?>">
		<td class="fb" align="right" colspan="6"><?php echo $description; ?></td>
		<td align="right" style="padding-right:20px;">
			<span class="custom_deduction"><?php echo $money; ?></span>
			<a href="#" id="<?php echo $deduction[0]['id']; ?>" class="remove_deduction hide">X</a>
		</td>
	</tr>
	<script type="text/javascript">
		calculateBuyerFinalBill();
	</script>
	<?php
}
?>