<div class="wa bce brd_b">
    <div class="wa p10 cf tc bbg">Edit Farmer</div>
    <div id="result"></div>
    <div class="pt20 pb20">
        <table cellpadding="5" align="center">
            <tr>
                <td>
                    <input type="text" id="search_farmer" style="width:410px;padding:5px;" onfocus="unfill(this.id,'Enter Farmer name');" onblur="fill(this.id,'Enter Farmer name');" value="Enter Farmer name" onkeyup="ajaxPost('edit/get_farmer_q.php',this.id,'get_searched_farmers');return false;" />
                </td>
            </tr>
        </table>
        <div id="get_searched_farmers">
            
        </div>
    </div>
</div>