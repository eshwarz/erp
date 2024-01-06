function getVillage(farmerId,targetId,showResult)
{
	var fid = $("#"+farmerId).val();
	console.log("weight_list/get_village.php?farmer_id="+fid);
	$("#"+targetId).load("weight_list/get_village.php?farmer_id="+fid,function(e){
		console.log(e);
		//$("#"+showResult).css({"visibility":"visible"});
		$("#"+showResult).css({"display":"block"});
		setTimeout(function (){
			var dataFarmerId = $('#data-farmer-id').attr('data-farmer-id');
			$('#farmer').attr('value', dataFarmerId);
			$('#farmer option[value="' + dataFarmerId + '"]').prop('selected', true);
		});
	});

}
