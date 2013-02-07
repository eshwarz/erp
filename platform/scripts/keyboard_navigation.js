// keyboard Navigation
//document.onkeyup = navigate;
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
		//alert("down");
		break;
		
		default:
		//alert("another");
	}
}