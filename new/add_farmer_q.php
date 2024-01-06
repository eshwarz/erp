<?php
require("../conn.php");
require_once("../platform/query.php");
require_once("../platform/escape_data.php");
$farmer = escape_data($_REQUEST['farmer']);
$phone = escape_data($_REQUEST['phone']);
$fid = escape_data($_REQUEST['fid']);
$account = escape_data($_REQUEST['account']);
$ifsc = escape_data($_REQUEST['ifsc']);
$village = $_REQUEST['village'];

if ($farmer == "Farmer\'s name") $farmer = "";

$checkFarmer = "SELECT name FROM farmers WHERE name='".$farmer."' OR fid = ".$fid;
$checkFarmerResult = mysqli_query($con, $checkFarmer);

$count = mysqli_num_rows($checkFarmerResult);
if ($count<1)
{
	if ($farmer == "" || $village == "" || $fid == "")
	{
		?>
		<div class="tc db wa pt20 pb5"><span class="errorReporter">All fields required!</span></div>
    <?php
	}
	else
	{
		$db = new query($con);
		$db->insert(
			"farmers",
			"village_id,name,fid,phone,account,ifsc",
			"".$village.",'".$farmer."',".$fid.",'".$phone."','".$account."','".$ifsc."'"
		);
		?>
		<div class="tc bcc db wa p10"><?php echo ucwords($farmer); ?> added!</div>
		<?php
	}
}
else
{
	?>
    <div class="tc bcc db wa p10"><?php echo ucwords($farmer); ?> already exists with same name or ID!</div>
    <?php
}
?>