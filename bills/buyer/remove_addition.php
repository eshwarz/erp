<?php
require_once('../../conn.php');
require_once("../../platform/error_reporting.php");
require_once("../../platform/query.php");
$id = $_REQUEST['id'];

//getting the money for adding it to the total.
$db_get_money = new query;
$record = $db_get_money->select('money','buyer_expenses','id='.$id);

//deleting the expense from the database.
$db = new query;
$db->delete('buyer_expenses','id='.$id);
?>

<script type="text/javascript">
// calculateBuyerFinalBill();
</script>

<?php
// echo "item deleted";
?>