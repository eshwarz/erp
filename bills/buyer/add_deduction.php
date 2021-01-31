<?php
error_reporting(E_ERROR | E_PARSE);
$buyer_id = $_REQUEST['buyer_id'];
$bill_id = $_REQUEST['bill_id'];
require_once('../../platform/helpers/form_helper.php');
require_once('../../conn.php');
?>
<div class="lb_header">Add new Deduction</div>
<div class="lb_message">
	<?php
		tf('','bill_id','dn','bill_id',$bill_id);
		tf('','buyer_id','dn','buyer_id',$buyer_id);
		tf('Description','description','lb_tf','description','');
		tf('Money','money','lb_tf','money','');
	?>
	<input type="button" class="button" style="margin-left:200px;" onclick="jqAjaxForm('POST','bills/buyer/add_deduction_q.php','money,description,buyer_id,bill_id','result_deductions','before'); close_lb('popup','popup_panel','lb_loader','lb_content');" value="Add Deduction"/>
</div>