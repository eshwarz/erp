<?php
require("../conn.php");
require_once("../platform/query.php");
require_once("../platform/escape_data.php");
$quality = escape_data($_REQUEST['quality']);
if ($quality == "Quality") $quality = "";

$checkQuality = "SELECT quality FROM quality WHERE quality='".$quality."'";
$checkQualityResult = mysql_query($checkQuality);

$count = mysql_num_rows($checkQualityResult);
if ($count<1)
{
	if ($quality == "")
	{
		?>
		<div class="tc db wa pt20 pb5"><span class="errorReporter">Quality field Cannot be Empty!</span></div>
        <?php
	}
	else
	{
		$db = new query;
		$db->insert("quality","quality","'".$quality."'");
		?>
		<div class="tc bcc db wa p10"><?php echo ucwords($quality); ?> added!</div>
		<?php
	}
}
else
{
	?>
    <div class="tc bcc db wa p10"><?php echo ucwords($quality); ?> already exists!</div>
    <?php
}
?>