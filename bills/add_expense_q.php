<?php
require_once('../platform/error_reporting.php');
require("../conn.php");
require_once("../platform/query.php");
require_once("../platform/escape_data.php");
$bill_id = $_REQUEST['bill_id'];

$description = escape_data($_REQUEST['description']);
$money = $_REQUEST['money'];
if (!empty($description) && !empty($money))
{
	$db = new query($con);
	$db->insert ("farmer_expenses","bill_id,description,money","$bill_id,'$description',$money");
	$get_db = new query($con);
	$get_db_record = $get_db->select('id','farmer_expenses',"description='$description' AND bill_id=$bill_id");
	?>
	<tr class="hidden_link" id="remove_<?php echo $get_db_record[0]['id']; ?>">
		<td class="fb"><?php echo $description; ?></td>
		<td>
			<span class='custom_deduction'><?php echo $money; ?></span>
			<a href="#" id="<?php echo $get_db_record[0]['id']; ?>" class="remove_expense hide">X</a>
		</td>
	</tr>

	<script type="text/javascript">
	var money = <?php echo $money; ?>;
	var afterDeductions = $('#afterAdvance').attr('afterDeduction');
	var newAfterDeductions = parseInt(afterDeductions) - money;
	var grandTotal = parseInt($('#grandTotal').attr('value'));
	$('#grandTotal').attr('value', grandTotal-money);
	$('#afterAdvance').attr('afterDeduction', newAfterDeductions);
	$('#afterAdvance').html('Rs '+newAfterDeductions+' /-')
	calculateFarmerFinalBill();
	</script>
	<?php
}
?>