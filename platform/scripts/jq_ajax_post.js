function jqAjaxForm(method,action,paramString,target,displayType)
{
	var variables = '';
	var params = new Array();
	params = paramString.split(',');

	for (var i = 0; i < params.length; i++)
	{
		var paramVal = $('#'+params[i]).val();

		if (i == (params.length - 1))
			variables += params[i] + '=' + paramVal;
		else
			variables += params[i] + '=' + paramVal + '&';
	}
	
	$.ajax({
		type: method,
		url: action,
		data: variables,

		success: function (response){
			if (response != '')
			{
				if (displayType == 'inside')
					$("#"+target).html(response);
				else if (displayType == 'after')
					$("#"+target).after(response);
				else if (displayType == 'before')
					$("#"+target).before(response);
				else if (displayType == 'append')
					$("#"+target).append(response);
			}
		}
	});
}