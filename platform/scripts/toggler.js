// toggler.js
function toggle(toggler_id)
{
	var toggle_id = document.getElementById("toggle_"+toggler_id);
	var status = toggle_id.style.display;
	
	if (status == "none")
	{
		toggle_id.style.display = "block";
	}
	else if (status == "block")
	{
		toggle_id.style.display = "none";
	}
}