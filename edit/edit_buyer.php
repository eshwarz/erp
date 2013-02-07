<?php
require_once('../platform/error_reporting.php');
require_once('../conn.php');
require_once('../platform/helpers/form_helper.php');
require_once('../platform/query.php');
require_once('../functions/functions.php');
$buyer_id = $_REQUEST['buyer_id'];

//retrieving the previous values of the field
$fields = get_fields('buyers');
$imploded_fields = implode(',',$fields);
$db = new query;
$record = $db->select('*','buyers','id='.$buyer_id);
?>
<div class="lb_header">Edit Buyer</div>
<div class="lb_message">
	<?php
	tf('','buyer_id','dn','buyer_id',$buyer_id);
	for ($p=0;$p<count($fields);$p++)
	{
		tf(humanize($fields[$p]),$fields[$p],'',$fields[$p],$record[0]["{$fields[$p]}"]);
	}
	?>
	<input type="button" class="button" style="margin-left:200px;" onclick="jqAjaxForm('POST','edit/edit_buyer_q.php','<?php echo 'buyer_id,'.$imploded_fields; ?>','result_buyer_<?php echo $buyer_id; ?>','inside'); close_lb('popup','popup_panel','lb_loader','lb_content');" value="Save Changes"/>
</div>