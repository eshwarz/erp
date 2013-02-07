$(document).ready(function(){
	$(".remove_credit").live("click",function(){
		var removeId = $(this).attr("id");
		
		$.ajax({
			type: 'POST',
			url: 'bills/remove_credit.php',
			data: 'id='+removeId,
			success: function(response){
				if (response != '')
				{
					$('#final_bill').before(response);
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