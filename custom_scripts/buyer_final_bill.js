function calculateBuyerFinalBill()
{
	var finalBill = parseInt($('#grand_total').attr('grand_total'));
	$(".custom_addition").each(function(){
		var payment = parseInt($(this).html());
		finalBill = finalBill + payment;
	});
	var after_additions = finalBill;
	$('.custom_deduction').each(function(){
		var payment = parseInt($(this).html());
		finalBill = finalBill - payment;
	});
	
	$("#after_additions").attr('after_additions', after_additions);
	$('#after_additions').html('Rs '+after_additions+' /-');

	$("#final_bill").attr('final_bill', finalBill);
	$('#final_bill').html('Rs '+finalBill+' /-');
}