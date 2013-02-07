<div class="wa bce brd_b">
    <div class="wa p10 cf tc bbg">Edit Quality</div>
    <div id="result"></div>
    <div class="pt20 pb20">
        <table cellpadding="5" align="center">
            <tr>
                <td>
                    <input type="text" id="search_quality" style="width:410px;padding:5px;" onfocus="unfill(this.id,'Enter Quality name');" onblur="fill(this.id,'Enter Quality name');" value="Enter Quality name" onkeyup="ajaxPost('edit/get_quality_q.php',this.id,'get_searched_quality');return false;" />
                </td>
            </tr>
        </table>
        <div id="get_searched_quality">
            
        </div>
    </div>
</div>