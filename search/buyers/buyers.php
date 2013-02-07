<?php
error_reporting(5);
require("../../conn.php");
require_once("../../platform/query.php");
require_once("../../platform/escape_data.php");
require_once("../../functions/functions.php");
$settings = settings();
$buyerId = $_REQUEST['buyerId'];
$db = new query;
$record = $db->select("name,town","buyers","id=".$buyerId);
?>
<div class="wa bce brd_b">
    <div class="wa p10 cf tc bbg fb">Buyer: <?php echo ucwords($record[0]['name'])." - ".ucwords($record[0]['town']); ?></div>
    <div class="pt20 pb20">
    	<table cellpadding="2" align="center" class="dn">
        	<tr>
            	<td width="200px" valign="top">Show</td>
                <td width="205px">
                	<label class="cp" onclick="if(document.getElementById('showAll').checked){document.getElementById('dateTable').style.display='none';ajaxpage('search/buyers/view_all_q.php?buyerId=<?php echo $buyerId; ?>','getResults');}"><input type="radio" name="show" id="showAll" />All</label>
                    <br/>
                    <label class="cp" onclick="if(document.getElementById('showDate').checked){document.getElementById('dateTable').style.display='block';document.getElementById('getResults').innerHTML='';}"><input type="radio" name="show" id="showDate" />Particular date</label>
                </td>
            </tr>
        </table>
        
        <div id="dateTable">
        	<table cellpadding="2" align="center">
            	<tr>
                    <td width="200px">Select Date</td>
                    <td>
                        <select id="date" onChange="ajaxPost('search/buyers/view_date_q.php','buyerId,date','getResults');">
                            <option value="">Select Date</option>
                            <?php
                            $datesArray;
                            $db = new query;
                            if ($settings['multiple_buyers'] == 1)
                            {    
                                $records = $db->select("*","lots,weights","weights.buyer_id=".$buyerId,"date",0,0,1000);
                            }
                            else
                            {
                                $records = $db->select("date","lots","buyer_id=".$buyerId,"date",1,0,1000);
                            }
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
                        <input type="hidden" value="<?php echo $buyerId; ?>" id="buyerId"/>
                    </td>
                </tr>
            </table>
        </div>
        
        <div id="getResults"></div>
        
    </div>
</div>