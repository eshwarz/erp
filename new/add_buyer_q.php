<?php
require_once('../platform/error_reporting.php');
require("../conn.php");
require_once("../platform/query.php");
$buyer = $_REQUEST['buyer'];
$shortName = $_REQUEST['shortName'];
$shop = $_REQUEST['shop'];
$street = $_REQUEST['street'];
$town = $_REQUEST['town'];
$phone = $_REQUEST['phone'];
$mobile = $_REQUEST['mobile'];
$email = $_REQUEST['email'];
$fax = $_REQUEST['fax'];
$tin = $_REQUEST['tin'];

if($buyer == "Buyer's name") $buyer = "";
if($shortName == "Short name") $shortName = "";
if($shop == "Shop name") $shop = "";
if($street == "Street") $street = "";
if($town == "Town") $town = "";
if($phone == "Phone Number") $phone = "";
if($mobile == "Mobile Number") $mobile = "";
if($email == "Email Address") $email = "";
if($fax == "Fax Number") $fax = "";
if($tin == "Tin Number") $tin = "";

$checkBuyer = "SELECT name FROM buyers WHERE name='".$buyer."'";
$checkBuyerResult = mysqli_query($con, $checkBuyer);

$count = mysql_num_rows($checkBuyerResult);
if ($count<1)
{
	if ($buyer == "" || $shortName == "")
	{
		?>
		<div class="tc db wa pt20 pb5"><span class="errorReporter">Buyers's name and Short name cannot be empty!</span></div>
		<?php
	}
	else
	{
		$db = new query;
		$db->insert("buyers","name,short_name,shop,street,town,phone,mobile,email,fax,tin","'".$buyer."','".$shortName."','".$shop."','".$street."','".$town."','".$phone."','".$mobile."','".$email."','".$fax."','".$tin."'");
		?>
		<div class="tc bcc db wa p10"><?php echo ucwords($buyer); ?> added!</div>
		<?php
	}
}
else
{
	?>
    <div class="tc bcc db wa p10"><?php echo ucwords($buyer); ?> already exists!</div>
    <?php
}
?>