<?php
require_once ("../conn.php");
require_once ("../platform/escape_data.php");
require_once ("../functions/functions.php");
$bill_id = $_REQUEST['bill_id'];
$payed_to = $_REQUEST['payed_to'];
$date = date('Y-m-d');
if (!empty($payed_to) && !empty($bill_id))
{
	$db = new query;
	$db->update('farmer_bills','payed_to,payed_on',"'{$payed_to}','{$date}'", 'id='.$bill_id);
	?>
	<div align="center" class="brd_print print_pad success_notification tc" id="payed_bill" onmouseover="$('#print_button').hide();" onmouseout="$('#print_button').show();">
	    This bill has been payed to <b><?php echo ucwords($payed_to); ?></b> on <?php echo $date; ?>
	</div>
	<?php
}
?>