<?php
require_once('../platform/error_reporting.php');
require_once('../conn.php');
require_once('../platform/helpers/form_helper.php');
require_once('../platform/query.php');
$quality_id = $_REQUEST['quality_id'];

//retrieving the previous values of the field
$db = new query;
$record = $db->select('*','quality','id='.$quality_id);
$all_qualities = $db->select('*','quality');
for ($p=0;$p<count($all_qualities);$p++)
{
	$quality_ids_array[] = $all_qualities[$p]['id'];
}
for ($p=0;$p<count($all_qualities);$p++)
{
	$quality_names_array[] = $all_qualities[$p]['village'];
}
$quality_ids = implode(",", $quality_ids_array);
$quality_names = implode(",", $quality_names_array);
$default = $record[0]['quality_id'].",".$record[0]['quality'];
?>
<div class="lb_header">Edit Quality</div>
<div class="lb_message">
	<?php
		tf('','quality_id','dn','quality_id',$quality_id);
		tf('Quality','quality','lb_tf','quality',$record[0]['quality']);
	?>
	<input type="button" class="button" style="margin-left:200px;" onclick="jqAjaxForm('POST','edit/edit_quality_q.php','quality_id,quality','result_quality_<?php echo $quality_id; ?>','inside'); close_lb('popup','popup_panel','lb_loader','lb_content');" value="Save Changes"/>
</div>