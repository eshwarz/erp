function newFarmerModule()
{
	
	document.getElementById("selectFarmerModule").setAttribute("class","dn");
	document.getElementById("newFarmerModule").setAttribute("class","");
	document.getElementById("farmer").value = "";
}
function selectFarmerModule()
{
	document.getElementById("newFarmerModule").setAttribute("class","dn");
	document.getElementById("selectFarmerModule").setAttribute("class","");
	document.getElementById("farmer_new").value = "Farmer's name";
	document.getElementById("showVillage").style.display = "none";
}