// Jewel Box
function jewel_box(jewel_link,jewel_box,jewel_link_class)
{
	jewel_box_display = document.getElementById(jewel_box).style.display;
	
	if (jewel_box_display == "none")
	{
		document.getElementById(jewel_box).style.display = "block";
		document.getElementById(jewel_link).setAttribute("class",""+jewel_link_class+"");
	}
	else
	{
		document.getElementById(jewel_box).style.display = "none";
		document.getElementById(jewel_link).setAttribute("class","");
	}
}