function getVillage(farmerId,targetId,showResult)
{
	var fid = $("#"+farmerId).val();
	console.log("weight_list/get_village.php?farmer_id="+fid);
	$("#"+targetId).load("weight_list/get_village.php?farmer_id="+fid,function(){
		//$("#"+showResult).css({"visibility":"visible"});
		$("#"+showResult).css({"display":"block"});
	});

	var dataFarmerId = $('#data-farmer-id').attr('data-farmer-id');
	var $farmer = $('#farmer');
	$farmer.val(dataFarmerId);
	$farmer.trigger('change');
}
