function ajaxPost(page,data,resultContainer)
{
	try {
		var dataArray = new Array();
		dataArray = data.split(",");
		var dataString = "?";
		for (var m=0;m<dataArray.length;m++)
		{
			dataString = dataString+dataArray[m]+"="+document.getElementById(dataArray[m]).value+"&";
		}
		ajaxpage(page+dataString,resultContainer);
	} catch (e) {
		console.log(e);
	}
}

function saveWeightList() {
	ajaxPost('weight_list/weight_list_q.php','village,farmer,quality,buyer,cost,lotNumber,totalWeight','result');
	document.getElementById('quality').value = '';
	document.getElementById('buyer').value = '';
	document.getElementById('cost').value = '';
	document.getElementById('lotNumber').value = '';
	document.getElementById('totalWeight').value = '';
	document.getElementById('quality').focus();
	return false;
}

function openFarmerBill(farmerId) {
	document.getElementById('farmerId').value = farmerId;
	ajaxPost('search/farmers/view_date_q.php','farmerId,date','mainContent');
}
