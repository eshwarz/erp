$(document).ready(function(){
	$(".remove_buyer").live("click",function(){
		var removeId = $(this).attr("id");
		
		$.ajax({
			type: 'POST',
			url: 'edit/remove_buyer.php',
			data: 'id='+removeId,
			success: function(response){
				if (response != '')
				{
					$('#remove_logs').append(response);
					$('#remove_buyer_'+removeId).remove();
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