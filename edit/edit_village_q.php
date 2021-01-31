<?php
require_once('../platform/error_reporting.php');
require_once('../conn.php');
require_once('../platform/helpers/form_helper.php');
require_once('../platform/query.php');
$village_id = $_REQUEST['village_id'];
$village = $_REQUEST['village'];
if ($village)
{
	$db = new query();
	$db->update('villages','village',"'".$village."'",'id='.$village_id);
	echo ucwords($village);
}
?>