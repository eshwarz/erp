<div class="wa bce brd_b">
    <div class="wa p10 cf tc bbg">Add Village</div>
    <div id="result"></div>
    <div class="pt20 pb20">
        <form>
        	<table cellpadding="5" align="center">
            	<tr>
                	<td width="200px">Village name</td>
                    <td><input type="text" value="Village name" id="village" onfocus="unfill(this.id,'Village name');" onblur="fill(this.id,'Village name');" /></td>
                </tr>
                <tr>
                	<td></td>
                    <td><input type="submit" class="button" value="Add Village" id="addVillage" onclick="ajaxPost('new/add_village_q.php','village','result');return false;" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>