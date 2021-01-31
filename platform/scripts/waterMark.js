function fill(id,text_value)
{
	var text_box = document.getElementById(id);
	if (text_box.value == "")
	{
		text_box.style.color = "#999";
		text_box.value = text_value;
	}
}

function unfill(id,text_value)
{
	var text_box = document.getElementById(id);
	
	if (text_box.value == text_value)
	{
		text_box.value = "";
		text_box.style.color = "#000";
	}	
}