<?php
error_reporting(E_ERROR | E_PARSE);
require("../../conn.php");
require_once("../../platform/query.php");
require_once("../../platform/escape_data.php");
$pending = isset($_REQUEST['pending']) ? $_REQUEST['pending'] : null;
?>
<div class="wa bce brd_b">
    <div class="wa p10 cf tc bbg dontPrint"><?php if ($pending == 1) { echo 'Pending List'; } else { echo 'Weight List'; } ?></div>
    <div id="result"></div>
    <div class="pt20 pb20">
        <form id="auctionListForm" class="dontPrint">
        	<table cellpadding="5" align="center">
            	<tr>
                	<td>
                    	Show by
                    </td>
                    <td>
                    	<select id="showBy" onchange="document.getElementById('weightDate').selectedIndex=0;">
                        	<option value="all">All</option>
                            <option value="farmer">Farmer</option>
                            <option value="buyer">Buyer</option>
                            <option value="village">Village</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td width="200px">Select Date</td>
                    <td>
                        <input type="hidden" value="<?php echo $pending; ?>" id="pending" />
                    	<select id="weightDate" onchange="ajaxPost('view/weights/weights.php','weightDate,showBy,pending','getWeightList');">
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
        
        <div id="getWeightList"></div>
    </div>
</div>