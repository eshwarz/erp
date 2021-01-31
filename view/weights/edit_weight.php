<?php
require_once('../../platform/error_reporting.php');
require_once('../../conn.php');
require_once('../../platform/helpers/form_helper.php');
require_once('../../platform/query.php');
require_once('../../functions/functions.php');
$id = $_REQUEST['id'];
$settings = settings();
?>
<div class="lb_header">Edit Weight List</div>
<div class="lb_message">
	<?php
	$db = new query;
	$records = $db->select('*','lots','lot_id='.$id);
	$lots = $db->select('*','weights','lot_id='.$id);
	$deduction = $db->select('*','weight_deduction');

	$buyers = get_buyers_with_ids ();
	$qualities = get_qualities_with_ids();
	$serial = $records[0]['serial'];
	$farmer = get_farmer_by_id ($records[0]['farmer_id']);
	$buyer = get_buyer_by_id ($records[0]['buyer_id']);
	$weight_deduction = $deduction[0]['weight_deduction'];
	$default_quality = $records[0]['quality'].",".get_quality_by_id ($records[0]['quality']);
	$default_buyer = $records[0]['buyer_id'].",".get_buyer_by_id ($records[0]['buyer_id']);
	
	tf('','id','dn','id',$id);
	if ($settings['multiple_buyers'] == 1)
		tf('Serial Number','serial','','serial',$serial);
	tf_disable('Farmer','farmer_name','','farmer_name',$farmer);
	select_box('Quality','quality','','quality',"{$default_quality}",$qualities['qualities'],$qualities['ids']);
	if ($settings['multiple_buyers'] == 0)
		select_box('Buyer','buyer_id','','buyer_id',"{$default_buyer}",$buyers['names'],$buyers['ids']);
	tf('Cost','cost','','cost',$records[0]['cost']);
	tf_disable('Lot Number','lot_number','','lot_number',$records[0]['lot_number']);
	?>
	<div class="fb tc p10 pt5">Weights</div>
	<?php
	if ($settings['multiple_buyers'] == 1)
	{
		for ($p=0;$p<count($lots);$p++)
		{
			$num = $p+1;

			if ($lots[$p]['weight'] == 0)
				$weight = $lots[$p]['weight'];
			else
				$weight = $lots[$p]['weight']+$weight_deduction;

			$buyer_ids = $buyers['ids'];
			for ($a=0;$a<count($buyer_ids);$a++)
			{
				$all_buyers = $all_buyers."<option value='".$buyer_ids[$a]."'>".get_buyer_by_id($buyer_ids[$a])."</options>";
			}
			$weight_content = "
					<div class='fl'>
						<input type='text' id='bag".$num."' value='".$weight."' style='padding:4px;width:100px;' />
					</div>
					<div class='fl'>
						<select id='buyer".$num."' class='w100' style='margin-left:-1px;'>
							<option value='".$lots[$p]['buyer_id']."'>".get_buyer_by_id($lots[$p]['buyer_id'])."</option>
							".$all_buyers."
						</select>
					</div>
					<div class='cbo'></div>
				";

			content('Bag '.$num, $weight_content);

			// tf('Bag '.$num,'bag'.$num,'','bag'.$num,$weight);
		}
	}
	else
	{
		for ($p=0;$p<count($lots);$p++)
		{
			$num = $p+1;

			if ($lots[$p]['weight'] == 0)
				$weight = $lots[$p]['weight'];
			else
				$weight = $lots[$p]['weight']+$weight_deduction;

			tf('Bag '.$num,'bag'.$num,'','bag'.$num,$weight);
		}
	}

	$bags = '';
	$buyers = '';
	for ($p=0;$p<count($lots);$p++)
	{
		$num = $p+1;
		if ($p != count($lots)-1)
		{
			$bags = $bags.'bag'.$num.',';
			$buyers = $buyers.'buyer'.$num.',';
		}
		else
		{
			$bags = $bags.'bag'.$num;
			$buyers = $buyers.'buyer'.$num;
		}
	}
	?>

	<?php
	if ($settings['multiple_buyers'] == 1)
	{
		?>
		<input type="button" class="button" style="margin-left:200px;" onclick="ajaxPost('view/weights/edit_weight_q.php','id,serial,quality,cost,lot_number,<?php echo $bags.','.$buyers; ?>','result_lot_<?php echo $id; ?>'); close_lb('popup','popup_panel','lb_loader','lb_content');" value="Save Changes" />
		<?php
	}
	else
	{
		?>
		<input type="button" class="button" style="margin-left:200px;" onclick="ajaxPost('view/weights/edit_weight_q.php','id,quality,buyer_id,cost,lot_number,<?php echo $bags; ?>','result_lot_<?php echo $id; ?>'); close_lb('popup','popup_panel','lb_loader','lb_content');" value="Save Changes" />
		<?php
	}
	?>
	
</div>