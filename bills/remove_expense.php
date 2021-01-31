<?php
require_once('../conn.php');
require_once("../platform/error_reporting.php");
require_once("../platform/query.php");
$id = $_REQUEST['id'];

//getting the money for adding it to the total.
$db_get_money = new query($con);
$record = $db_get_money->select('money','farmer_expenses','id='.$id);

//deleting the expense from the database.
$db = new query($con);
$db->delete('farmer_expenses','id='.$id);
?>

<script type="text/javascript">
var money = <?php echo $record[0]['money']; ?>;
var afterDeductions = $('#afterAdvance').attr('afterDeduction');
var newAfterDeductions = money + parseInt(afterDeductions);
var grandTotal = parseInt($('#grandTotal').attr('value'));
$('#grandTotal').attr('value', grandTotal+money);
$('#afterAdvance').attr('afterDeduction', newAfterDeductions);
$('#afterAdvance').html('Rs '+newAfterDeductions+' /-')
calculateFarmerFinalBill();
</script>

<?php
// echo "item deleted";
?>