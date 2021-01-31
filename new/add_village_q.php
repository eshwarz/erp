<?php
require("../conn.php");
require_once("../platform/query.php");
$village = $_REQUEST['village'];
if ($village == "Village name") $village = "";

$checkVillage = "SELECT village FROM villages WHERE village='".$village."'";
$checkVillageResult = mysqli_query($con, $checkVillage);

$count = mysql_num_rows($checkVillageResult);
if ($count<1)
{
	if ($village == "")
	{
		?>
		<div class="tc db wa pt20 pb5"><span class="errorReporter">Village field Cannot be Empty!</span></div>
        <?php
	}
	else
	{		
		$db = new query;
		$db->insert("villages","village","'".$village."'");
		?>
		<div class="tc bcc db wa p10"><?php echo ucwords($village); ?> added!</div>
		<?php
	}
}
else
{
	?>
    <div class="tc bcc db wa p10"><?php echo ucwords($village); ?> already exists!</div>
    <?php
}
?>