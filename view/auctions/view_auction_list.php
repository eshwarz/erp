<?php
error_reporting(E_ERROR | E_PARSE);
require("../../conn.php");
require_once("../../platform/query.php");
require_once("../../platform/escape_data.php");
?>
<div class="wa bce brd_b">
    <div class="wa p10 cf tc bbg dontPrint">Auction List</div>
    <div id="result"></div>
    <div class="pt20 pb20">
        <form id="auctionListForm" class="dontPrint">
        	<table cellpadding="5" align="center">
            	<tr>
                	<td>
                    	Show by
                    </td>
                    <td>
                    	<select id="showBy" onchange="document.getElementById('auctionDate').selectedIndex=0;">
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
                    	<select id="auctionDate" onchange="ajaxPost('view/auctions/auctions.php','auctionDate,showBy','getAuctionList');">
                        	<option value="">Select Date</option>
                            <?php
							$datesArray;
							$db = new query;
							$records = $db->select("date","auction_list","","date",1,0,1000);
							for ($i=0;$i<count($records);$i++)
							{
								$dateFlag = 0;
								$date = $records[$i]['date'];
								
								for ($j=0;$j<count($datesArray);$j++)
								{
									if($date == $datesArray[$j])
									{
										$dateFlag = 1;
										break;
									}
								}
								
								if ($dateFlag == 0)
								{
									$datesArray[] = $date;
									?>
                                    <option value="<?php echo $date; ?>"><?php echo $date; ?></option>
                                    <?php
								}
							}
							?>
                        </select>
                    </td>
                </tr>
            </table>
        </form>
        
        <div id="getAuctionList"></div>
    </div>
</div>