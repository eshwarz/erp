<?php
error_reporting(E_ERROR | E_PARSE);
require("../conn.php");
require("../platform/query.php");
$farmerId = $_REQUEST['farmer_id'];
$db = new query($con);
$records = $db->select("village_id,id","farmers","fid=".$farmerId);
$village_id = $records[0]["village_id"];

$vRecords = $db->select("village","villages","id=".$village_id);

?>
<div id="data-farmer-id" data-farmer-id="<?php echo $records[0]['id'] ?>">
	<input type="hidden" id="village" value="<?php echo $village_id ?>" />
	<?php
		echo $vRecords[0]["village"];
	?>
</div>
