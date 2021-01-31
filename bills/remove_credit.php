<?php
require_once('../conn.php');
require_once("../platform/error_reporting.php");
require_once("../platform/query.php");
$id = $_REQUEST['id'];

//getting the money for adding it to the total.
$db_get_money = new query;
$record = $db_get_money->select('credit,farmer_id','farmer_credit_payments','id='.$id);
$farmer_id = $record[0]['farmer_id'];
$credit = $record[0]['credit'];
//deleting the expense from the database.
$db = new query;
$db->delete('farmer_credit_payments','id='.$id);

//updating the existing farmer account.
$get_db = new query;
$get_db_record = $get_db->select('credit','farmer_accounts','farmer_id='.$farmer_id);

$old_credit = $get_db_record[0]['credit'];
$new_credit = $old_credit + $credit;
$db = new query;
$db->update('farmer_accounts','credit',$new_credit,'farmer_id='.$farmer_id);
?>

<script type="text/javascript">
var removeId = <?php echo $id; ?>;
$('#remove_credit_'+removeId).remove();
var money = <?php echo $record[0]['credit']; ?>;
var finalBill = parseInt($('#finall_bill').attr('finall_bill'));
var newFinalBill = finalBill - money;
$('#finall_bill').attr('finall_bill', newFinalBill);
$('#finall_bill').html('Rs '+newFinalBill+' /-')
calculateFarmerFinalBill();
</script>

<?php
// echo "item deleted";
?>