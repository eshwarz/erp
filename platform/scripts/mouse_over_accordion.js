function open_accordion(tabContainer,subMenu,slideUpClass)
{
	var linkContainer = $("#"+subMenu);
	var mainContainer = $("#"+tabContainer);
	
	//if loop is to avoid slideUp and slideDown while moving from link to menu.
	if (document.getElementById(subMenu).style.display == "none")
	{
		var openMenu = function()
		{
			$("."+slideUpClass).hide();
			linkContainer.show();
		}
		setTimeout(openMenu,0);
	}
	
	var deactivateTab = function()
	{
		$(".selected").attr("class","");
	}
	
	mainContainer.mouseleave(function(){
		setTimeout(deactivateTab,0);
		linkContainer.hide();
	});
}