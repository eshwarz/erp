function getVillage(farmerId,targetId,showResult)
{
	var farmer_id = $("#"+farmerId).val();
	console.log("weight_list/get_village.php?farmer_id="+farmer_id);
	$("#"+targetId).load("weight_list/get_village.php?farmer_id="+farmer_id,function(){
		//$("#"+showResult).css({"visibility":"visible"});
		$("#"+showResult).css({"display":"block"});
	});

	// $('#farmer').val()
}