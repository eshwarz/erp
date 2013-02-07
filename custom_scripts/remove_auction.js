$(document).ready(function(){
	$(".remove_auction").live("click",function(){
		var removeId = $(this).attr("id");
		
		$.ajax({
			type: 'POST',
			url: 'view/auctions/remove_auction.php',
			data: 'id='+removeId,
			success: function(response){
				if (response != '')
				{
					$('#remove_logs').append(response);
					$('#result_auction_'+removeId).remove();
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