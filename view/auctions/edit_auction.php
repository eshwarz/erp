<?php
require_once('../../platform/error_reporting.php');
require_once('../../conn.php');
require_once('../../platform/helpers/form_helper.php');
require_once('../../platform/query.php');
require_once('../../functions/functions.php');
$id = $_REQUEST['id'];

//retrieving fields of the tables for editing purposes.
$fields = get_fields('auction_list');
?>
<div class="lb_header">Edit Auction</div>
<div class="lb_message">
	<?php
	$db = new query();
	$records = $db->select('*','auction_list','id='.$id);
	$buyers = get_buyers_with_ids ();
	$qualities = get_qualities_with_ids();
	$farmer = get_farmer_by_id ($records[0]['farmer_id']);
	$buyer = get_buyer_by_id ($records[0]['buyer_id']);
	$default_quality = $records[0]['quality'].",".get_quality_by_id ($records[0]['quality']);
	$default_buyer = $records[0]['buyer_id'].",".get_buyer_by_id ($records[0]['buyer_id']);
	
	tf('','id','dn','id',$id);
	tf_disable('Farmer','farmer_name','','farmer_name',$farmer);
	select_box('Quality','quality','','quality',"{$default_quality}",$qualities['qualities'],$qualities['ids']);
	select_box('Buyer','buyer_id','','buyer_id',"{$default_buyer}",$buyers['names'],$buyers['ids']);
	tf('Cost','cost','','cost',$records[0]['cost']);
	tf('Lot Number','lot_number','','lot_number',$records[0]['lot_number']);
	?>
	<input type="button" class="button" style="margin-left:200px;" onclick="jqAjaxForm('POST','view/auctions/edit_auction_q.php','id,quality,buyer_id,cost,lot_number','result_auction_<?php echo $id; ?>','inside'); close_lb('popup','popup_panel','lb_loader','lb_content');" value="Save Changes" />
</div>