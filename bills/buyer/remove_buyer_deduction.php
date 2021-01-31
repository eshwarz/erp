<?php
require_once('../../conn.php');
require_once("../../platform/error_reporting.php");
require_once("../../platform/query.php");
$id = $_REQUEST['id'];

//getting the money for adding it to the total.
$db_get_money = new query($con);
$record = $db_get_money->select('money,buyer_id','buyer_credit_usage','id='.$id);
$buyer_id = $record[0]['buyer_id'];
$money = $record[0]['money'];
//deleting the expense from the database.
$db = new query($con);
$db->delete('buyer_credit_usage','id='.$id);
?>

<script type="text/javascript">
// calculateBuyerFinalBill();
</script>

<?php
// echo "item deleted";
?>