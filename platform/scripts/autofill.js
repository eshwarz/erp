// autofill();
/*
function autofill(input,result,page)
{
	var searchString = document.getElementById(input).value;
	var resultId = document.getElementById(result);
	if (searchString != "")
	{
		ajaxNoLoadImage(page+"?"+input+"="+searchString,result);
		resultId.style.display = "block";
	}
	else
	{
		resultId.style.display = "none";
	}
}
*/
function autofill(input,result,page)
{
	var dataArray = new Array();
	dataArray = input.split(",");
	var dataString = "?";
	for (var m=0;m<dataArray.length;m++)
	{
		dataString = dataString+dataArray[m]+"="+document.getElementById(dataArray[m]).value+"&";
	}
	
	//var searchString = document.getElementById(input).value;
	var resultId = document.getElementById(result);
	if (document.getElementById(dataArray[0]).value != "") //searchString != "".
	{
		ajaxNoLoadImage(page+dataString,result);
		resultId.style.display = "block";
	}
	else
	{
		resultId.style.display = "none";
	}
}

function hide(input,result)
{
	document.getElementById(result).style.display = "none";
}

function show(input,result)
{
	var searchString = document.getElementById(input).value;
	if (searchString != "")
	{
		document.getElementById(result).style.display = "block";
	}
}

function navigate(e)
{
	var keyId = (window.event) ? event.keyCode : e.keyCode;
	switch (keyId)
	{
		case 37:
		//alert("left");
		break;
		
		case 38:
		//alert("up");
		break;
		
		case 39:
		//alert("right");
		//document.getElementById("weightList").focus();
		break;
		
		case 40:
		alert("down");
		break;
		
		default:
		//alert("another");
	}
}