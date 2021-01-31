$(document).ready(function(){
	$(".remove_deduction").live("click",function(){
		var removeId = $(this).attr("id");
		
		$.ajax({
			type: 'POST',
			url: 'bills/buyer/remove_buyer_deduction.php',
			data: 'id='+removeId,
			success: function(response){
				if (response != '')
				{
					$('#remove_deduction_'+removeId).remove();
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