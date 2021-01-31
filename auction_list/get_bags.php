<?php
$bags = $_REQUEST["lotNumber"];
?>
<table cellpadding="5" align="center">
<?php
if (!empty($bags))
{
	?>
	<tr>
		<td colspan="2" align="center" class="fb">Enter Weights</td>
	</tr>
    <?php
}

for ($m=1;$m<=$bags;$m++)
{
    ?>
    <tr>
        <td width="200px">Bag <?php echo $m; ?></td>
        <td><input type="text" id="bag<?php echo $m; ?>" value="Enter Weight" onfocus="unfill(this.id,'Enter Weight');" onblur="fill(this.id,'Enter Weight');" /></td>
    </tr>
    <?php
}
?>
</table>