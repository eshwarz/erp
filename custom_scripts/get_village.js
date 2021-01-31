function getVillage(farmerId,targetId,showResult)
{
	var farmer_id = $("#"+farmerId).val();
	$("#"+targetId).load("weight_list/get_village.php?farmer_id="+farmer_id,function(){
		//$("#"+showResult).css({"visibility":"visible"});
		$("#"+showResult).css({"display":"block"});
	});
}