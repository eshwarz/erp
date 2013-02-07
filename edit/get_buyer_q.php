<?php
require("../platform/error_reporting.php");
require("../conn.php");
require_once("../platform/query.php");
require_once("../platform/escape_data.php");
$buyer = escape_data($_REQUEST['search_buyer']);
$db = new query();
$records = $db->select('*','buyers',"name LIKE '%$buyer%'",'name',0,0,50);

if ($buyer)
{
	for ($p=0;$p<count($records);$p++)
	{
		$id = $records[$p]['id'];
		?>
		<div class="hidden_link ma p5 hover_border hover_bg hover_shadow" style="width:410px;" id="remove_buyer_<?php echo $id; ?>">
			<span id="result_buyer_<?php echo $id; ?>"><?php echo ucwords($records[$p]['name']); ?></span>
			<a href="#" id="<?php echo $id; ?>" class="remove_buyer hide fr ml5">X</a>
			<a href="#" id="<?php echo $id; ?>" onclick="ajaxpage('edit/edit_buyer.php?buyer_id=<?php echo $id; ?>','lb_content'); open_lb('popup','popup_panel'); return false;" class="hide fr">Edit</a>
			<div class="cbo"></div>
		</div>
		<?php
	}
}
?>
<div id="removed_logs"></div>