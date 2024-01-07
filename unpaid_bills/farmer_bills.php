<?php
error_reporting(E_ERROR | E_PARSE);
require("../../conn.php");
require_once("../../platform/query.php");
require_once("../../platform/escape_data.php");
?>
<div class="wa bce brd_b">
  <div class="wa p10 cf tc bbg dontPrint">Unpaid Farmer Bills</div>
  <div id="result"></div>
  <div class="pt20 pb20">
    <form id="auctionListForm" class="dontPrint">
      <table cellpadding="5" align="center">
        <tr>
          <td width="200px">Select Date</td>
          <td>
            <select id="weightDate" onchange="ajaxPost('unpaid_bills/farmer_bills_q.php','weightDate','getResult');">
              <option value="">Select Date</option>
              <?php
              $datesArray;
              $db = new query($con);
              $records = $db->unique_rows('date', 'lots');
              for ($i = 0; $i < count($records); $i++) {
                $date = $records[$i]['date'];
                ?>
                <option value="<?php echo $date; ?>"><?php echo $date; ?></option>
                <?php
              }
              ?>
            </select>
          </td>
        </tr>
      </table>
    </form>
    
    <div id="getResult"></div>
  </div>
</div>
