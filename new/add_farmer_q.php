<?php
require("../conn.php");
require_once("../platform/query.php");
require_once("../platform/escape_data.php");
$farmer = escape_data($_REQUEST['farmer']);
$village = $_REQUEST['village'];

if ($farmer == "Farmer\'s name") $farmer = "";

$checkFarmer = "SELECT name FROM farmers WHERE name='".$farmer."'";
$checkFarmerResult = mysqli_query($con, $checkFarmer);

$count = mysqli_num_rows($checkFarmerResult);
if ($count<1)
{
	if ($farmer == "" || $village == "")
	{
		?>
		<div class="tc db wa pt20 pb5"><span class="errorReporter">All fields required!</span></div>
    <?php
	}
	else
	{
		$db = new query($con);
		$db->insert("farmers","village_id,name","".$village.",'".$farmer."'");
		?>
		<div class="tc bcc db wa p10"><?php echo ucwords($farmer); ?> added!</div>
		<?php
	}
}
else
{
	?>
    <div class="tc bcc db wa p10"><?php echo ucwords($farmer); ?> already exists!</div>
    <?php
}
?>