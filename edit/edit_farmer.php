<?php
require_once('../platform/error_reporting.php');
require_once('../conn.php');
require_once('../platform/helpers/form_helper.php');
require_once('../platform/query.php');
$farmer_id = $_REQUEST['farmer_id'];

//retrieving the previous values of the field
$db = new query($con);
$record = $db->select('*','farmers','id='.$farmer_id);
$record_village = $db->select('*','villages','id='.$record[0]['village_id']);
$village_name = $record_village[0]['village'];
$all_villages = $db->select('*','villages');
for ($p=0;$p<count($all_villages);$p++)
{
	$village_ids_array[] = $all_villages[$p]['id'];
}
for ($p=0;$p<count($all_villages);$p++)
{
	$village_names_array[] = $all_villages[$p]['village'];
}
$village_ids = implode(",", $village_ids_array);
$village_names = implode(",", $village_names_array);
$default = $record[0]['village_id'].",".$village_name;
?>
<div class="lb_header">Edit Farmer</div>
<div class="lb_message">
	<?php
		tf('','farmer_id','dn','farmer_id',$farmer_id);
		tf('Farmer Name','farmer_name','lb_tf','farmer_name',$record[0]['name']);
		select_box('Village','village_id','','village_id',"$default","$village_names","$village_ids");
	?>
	<input type="button" class="button" style="margin-left:200px;" onclick="jqAjaxForm('POST','edit/edit_farmer_q.php','farmer_id,farmer_name,village_id','result_farmer_<?php echo $farmer_id; ?>','inside'); close_lb('popup','popup_panel','lb_loader','lb_content');" value="Save Changes"/>
</div>