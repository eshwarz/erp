<div class="wa bce brd_b">
    <div class="wa p10 cf tc bbg">Add Quality</div>
    <div id="result"></div>
    <div class="pt20 pb20">
        <form>
        	<table cellpadding="5" align="center">
            	<tr>
                	<td width="200px">New quality</td>
                    <td><input type="text" value="Quality" id="quality" onfocus="unfill(this.id,'Quality');" onblur="fill(this.id,'Quality');" /></td>
                </tr>
                <tr>
                	<td></td>
                    <td><input type="submit" class="button" value="Add Quailty" id="addQuailty" onclick="ajaxPost('new/add_quality_q.php','quality','result');return false;" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>