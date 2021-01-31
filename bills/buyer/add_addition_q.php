<?php
require_once('../../platform/error_reporting.php');
require("../../conn.php");
require_once("../../platform/query.php");
require_once("../../platform/escape_data.php");
$bill_id = $_REQUEST['bill_id'];

$description = escape_data($_REQUEST['description']);
$money = $_REQUEST['money'];
if (!empty($description) && !empty($money))
{
	$db = new query;
	$db->insert ("buyer_expenses","bill_id,description,money","$bill_id,'$description',$money");
	$get_db = new query;
	$get_db_record = $get_db->select('id','buyer_expenses',"description='$description' AND bill_id=$bill_id");
	?>
	<tr class="hidden_link" id="remove_addition_<?php echo $get_db_record[0]['id']; ?>">
		<td class="fb" colspan="6" align="right"><?php echo ucwords($description); ?></td>
		<td align="right" style="padding-right:20px;">
			<span class='custom_addition'><?php echo $money; ?></span>
			<a href="#" id="<?php echo $get_db_record[0]['id']; ?>" class="remove_addition hide">X</a>
		</td>
	</tr>

	<script type="text/javascript">
	calculateBuyerFinalBill();
	</script>
	<?php
}
?>