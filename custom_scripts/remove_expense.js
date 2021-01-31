$(document).ready(function(){
	$(".remove_expense").live("click",function(){
		var removeId = $(this).attr("id");
		
		$.ajax({
			type: 'POST',
			url: 'bills/remove_expense.php',
			data: 'id='+removeId,
			success: function(response){
				if (response != '')
				{
					$('#result_expenses').after(response);
					$('#remove_'+removeId).remove();
					calculateFarmerFinalBill();
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