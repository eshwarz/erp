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

	var handlingCharges = parseInt($('#labour_handling_charges').attr('labourhandlingcharges'), 10);
	console.log(finalBill, handlingCharges);
	finalBill -= handlingCharges;
	console.log(finalBill, handlingCharges);
	$("#final_bill").attr('final_bill', finalBill);
	$('#final_bill').html('Rs '+finalBill+' /-');
}
