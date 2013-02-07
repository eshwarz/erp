<?php
error_reporting(5);
$buyerId = $_REQUEST['buyer'];
require("../conn.php");
require_once("../platform/query.php");
?>
<table cellpadding="5" align="center">
    <form>
        <tr>
            <td width="200px">Select Date</td>
            <td>
                <select onchange="ajaxPost('view/get_buyer_receipt.php','date,buyer','receipt');" id="date">
                    <option value="">Select Date</option>
                    <!--Database call-->
                    <?php
                    $datesArray;
					$db = new query;
                    $records = $db->select("buyer_id,date","lots","buyer_id=".$buyerId,"date",0,0,1000);
					
                    for ($i=0;$i<count($records);$i++)
                    {
						$date = $records[$i]['date'];
						$dateFlag = 0;
						for ($j=0;$j<count($datesArray);$j++)
						{
							if ($date == $datesArray[$j])
							{
								$dateFlag = 1;
								break;
							}
						}
						if ($dateFlag != 1)
						{
							$datesArray[] = $date;
							$dateFlag = 0;
							?>
							<option value="<?php echo $date; ?>"><?php echo $date; ?></option>
							<?php
						}
                    }
                    ?>
                </select>
                <input type="hidden" value="<?php echo $buyerId; ?>" id="buyer" />
            </td>
        </tr>
    </form>
</table>