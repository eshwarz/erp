$(document).ready(function(){
	$(".remove_addition").live("click",function(){
		var removeId = $(this).attr("id");
		
		$.ajax({
			type: 'POST',
			url: 'bills/buyer/remove_addition.php',
			data: 'id='+removeId,
			success: function(response){
				if (response != '')
				{
					$('#result_additions').after(response);
					$('#remove_addition_'+removeId).remove();
					calculateBuyerFinalBill();
					//alert(response);
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