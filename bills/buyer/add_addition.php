<?php
$bill_id = $_REQUEST['bill_id'];
require_once('../../platform/helpers/form_helper.php');
?>
<div class="lb_header">Add new Addition</div>
<div class="lb_message">
	<?php
		tf('','bill_id','dn','bill_id',$bill_id);
		tf('Description','description','lb_tf','description','');
		tf('Money','money','lb_tf','money','');
	?>
	<input type="button" class="button" style="margin-left:200px;" onclick="jqAjaxForm('POST','bills/buyer/add_addition_q.php','bill_id,description,money','result_additions','before'); close_lb('popup','popup_panel','lb_loader','lb_content');" value="Add Addition"/>
</div>