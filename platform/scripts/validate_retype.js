// JavaScript Document
function validate_retype(field_id,retype_id,warning_id)
{
	var field = document.getElementById(field_id);
	var retype = document.getElementById(retype_id);
	var warning = document.getElementById(warning_id);
	
	if (field.value != retype.value)
	{
		warning.style.display = "block";
	}
	else
	{
		warning.style.display = "none";
	}
}