$(document).ready(function(){
	$(".remove_village").live("click",function(){
		var removeId = $(this).attr("id");
		
		$.ajax({
			type: 'POST',
			url: 'edit/remove_village.php',
			data: 'id='+removeId,
			success: function(response){
				if (response != '')
				{
					$('#remove_logs').append(response);
					$('#remove_village_'+removeId).remove();
				}
				else
				{
					alert('Cannot delete this item now!');
				}
			}
		});
		return false;
	});
});