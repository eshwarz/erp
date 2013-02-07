<?php
/*
array
  'seconds' => int 33
  'minutes' => int 38
  'hours' => int 11
  'mday' => int 20
  'wday' => int 3
  'mon' => int 7
  'year' => int 2011
  'yday' => int 200
  'weekday' => string 'Wednesday' (length=9)
  'month' => string 'July' (length=4)
  0 => int 1311161913
*/
error_reporting(5);
require("../conn.php");
require("../platform/query.php");
?>

<div class="wa bce brd_b">
    <div class="wa p10 cf tc bbg">Buyer List</div>
    <div class="pt20 pb20">
    	<div class="m20">
     	
        <table cellpadding="5" align="center">
        	<form>
            	<tr>
                	<td width="200px">Select Buyer</td>
                    <td>
                    	<select onchange="ajaxPost('search/buyers/buyers.php',this.id,'mainContent');" id="buyerId">
                        	<option value="">Select Buyer</option>
                            <!--Database call-->
                            <?php
							$db = new query;
							$records = $db->select("id,name,short_name","buyers");
							for ($i=0;$i<count($records);$i++)
							{
								?>
                                <option value="<?php echo $records[$i]['id']; ?>"><?php echo ucwords($records[$i]['name']); ?></option>
                                <?php
							}
							?>
                        </select>
                    </td>
                </tr>
            </form>
        </table>
        
        <div id="dates"></div>
        <div id="receipt" class="print"></div>
        
        </div>
    </div>
</div>