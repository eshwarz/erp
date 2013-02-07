// warning (onblur)
function validate_empty(field_id,warning_id,disable_id)
{
	var field_value = document.getElementById(field_id).value; 
	var warning = document.getElementById(warning_id);
	var disable = document.getElementById(disable_id);
	
	if (field_value == "")
	{
		warning.style.display = "block";
		if (disable_id != "")
		{
			disable.disabled = true;
		}
	}
	else
	{
		warning.style.display = "none";
		if (disable_id != "")
		{
			disable.disabled = false;
		}
	}
}