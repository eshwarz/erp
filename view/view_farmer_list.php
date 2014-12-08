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
error_reporting(E_ERROR | E_PARSE);
require("../conn.php");
require("../platform/query.php");
?>

<div class="wa bce brd_b">
    <div class="wa p10 cf tc bbg">Farmer List</div>
    <div class="pt20 pb20">
    	<div class="m20">
     	
        <table cellpadding="5" align="center">
        	<form>
            	<tr>
                	<td width="200px">Select Farmer</td>
                    <td>
                    	<select onchange="ajaxPost('search/farmers/farmers.php',this.id,'mainContent');" id="farmerId">
                        	<option value="">Select Farmer</option>
                            <!--Database call-->
                            <?php
              							$db = new query;
              							$records = $db->select("*","farmers");
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