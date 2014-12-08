<?php
error_reporting(E_ERROR | E_PARSE);
require("../../conn.php");
require_once("../../platform/query.php");
require_once("../../platform/escape_data.php");
$farmerId = $_REQUEST['farmerId'];
$db = new query;
$record = $db->select("name,village_id","farmers","id=".$farmerId);
$villageId = $record[0]['village_id'];
$villageRecord = $db->select("village","villages","id=".$villageId);
?>
<div class="wa bce brd_b">
    <div class="wa p10 cf tc bbg fb">Farmer: <?php echo ucwords($record[0]['name'])." - ".ucwords($villageRecord[0]['village']); ?></div>
    <div class="pt20 pb20">
    	<table cellpadding="2" align="center">
        	<tr>
            	<td width="200px" valign="top">Show</td>
                <td width="205px">
                	<label class="cp" onclick="if(document.getElementById('showAll').checked){document.getElementById('dateTable').style.display='none';ajaxpage('search/farmers/view_all_q.php?farmerId=<?php echo $farmerId; ?>','getResults');}"><input type="radio" name="show" id="showAll" />All</label>
                    <br/>
                    <label class="cp" onclick="if(document.getElementById('showDate').checked){document.getElementById('dateTable').style.display='block';document.getElementById('getResults').innerHTML='';}"><input type="radio" name="show" id="showDate" />Particular date</label>
                </td>
            </tr>
        </table>
        
        <div id="dateTable" class="dn">
        	<table cellpadding="2" align="center">
            	<tr>
                    <td width="200px">Select Date</td>
                    <td>
                        <select id="date" onChange="ajaxPost('search/farmers/view_date_q.php','farmerId,date','getResults');">
                            <option value="">Select Date</option>
                            <?php
                            $datesArray;
                            $db = new query;
                            $records = $db->select("date","lots","farmer_id=".$farmerId,"date",0,0,1000);
                            
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
                        <input type="hidden" value="<?php echo $farmerId; ?>" id="farmerId"/>
                    </td>
                </tr>
            </table>
        </div>
        
        <div id="getResults"></div>
        
    </div>
</div>