function ajaxPost(page,data,resultContainer)
{
	try {
		var dataArray = new Array();
		dataArray = data.split(",");
		console.log("🚀 ~ file: ajaxPost.js:5 ~ dataArray:", dataArray);
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