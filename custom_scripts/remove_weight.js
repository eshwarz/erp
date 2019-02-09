$(document).ready(function(){
	$(".remove_lot").live("click",function(){
		var removeId = $(this).attr("id");

		open_lb('popup','popup_panel', true, function () {
			close_lb('popup','popup_panel','lb_loader','lb_content');
			$.ajax({
				type: 'POST',
				url: 'view/weights/remove_weight.php',
				data: 'id='+removeId,
				success: function(response){
					if (response != '')
					{
						$('#remove_logs').append(response);
						$('#result_lot_'+removeId).remove();
					}
					else
					{
						alert('Cannot delete this item now!');
					}
				}
			});
		});
		return false;
	});
});