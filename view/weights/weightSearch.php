<?php 
function weightSearch($page,$date,$pending)
{
	?>
	<table cellpadding="5" align="center">
		<tr>
			<td>
				<input type="text" value="Start typing the name" id="weightSearch" onFocus="unfill(this.id,'Start typing the name');" onBlur="fill(this.id,'Start typing the name');" onkeyup="autofill('weightSearch,weightSearchDate,pending','weightResults','<?php echo $page; ?>');" style="width:410px;padding:5px;" />
        <input type="hidden" value="<?php echo $date; ?>" id="weightSearchDate" />
        <input type="hidden" value="<?php echo $pending; ?>" id="pending" />
			</td>
		</tr>
	</table>
    
    <div id="weightResults"></div>
    <?php
}
?>