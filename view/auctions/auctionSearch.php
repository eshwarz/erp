<?php 
function auctionSearch($page,$date)
{
	?>
	<table cellpadding="5" align="center">
		<tr>
			<td>
				<input type="text" value="Start typing the name" id="auctionSearch" onFocus="unfill(this.id,'Start typing the name');" onBlur="fill(this.id,'Start typing the name');" onkeyup="autofill('auctionSearch,auctionSearchDate','auctionResults','<?php echo $page; ?>');" style="width:410px;padding:5px;" />
                <input type="hidden" value="<?php echo $date; ?>" id="auctionSearchDate" />
			</td>
		</tr>
	</table>
    
    <div id="auctionResults"></div>
    <?php
}
?>