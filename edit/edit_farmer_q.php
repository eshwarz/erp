<?php
require_once('../platform/error_reporting.php');
require_once('../conn.php');
require_once('../platform/helpers/form_helper.php');
require_once('../platform/query.php');
$farmer_id = $_REQUEST['farmer_id'];
$village_id = $_REQUEST['village_id'];
$farmer_name = $_REQUEST['farmer_name'];
$fid = $_REQUEST['fid'];
$phone = $_REQUEST['phone'];
$account = $_REQUEST['account'];
$ifsc = $_REQUEST['ifsc'];

if ($farmer_name)
{
	$db = new query($con);
	$db->update(
		'farmers',
		'village_id,name,fid,phone,account,ifsc',
		"$village_id,'$farmer_name','$fid','$phone','$account','$ifsc'",'id='.$farmer_id
	);
	echo ucwords($farmer_name);
}
?>