<?php
require_once('../../platform/error_reporting.php');
require_once('../../conn.php');
require_once('../../platform/helpers/form_helper.php');
require_once('../../platform/query.php');
require_once('../../functions/functions.php');
require_once('../../platform/query.php');
require_once('../../platform/escape_data.php');

$settings = settings();
$id = $_REQUEST['id'];
$quality = $_REQUEST['quality'];
$buyer_id = $_REQUEST['buyer_id'];
$cost = $_REQUEST['cost'];
$lot_number = $_REQUEST['lot_number'];
$serial = escape_data(strval($_REQUEST['serial']));
$db = new query($con);
$deduction = $db->select('*','weight_deduction');
$weight_deduction = $deduction[0]['weight_deduction'];

if ($cost != "Cost")
{
	//checking whether lot is pending or not also forming weights array.
	$pending_flag = 0;
	$bags;
	for ($m=1;$m<=$lot_number;$m++)
	{
		if ($_REQUEST["bag".$m] == 0)
		{
			$pending_flag = 1;
			break;
		}
	}
	for ($p=1;$p<=$lot_number;$p++)
	{
		$buyers[] = $_REQUEST["buyer".$p];	
		if ($_REQUEST["bag".$p] == 0)
			$bags[] = $_REQUEST["bag".$p];
		else
			$bags[] = $_REQUEST["bag".$p] - ($weight_deduction * $lot_number);
	}
	
	//calculating total cost
	// $total_weight = array_sum($bags);
	$total_weight = $bags[0];
	$total_cost = $total_weight * ($cost);

	$db = new query($con);

	if ($settings['multiple_buyers'] == 1)
	{
		if ($pending_flag == 0)
		{
			$db->update('lots','serial,quality,cost,total_cost,pending',"'".$serial."',".$quality.",".$cost.",".$total_cost.",0",'lot_id='.$id);
		}
		else
		{
			$db->update('lots','serial,quality,cost,total_cost,pending',"'".$serial."',".$quality.",".$cost.",".$total_cost.",1",'lot_id='.$id);
		}
	}

	else
	{
		if ($pending_flag == 0)
		{
			$db->update('lots','quality,buyer_id,cost,total_cost,pending',"".$quality.",".$buyer_id.",".$cost.",".$total_cost.",0",'lot_id='.$id);
		}
		else
		{
			$db->update('lots','quality,buyer_id,cost,total_cost,pending',"".$quality.",".$buyer_id.",".$cost.",".$total_cost.",1",'lot_id='.$id);
		}

	}
	
	//deleting the old weights and inserting new ones
	$db->delete('weights','lot_id='.$id);
	
	if ($settings['multiple_buyers'] == 1)
	{
		for ($p=0;$p<count($bags);$p++)
		{
			$db->insert('weights','lot_id,buyer_id,weight',"".$id.",".$buyers[$p].",".$bags[$p]."");
		}
	}
	else
	{
		// for ($p=0;$p<count($bags);$p++)
		// {
		// 	$db->insert('weights','lot_id,weight',"".$id.",".$bags[$p]."");
		// }
		$db->insert('weights','lot_id,weight',"".$id.",".$total_cost."");
	}

	$record = $db->select('*','lots','lot_id='.$id);
}

if ($settings['multiple_buyers'] == 1)
{
	$getWeight = new query($con);
	$weights = $getWeight->select("*","weights","lot_id=".$id);
	for ($p=0;$p<count($weights);$p++)
	{
		if ($p == 0)
			$buyer_names = get_buyer_by_id($weights[$p]['buyer_id']);
		else
		$buyer_names = $buyer_names.'<br/>'.get_buyer_by_id($weights[$p]['buyer_id']);
	}
	?>
	<td class="first"><?php echo $record[0]['serial']; ?></td>
	<td ><?php echo get_farmer_by_id($record[0]['farmer_id']); ?></td>
	<td><?php echo get_village_by_farmer_id($record[0]['farmer_id']); ?></td>
	<td align="center"><?php echo get_quality_by_id($quality); ?></td>
	<td align="center"><?php echo $record[0]['cost']; ?></td>
	<td align="center"><?php echo $record[0]['lot_number']; ?></td>
	<td><?php echo implode(',',$bags); ?></td>
	<td align="center"><?php echo $total_weight; ?></td>
	<td align="center"><?php echo $record[0]['total_cost']; ?></td>
	<td><?php echo $buyer_names; ?></td>
	<td class="last">
		<a href="#" class="remove_lot hide" id="<?php echo $id; ?>">X</a>
		<a href="#" class="edit_lot hide mr5" id="" onclick="ajaxpage('view/weights/edit_weight.php?id=<?php echo $id; ?>','lb_content'); open_lb('popup','popup_panel'); return false;">Edit</a>
	</td>
	<?php
}
else
{
	?>
	<td class="first"><?php echo get_farmer_by_id($record[0]['farmer_id']); ?></td>
	<td><?php echo get_village_by_farmer_id($record[0]['farmer_id']); ?></td>
	<td align="center"><?php echo get_quality_by_id($quality); ?></td>
	<td align="center"><?php echo $record[0]['cost']; ?></td>
	<td align="center"><?php echo $record[0]['lot_number']; ?></td>
	<td><?php echo implode(',',$bags); ?></td>
	<td align="center"><?php echo $total_weight; ?></td>
	<td align="center"><?php echo $record[0]['total_cost']; ?></td>
	<td><?php echo get_buyer_by_id($record[0]['buyer_id']); ?></td>
	<td class="last">
		<a href="#" class="remove_lot hide" id="<?php echo $id; ?>">X</a>
		<a href="#" class="edit_lot hide mr5" id="" onclick="ajaxpage('view/weights/edit_weight.php?id=<?php echo $id; ?>','lb_content'); open_lb('popup','popup_panel'); return false;">Edit</a>
	</td>
	<?php
}
?>