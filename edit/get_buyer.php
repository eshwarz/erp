<div class="wa bce brd_b">
    <div class="wa p10 cf tc bbg">Edit Buyer</div>
    <div id="result"></div>
    <div class="pt20 pb20">
        <table cellpadding="5" align="center">
            <tr>
                <td>
                    <input type="text" id="search_buyer" style="width:410px;padding:5px;" onfocus="unfill(this.id,'Enter Buyer name');" onblur="fill(this.id,'Enter Buyer name');" value="Enter Buyer name" onkeyup="ajaxPost('edit/get_buyer_q.php',this.id,'get_searched_buyers');return false;" />
                </td>
            </tr>
        </table>
        <div id="get_searched_buyers">
            
        </div>
    </div>
</div>