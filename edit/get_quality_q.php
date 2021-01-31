<?php
require("../platform/error_reporting.php");
require("../conn.php");
require_once("../platform/query.php");
require_once("../platform/escape_data.php");
$quality = escape_data($_REQUEST['search_quality']);
$db = new query();
$records = $db->select('*','quality',"quality LIKE '%$quality%'",'quality',0,0,10);

if ($quality)
{
	for ($p=0;$p<count($records);$p++)
	{
		$id = $records[$p]['id'];
		?>
		<div class="hidden_link ma p5 hover_border hover_bg hover_shadow" style="width:410px;" id="remove_quality_<?php echo $id; ?>">
			<span id="result_quality_<?php echo $id; ?>"><?php echo ucwords($records[$p]['quality']); ?></span>
			<a href="#" id="<?php echo $id; ?>" class="remove_quality hide fr ml5">X</a>
			<a href="#" id="<?php echo $id; ?>" onclick="ajaxpage('edit/edit_quality.php?quality_id=<?php echo $id; ?>','lb_content'); open_lb('popup','popup_panel'); return false;" class="hide fr">Edit</a>
			<div class="cbo"></div>
		</div>
		<?php
	}
}
?>
<div id="removed_logs"></div>