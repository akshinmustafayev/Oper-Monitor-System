function showLoginevents(){
	hideAllPannels();
	document.getElementById("RootBlade").classList.remove("opm-hidden");
	document.getElementById("LogineventsBlade").classList.remove("opm-hidden");
	document.getElementById("LogineventsBladeLeft").classList.remove("opm-hidden");
	document.getElementById("LogineventsBladeLeft").classList.add("opm-blade-left-long");
	document.getElementById("LogineventsBladeRight").classList.add("opm-hidden");
	showLogineventsBladeLeft();
	hideDashboardPannel();
}

function hideLogineventsLeft(){
	document.getElementById("RootBlade").classList.remove("opm-hidden");
	document.getElementById("LogineventsBlade").classList.add("opm-hidden");
	document.getElementById("LogineventsBladeLeft").classList.add("opm-hidden");
	document.getElementById("LogineventsBladeLeft").classList.remove("opm-blade-left-long");
	document.getElementById("LogineventsBladeRight").classList.add("opm-hidden");
	showDashboardPannel();
}

function hideLogineventsRight(){
	document.getElementById("RootBlade").classList.remove("opm-hidden");
	document.getElementById("LogineventsBladeLeft").classList.add("opm-blade-left-long");
	document.getElementById("LogineventsBladeRight").classList.add("opm-hidden");
}

function showLogineventsRight(){
	document.getElementById("LogineventsBladeLeft").classList.remove("opm-blade-left-long");
	document.getElementById("LogineventsBladeRight").classList.remove("opm-hidden");
}

function showLogineventsBladeLeft(){
	hideLogineventsRight();
}

function resetLogineventsSearch(){
	GetDataFromItem("opm-input-text", "loginevents.left.searchproperty.serialnumber").value = "";
	GetDataFromItem("opm-loginevents-dropdown", "loginevents.left.searchproperty.action").selectedIndex = 0;
	GetDataFromItem("opm-input-text", "loginevents.left.searchproperty.systemname").value = "";
	GetDataFromItem("opm-loginevents-dropdown", "loginevents.left.searchproperty.systemname.value").selectedIndex = 0;
	GetDataFromItem("opm-input-text", "loginevents.left.searchproperty.login").value = "";
	GetDataFromItem("opm-loginevents-dropdown", "loginevents.left.searchproperty.login.value").selectedIndex = 0;
	GetDataFromItem("opm-red-message", "loginevents.left.search.error").classList.add("opm-hidden");
	GetDataFromItem("opm-table-tbody", "loginevents.left.search.table").innerHTML = "<tr><td>No login events found</td><td></td><td></td><td></td><td></td></tr>";
}

function clearLogineventsSearch(){
	GetDataFromItem("opm-table-tbody", "loginevents.left.search.table").innerHTML = "<tr><td>No login events found</td><td></td><td></td><td></td><td></td></tr>";
}

function logineventsSearch(){
	GetDataFromItem("opm-red-message", "loginevents.left.search.error").classList.add("opm-hidden");
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{loginevents:"getloginevents",serialnumber:GetDataFromItem("opm-input-text", "loginevents.left.searchproperty.serialnumber").value,action:GetDataFromItem("opm-loginevents-dropdown", "loginevents.left.searchproperty.action").value,systemname:GetDataFromItem("opm-input-text", "loginevents.left.searchproperty.systemname").value,systemnamevalue:GetDataFromItem("opm-loginevents-dropdown", "loginevents.left.searchproperty.systemname.value").value,login:GetDataFromItem("opm-input-text", "loginevents.left.searchproperty.login").value,loginvalue:GetDataFromItem("opm-loginevents-dropdown", "loginevents.left.searchproperty.login.value").value},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "-1")
			{
				SetDataToItem("opm-table-tbody" ,"loginevents.left.search.table", "");
				GetDataFromItem("opm-red-message", "loginevents.left.search.error").classList.remove("opm-hidden");
				SetDataToItem("opm-red-message" ,"loginevents.left.search.error", "Please provide data for searching!");
			}
			else if(data == "0")
			{
				SetDataToItem("opm-table-tbody" ,"loginevents.left.search.table", "");
				GetDataFromItem("opm-red-message", "loginevents.left.search.error").classList.remove("opm-hidden");
				SetDataToItem("opm-red-message" ,"loginevents.left.search.error", "Nothing found!");
				GetDataFromItem("opm-table-tbody", "loginevents.left.search.table").innerHTML = "<tr><td>No login events found</td><td></td><td></td><td></td><td></td></tr>";
			}
			else if(data == "-100")
			{
				SetDataToItem("opm-table-tbody" ,"loginevents.left.search.table", "");
				GetDataFromItem("opm-red-message", "loginevents.left.search.error").classList.remove("opm-hidden");
				SetDataToItem("opm-red-message" ,"loginevents.left.search.error", "You dont have access to see that!");
				GetDataFromItem("opm-table-tbody", "loginevents.left.search.table").innerHTML = "<tr><td>No access</td><td></td><td></td><td></td><td></td></tr>";
			}
			else
			{
				SetDataToItem("opm-table-tbody" ,"loginevents.left.search.table", "");
				GetDataFromItem("opm-red-message", "loginevents.left.search.error").classList.add("opm-hidden");
				SetDataToItem("opm-table-tbody" ,"loginevents.left.search.table", data);
			}
		}
	});
}

function onEnterPressedSearch(event){
	if (event.which == 13 || event.keyCode == 13) 
	{
        logineventsSearch();
    }
}

