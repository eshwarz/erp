<div class="wa bce brd_b">
    <div class="wa p10 cf tc bbg">Edit Village</div>
    <div id="result"></div>
    <div class="pt20 pb20">
        <table cellpadding="5" align="center">
            <tr>
                <td>
                    <input type="text" id="search_village" style="width:410px;padding:5px;" onfocus="unfill(this.id,'Enter Village name');" onblur="fill(this.id,'Enter Village name');" value="Enter Village name" onkeyup="ajaxPost('edit/get_village_q.php',this.id,'get_searched_villages');return false;" />
                    <!-- <input type="hidden" value="ffff" id="dfgdsfg" /> -->
                </td>
            </tr>
        </table>
        <div id="get_searched_villages">
            
        </div>
    </div>
</div>