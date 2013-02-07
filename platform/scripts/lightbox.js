function position()
{
	var ScrollTop = document.body.scrollTop;
		
	if (ScrollTop == 0)
	{
		if (window.pageYOffset) //for all other browsers
		{
			ScrollTop = window.pageYOffset;
		}
		else //for IE browsers
		{
			if (document.body.parentElement)
			{
				ScrollTop = document.body.parentElement.scrollTop;
			}
			else
			{
				ScrollTop = 0;
			}
		}
	}
	return ScrollTop;
}

function body_height()
{
	var browser_height = (typeof window.innerHeight != 'undefined' ? window.innerHeight : document.body.offsetHeight);
	var scroll_height = document.body.scrollHeight;

	if (scroll_height > browser_height)
		return scroll_height;
	else
		return browser_height;
}

function body_width()
{
	var scroll_width = document.body.scrollWidth;
	return scroll_width;
}

function open_lb(overlay,popupBox)
{
	var overlay = document.getElementById(overlay);
	var lb = document.getElementById(popupBox);
	var top_pos = position()+100;
	var y_len = body_height();
	var x_len = body_width();
	overlay.style.height = y_len+"px";
	
	lb.style.left = (x_len/2)-285+"px";
	lb.style.top = top_pos+"px";
	
	overlay.style.display = "block";
	lb.style.display = "block";
}

function close_lb(overlay,popupBox,loader,content)
{
	var overlay = document.getElementById(overlay);
	var lb = document.getElementById(popupBox);
	document.getElementById(content).innerHTML = "<div class='pt10 pb10 f20 tc fb c3'>Loading...</div>";
	
	lb.style.display = "none";
	overlay.style.display = "none";
	//document.getElementById(loader).style.display = "block";
	//document.getElementById(content).style.display = "none";
}