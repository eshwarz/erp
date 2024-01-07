<?php
error_reporting(E_ERROR | E_PARSE);
$date = $_REQUEST['weightDate'];
require("../conn.php");
require_once("../platform/query.php");
require_once("../platform/escape_data.php");
require_once("../functions/functions.php");
$db = new query($con);

$records = $db->select("*","farmer_bills","date='".$date."' and payed_to is NULL");
?>
<input type="hidden" value="" id="farmerId" />
<input type="hidden" value="<?php echo $date ?>" id="date" />
<?php

if (!empty($date))
{
  ?>
  <table cellpadding="5" align="center" class="bill_width_print" width="50%">
    <tr class="brd_b bcd brd_tds print_all_borders">
      <th>Farmer</th>
      <th>Village</th>
      <th>To be Paid</th>
    </tr>
  <?php
  for ($i=0;$i<count($records);$i++)
  {
    $farmerRecord = $db->select("fid,name,village_id","farmers","id=".$records[$i]['farmer_id']);
    $farmerName = ucwords($farmerRecord[0]['name'])." (".$farmerRecord[0]['fid'].")";

    if (!is_null($farmerRecord)) {
      $villageId = $farmerRecord[0]['village_id'];
      $villageRecord = $db->select("village","villages","id=".$villageId);
      $villageName = ucwords($villageRecord[0]['village']);
      if (!is_null($villageRecord)) {
        ?>
        <tr class="brd_b print_all_borders">
          <td><?php echo $farmerName; ?></td>
          <td><?php echo $villageName; ?></td>
          <td>
            <a href="#" onclick="openFarmerBill(<?php echo $records[$i]['farmer_id'] ?>); return false;">Show bill</a>
          </td>
        </tr>
        <?php
      }
    }
  }
  ?>
  </table>
  <?php
}
