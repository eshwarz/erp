<?php
error_reporting(E_ERROR | E_PARSE);
require_once("../conn.php");
require_once("../platform/query.php");
?>
<div class="wa bce brd_b">
    <div class="wa p10 cf tc bbg">Add Buyer</div>
    <div id="result"></div>
    <div class="pt20 pb20">
        <form>
        	<table cellpadding="5" align="center">
            	<tr>
                	<td width="200px">Buyer's name</td>
                    <td><input type="text" value="Buyer's name" id="buyer" onfocus="unfill(this.id,'Buyer\'s name');" onblur="fill(this.id,'Buyer\'s name');" /></td>
                </tr>
                <tr>
                	<td>Short name</td>
                    <td>
                    	<input type="text" value="Short name" id="shortName" onfocus="unfill(this.id,'Short name');" onblur="fill(this.id,'Short name');" />
                    </td>
                </tr>
                <tr>
                	<td>Shop name</td>
                    <td>
                    	<input type="text" value="Shop name" id="shop" onfocus="unfill(this.id,'Shop name');" onblur="fill(this.id,'Shop name');" />
                    </td>
                </tr>
                <tr>
                	<td>Street</td>
                    <td>
                    	<input type="text" value="Street" id="street" onfocus="unfill(this.id,'Street');" onblur="fill(this.id,'Street');" />
                    </td>
                </tr>
                <tr>
                	<td>Town</td>
                    <td>
                    	<input type="text" value="Town" id="town" onfocus="unfill(this.id,'Town');" onblur="fill(this.id,'Town');" />
                    </td>
                </tr>
                <tr>
                	<td>Phone Number</td>
                    <td>
                    	<input type="text" value="Phone Number" id="phone" onfocus="unfill(this.id,'Phone Number');" onblur="fill(this.id,'Phone Number');" />
                    </td>
                </tr>
                <tr>
                	<td>Mobile Number</td>
                    <td>
                    	<input type="text" value="Mobile Number" id="mobile" onfocus="unfill(this.id,'Mobile Number');" onblur="fill(this.id,'Mobile Number');" />
                    </td>
                </tr>
                <tr>
                	<td>Email Address</td>
                    <td>
                    	<input type="text" value="Email Address" id="email" onfocus="unfill(this.id,'Email Address');" onblur="fill(this.id,'Email Address');" />
                    </td>
                </tr>
                <tr>
                	<td>Fax Number</td>
                    <td>
                    	<input type="text" value="Fax Number" id="fax" onfocus="unfill(this.id,'Fax Number');" onblur="fill(this.id,'Fax Number');" />
                    </td>
                </tr>
                <tr>
                	<td>Tin Number</td>
                    <td>
                    	<input type="text" value="Tin Number" id="tin" onfocus="unfill(this.id,'Tin Number');" onblur="fill(this.id,'Tin Number');" />
                    </td>
                </tr>
                <tr>
                	<td></td>
                    <td><input type="submit" class="button" value="Add Buyer" id="addBuyer" onclick="ajaxPost('new/add_buyer_q.php','buyer,shortName,shop,street,town,phone,mobile,email,fax,tin','result');return false;" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>