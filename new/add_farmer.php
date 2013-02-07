<?php
error_reporting(5);
require_once("../conn.php");
require_once("../platform/query.php");
?>
<div class="wa bce brd_b">
    <div class="wa p10 cf tc bbg">Add Farmer</div>
    <div id="result"></div>
    <div class="pt20 pb20">
        <form>
        	<table cellpadding="5" align="center">
            	<tr>
                	<td width="200px">Farmer's name</td>
                    <td><input type="text" value="Farmer's name" id="farmer" onfocus="unfill(this.id,'Farmer\'s name');" onblur="fill(this.id,'Farmer\'s name');" /></td>
                </tr>
                <tr>
                	<td>Select Village</td>
                    <td>
                    	<select name="village" id="village">
                        	<option value="">Select Anyone</option>
                            <?php
                            $db = new query;
							$recordArray = $db->select("id,village","villages","","village",0,0,1000);
							for ($m=0;$m<count($recordArray);$m++)
							{
								?>
                                <option value="<?php echo $recordArray[$m]["id"]; ?>">
                                <?php echo ucwords($recordArray[$m]["village"]); ?>
                                </option>
                                <?php
							}
							?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td></td>
                    <td><input type="submit" class="button" value="Add Farmer" id="addFarmer" onclick="ajaxPost('new/add_farmer_q.php','farmer,village','result');return false;" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>
