<?php
require_once('../platform/error_reporting.php');
require_once('../conn.php');
require_once('../platform/helpers/form_helper.php');
require_once('../platform/query.php');
$quality_id = $_REQUEST['quality_id'];
$quality = $_REQUEST['quality'];
if ($quality)
{
	$db = new query();
	$db->update('quality','quality', "'".$quality."'",'id='.$quality_id);
	echo ucwords($quality);
}
?>