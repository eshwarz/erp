function getVillage(farmerId,targetId,showResult)
{
	var fid = $("#"+farmerId).val();
	$("#"+targetId).load("weight_list/get_village.php?farmer_id="+fid,function(response){
		if (response) {
			$("#"+showResult).css({"display":"block"});
			setTimeout(function (){
				var dataFarmerId = $('#data-farmer-id').attr('data-farmer-id');
				$('#farmer').attr('value', dataFarmerId);
				$('#farmer option[value="' + dataFarmerId + '"]').prop('selected', true);
				$('#quality').focus();
			}, 50);
		} else {
			$("#"+showResult).css({"display":"none"});
			$('#farmer option[value=""]').prop('selected', true);
		}
	});

}
