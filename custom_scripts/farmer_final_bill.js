function calculateFarmerFinalBill()
{
	var finalBill = $('#grand_total').attr('grand_total');
	$(".credit_payments").each(function(){
		var payment = $(this).html();
		finalBill = finalBill - payment;
	});
	$('.custom_deduction').each(function(){
		var payment = $(this).html();
		finalBill = finalBill - payment;
	});
	$("#final_bill").attr('final_bill', finalBill);
	$('#final_bill').html('Rs '+finalBill+' /-');
}