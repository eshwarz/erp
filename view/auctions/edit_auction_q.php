<?php
require_once('../../platform/error_reporting.php');
require_once('../../conn.php');
require_once('../../platform/helpers/form_helper.php');
require_once('../../platform/query.php');
require_once('../../functions/functions.php');
require_once('../../platform/query.php');

$id = $_REQUEST['id'];
$quality = $_REQUEST['quality'];
$buyer_id = $_REQUEST['buyer_id'];
$cost = $_REQUEST['cost'];
$lot_number = $_REQUEST['lot_number'];
$values = $quality.','.$buyer_id.','.$cost.','.$lot_number;
$db = new query($con);
$db->update('auction_list',"quality,buyer_id,cost,lot_number","{$values}",'id='.$id);

$records = $db->select('*','auction_list','id='.$id);
//response is given below
?>
<td class="first"><?php echo get_farmer_by_id($records[0]['farmer_id']); ?></td>
<td><?php echo get_village_by_farmer_id($records[0]['farmer_id']); ?></td>
<td align="center"><?php echo get_quality_by_id($records[0]['quality']); ?></td>
<td><?php echo $records[0]['cost']; ?></td>
<td align="center"><?php echo $records[0]['lot_number']; ?></td>
<td><?php echo get_buyer_by_id($records[0]['buyer_id']); ?></td>
<td class="last">
	<a href="#" class="remove_auction hide" id="<?php echo $id; ?>">X</a>
	<a href="#" class="edit_auction hide mr5" id="" onclick="ajaxpage('view/auctions/edit_auction.php?id=<?php echo $id; ?>','lb_content'); open_lb('popup','popup_panel'); return false;">Edit</a>
</td>