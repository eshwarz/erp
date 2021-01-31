<?php
require_once('../platform/error_reporting.php');
require_once('../conn.php');
require_once('../platform/helpers/form_helper.php');
require_once('../platform/query.php');
$village_id = $_REQUEST['village_id'];

//retrieving the previous values of the field
$db = new query;
$record = $db->select('*','villages','id='.$village_id);
?>
<div class="lb_header">Edit Village</div>
<div class="lb_message">
	<?php
		tf('','village_id','dn','village_id',$village_id);
		tf('Village','village','lb_tf','village',$record[0]['village']);
	?>
	<input type="button" class="button" style="margin-left:200px;" onclick="jqAjaxForm('POST','edit/edit_village_q.php','village_id,village','result_village_<?php echo $village_id; ?>','inside'); close_lb('popup','popup_panel','lb_loader','lb_content');" value="Save Changes"/>
</div>