<?php
error_reporting(E_ERROR | E_PARSE);
$date = $_REQUEST['weightDate'];
require("../conn.php");
require_once("../platform/query.php");
require_once("../platform/escape_data.php");
require_once("../functions/functions.php");
$db = new query($con);

$records = $db->select("*","farmer_bills","date='".$date."' and payed_to is NULL");
if (!empty($date))
{
  for ($i=0;$i<count($records);$i++)
  {
    $db = new query($con);
    $farmerRecord = $db->select("fid,name,village_id","farmers","id=".$records[$i]['farmer_id']);
    $farmerName = ucwords($farmerRecord[0]['name'])." (".$farmerRecord[0]['fid'].")";
    $villageId = $farmerRecord[0]['village_id'];
    $villageRecord = $db->select("village","villages","id=".$villageId);
    $villageName = ucwords($villageRecord[0]['village']);
    ?>
    <div class="unpaid-bills flex">
      <div>
        <?php echo $farmerName; ?>
      </div>
      <div>
        <?php echo $villageName; ?>
      </div>
    </div>
    <?php
  }
}
