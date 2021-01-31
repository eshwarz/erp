function tabLinks(tabContainer,this_id)
{
	var children = document.getElementById(tabContainer).getElementsByTagName("a");
	for (var m = 0; m < children.length; m++)
	{
		document.getElementById(children.item(m).id).setAttribute("class","");
	}
	document.getElementById(this_id).setAttribute("class","selected");
}