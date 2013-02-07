<?php
require_once('../platform/error_reporting.php');
require_once('../conn.php');
require_once('../platform/helpers/form_helper.php');
require_once('../platform/query.php');
require_once('../platform/escape_data.php');
require_once('../functions/functions.php');

//building request variables.
$fields = get_fields('buyers');
$buyer_id = $_REQUEST['buyer_id'];
$imploded_fields = implode(',',$fields);

for ($p=0;$p<count($fields);$p++)
{
	$field_values_array[] = "'".escape_data($_REQUEST["{$fields[$p]}"])."'";
}
$field_values = implode(',',$field_values_array);

if ($_REQUEST['name'] && $_REQUEST['short_name'])
{
	$db = new query();
	$db->update('buyers',"{$imploded_fields}","{$field_values}",'id='.$buyer_id);
	echo ucwords($_REQUEST['name']);
}

?>