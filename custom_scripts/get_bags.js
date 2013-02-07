$(document).ready(function(){
	$(".lotNumber").live("keyup",function(){
		var lotNumber = $(this).val();
		var multiple_buyers = parseInt($('#multiple_buyers').val());
		$("#startWeights").load("weight_list/get_bags.php?lotNumber="+lotNumber);
		
		var bags = "";
		for (var m=1;m<=lotNumber;m++)
		{
			bags = bags+",bag"+m;
		}

		// executes only in case multiple buyers is enabled
		if (multiple_buyers == 1)
		{
			var buyers = '';
			for (var m=1;m<=lotNumber;m++)
			{
				buyers = buyers+',buyer'+m;
			}

			//rewriting the ajaxpost script for dynamic posting of the bags and buyers.
			document.getElementById("weightListPost").setAttribute("onclick","ajaxPost('weight_list/weight_list_q.php','farmer_new,village,farmer,quality,buyer,cost,lotNumber,serialNumber"+bags+buyers+"','result');this.form.reset();return false;");
		}
		else
		{
			//rewriting the ajaxpost script for dynamic posting of the bags.
			document.getElementById("weightListPost").setAttribute("onclick","ajaxPost('weight_list/weight_list_q.php','farmer_new,village,farmer,quality,buyer,cost,lotNumber"+bags+"','result');this.form.reset();return false;");
		}
		
		
		
	});
});