<?php
error_reporting(E_ERROR | E_PARSE);
include_once('../platform/query.php');
include('../conn.php');

function calculateDate ()
{
	$time_format = 'Y-m-d';
	$current_date = getdate(time());
	$day = $current_date["weekday"];
	if ($day == "Friday")
	{
		$output_date = date('Y-m-d');
	}
	else if ($day == "Saturday")
	{
		$output_date = gmdate($time_format,((time() - (24*60*60)) +(5.5*60*60)));
	}
	else if ($day == "Sunday")
	{
		$output_date = gmdate($time_format,((time() - (2*24*60*60)) +(5.5*60*60)));
	}
	else if ($day == "Monday")
	{
		$output_date = gmdate($time_format,((time() - (3*24*60*60)) +(5.5*60*60)));
	}
	else if ($day == "Tuesday")
	{
		$output_date = gmdate($time_format,((time() - (4*24*60*60)) +(5.5*60*60)));
	}
	else if ($day == "Wednesday")
	{
		$output_date = gmdate($time_format,((time() - (5*24*60*60)) +(5.5*60*60)));
	}
	else if ($day == "Thursday")
	{
		$output_date = gmdate($time_format,((time() - (6*24*60*60)) +(5.5*60*60)));
	}

	return $output_date;
}

function humanize ($str)
{
	$str = trim(strtolower($str));
	$str = preg_replace('/[^a-z0-9\s+]/', ' ', $str);
	$str = ucwords($str);
	return $str;
}

function get_fields ($table)
{
	$fields;
	$get_fields = mysqli_query($GLOBALS['con'], "SHOW FIELDS FROM ".$table);
	while ($row = mysqli_fetch_row($get_fields))
	{
		if ($row[0] == 'id')
			continue;
		else
			$fields[] = $row[0];
	}
	return $fields;
}

function get_farmers_with_ids ()
{
	$get_farmers = "SELECT id,name FROM farmers ORDER BY name";
	$get_farmers_result = mysqli_query($GLOBALS['con'], $get_farmers);
	while ($row = mysqli_fetch_array($get_farmers_result, MYSQLI_ASSOC))
	{
		$ids[] = $row['id'];
		$names[] = $row['name'];
	}
	return array('ids' => $ids, 'names' => $names);
}

function get_farmer_by_id ($id)
{
	$get_farmers = "SELECT name FROM farmers WHERE id=".$id;
	$get_farmers_result = mysqli_query($GLOBALS['con'], $get_farmers);
	$row = mysqli_fetch_array($get_farmers_result, MYSQLI_ASSOC);
	return ucwords($row['name']);
}

function get_buyers_with_ids ()
{
	$get_buyers = "SELECT id,name FROM buyers ORDER BY name";
	$get_buyers_result = mysqli_query($GLOBALS['con'], $get_buyers);
	while ($row = mysqli_fetch_array($get_buyers_result, MYSQLI_ASSOC))
	{
		$ids[] = $row['id'];
		$names[] = $row['name'];
	}
	return array('ids' => $ids, 'names' => $names);
}

function get_buyer_by_id ($id)
{
	$get_buyers = "SELECT name FROM buyers WHERE id=".$id;
	$get_buyers_result = mysqli_query($GLOBALS['con'], $get_buyers);
	$row = mysqli_fetch_array($get_buyers_result, MYSQLI_ASSOC);
	return ucwords($row['name']);
}

function get_qualities_with_ids ()
{
	$get_quality = "SELECT id,quality FROM quality";
	$get_quality_result = mysqli_query($GLOBALS['con'], $get_quality);
	while ($row = mysqli_fetch_array($get_quality_result, MYSQLI_ASSOC))
	{
		$ids[] = $row['id'];
		$qualities[] = $row['quality'];
	}
	return array('ids' => $ids, 'qualities' => $qualities);
}

function get_quality_by_id ($id)
{
	$get_quality = "SELECT quality FROM quality WHERE id=".$id;
	$get_quality_result = mysqli_query($GLOBALS['con'], $get_quality);
	$row = mysqli_fetch_array($get_quality_result, MYSQLI_ASSOC);
	return ucwords($row['quality']);
}

function get_villages_with_ids ()
{
	$get_village = "SELECT id,village FROM villages";
	$get_village_result = mysqli_query($GLOBALS['con'], $get_village);
	while ($row = mysqli_fetch_array($get_village_result, MYSQLI_ASSOC))
	{
		$ids[] = $row['id'];
		$villages[] = $row['village'];
	}
	return array('ids' => $ids, 'villages' => $villages);
}

function get_village_by_id ($id)
{
	$get_village = "SELECT village FROM villages WHERE id=".$id;
	$get_village_result = mysqli_query($GLOBALS['con'], $get_village);
	$row = mysqli_fetch_array($get_village_result, MYSQLI_ASSOC);
	return ucwords($row['village']);
}

function get_village_by_farmer_id ($farmer_id)
{
	$get_village_id = "SELECT village_id FROM farmers WHERE id=".$farmer_id;
	$get_village_id_result = mysqli_query($GLOBALS['con'], $get_village_id);
	$row = mysqli_fetch_array($get_village_id_result, MYSQLI_ASSOC);
	$get_village_name = "SELECT village FROM villages WHERE id=".$row['village_id'];
	$get_village_name_result = mysqli_query($GLOBALS['con'], $get_village_name);
	$row = mysqli_fetch_array($get_village_name_result, MYSQLI_ASSOC);
	return ucwords($row['village']);
}

function company_details()
{
	$company = new query($GLOBALS['con']);
	$records = $company->select('*','company');
	return $records[0];
}

function buyer_details($id)
{
	$db = new query($GLOBALS['con']);
	$records = $db->select('*','buyers','id='.$id);
	return $records[0];
}

function settings()
{
	$db = new query($GLOBALS['con']);
	$records = $db->select('*','settings');
	return $records[0];
}

function farmer_bill($id)
{
	$db = new query($GLOBALS['con']);
	$records = $db->select('*','farmer_bills','id='.$id);
	return $records[0];
}




// get float point (2 decimals)
function get_float($value) {
	return sprintf ("%.2f", $value);
}
	
?>