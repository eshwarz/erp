<?php
$farmer_id = $_REQUEST['farmer_id'];
$bill_id = $_REQUEST['bill_id'];
require_once('../platform/helpers/form_helper.php');
require_once('../conn.php');
?>
<div class="lb_header">Pay Credit</div>
<div class="lb_message">
	<?php
		tf('','bill_id','dn','bill_id',$bill_id);
		tf('','farmer_id','dn','farmer_id',$farmer_id);
		tf('Credit','credit','lb_tf','credit','');
	?>
	<input type="button" class="button" style="margin-left:200px;" onclick="jqAjaxForm('POST','bills/pay_credit_q.php','credit,farmer_id,bill_id','pay_credit_results','before'); close_lb('popup','popup_panel','lb_loader','lb_content');" value="Pay Credit"/>
</div>