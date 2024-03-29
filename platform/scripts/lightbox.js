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

function open_lb(overlay, popupBox, password, actionOnPassword)
{
	window.actionOnPassword = actionOnPassword;
	var overlay = document.getElementById(overlay);
	var lb = document.getElementById(popupBox);
	var authBox = document.getElementById('authentication');
	var top_pos = position()+100;
	var y_len = body_height();
	var x_len = body_width();
	overlay.style.height = y_len+"px";
	
	lb.style.left = (x_len/2)-285+"px";
	lb.style.top = top_pos+"px";
	
	overlay.style.display = "block";
	lb.style.display = "block";


	if (password === true) {
		authBox.style.display = "block";

		// hide lb_content's inner HTML
		document.getElementById('lb_content').innerHTML = '';

		// commented out as it is not working as expected after moving the software to cloud
		// var authListener = function (event) {
		// 	if (event.data.requester === 'ceo_here') {
		// 		console.log('auth listener inside open_lb');
		// 		actionOnPassword();
		// 		authBox.style.display = "none";
		// 	}
		// 	window.removeEventListener('message', authListener, false);
		// };
		// window.addEventListener('message', authListener);
	} else {
		authBox.style.display = "none";
	}
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

function startAuthentication() {
	var authBox = document.getElementById('authentication');
	var password = document.getElementById('auth_password').value;
	authBox.value = ''; // clearing password after trying
	if (btoa(password) === 'THVja3kyMDE2MjI=') {
		console.log('authenticated succesfully!');
		window.postMessage({ requester: 'ceo_here' });
	} else {
		console.log('wrong password!');
	}
}

var authListener = function (event) {
	if (event.data.requester === 'ceo_here') {
		var authBox = document.getElementById('authentication');
		console.log('auth listener outside open_lb');
		window.actionOnPassword();
		authBox.style.display = "none";
	}
};

window.addEventListener('message', authListener);
