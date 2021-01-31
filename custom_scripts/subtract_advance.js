//subtract advance on the fly.
function deduct (totalId,deductionIds,resultId)
{
	var total = document.getElementById(totalId).value;
	var deductionArray = new Array();
	deductionArray = deductionIds.split(",");
	for (var i=0;i<deductionArray.length;i++)
	{
		total = total - document.getElementById(deductionArray[i]).value;
	}
	
	document.getElementById(resultId).innerHTML = "Rs "+total+" /-";
	document.getElementById(resultId).setAttribute("afterDeduction",total);
	
	calculateFarmerFinalBill();	
}