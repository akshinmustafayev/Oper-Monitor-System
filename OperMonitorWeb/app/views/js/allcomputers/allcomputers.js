function showAllComputers() {
	hideAllPannels();
	document.getElementById("RootBlade").classList.remove("opm-hidden");
	document.getElementById("AllCompsBlade").classList.remove("opm-hidden");
	document.getElementById("AllCompsBladeLeft").classList.remove("opm-hidden");
	document.getElementById("AllCompsBladeLeft").classList.add("opm-blade-left-long");
	document.getElementById("AllCompsBladeRight").classList.add("opm-hidden");
	BladeLeftTableToggle("allcomputers.left.table.hide", false);
	showComputersBladeLeft();
	hideDashboardPannel();
}

function hideAllComputersLeft(){
	document.getElementById("RootBlade").classList.remove("opm-hidden");
	document.getElementById("AllCompsBlade").classList.add("opm-hidden");
	document.getElementById("AllCompsBladeLeft").classList.add("opm-hidden");
	document.getElementById("AllCompsBladeLeft").classList.remove("opm-blade-left-long");
	document.getElementById("AllCompsBladeRight").classList.add("opm-hidden");
	BladeLeftTableToggle("allcomputers.left.table.hide", false);
	showDashboardPannel();
}

function hideAllComputersRight(){
	document.getElementById("RootBlade").classList.remove("opm-hidden");
	document.getElementById("AllCompsBladeLeft").classList.add("opm-blade-left-long");
	document.getElementById("AllCompsBladeRight").classList.add("opm-hidden");
	BladeLeftTableToggle("allcomputers.left.table.hide", false);
}

function showAllComputersRight(){
	document.getElementById("AllCompsBladeLeft").classList.remove("opm-blade-left-long");
	document.getElementById("AllCompsBladeRight").classList.remove("opm-hidden");
	BladeLeftTableToggle("allcomputers.left.table.hide", true);
}

function createComputerShow(){
	GetDataFromItem("opm-part-two", "allcomputers.left.add.pannel").classList.remove("opm-hidden");
}

function createComputerHide(){
	GetDataFromItem("opm-part-two", "allcomputers.left.add.pannel").classList.add("opm-hidden");
}

function createComputerClean(){
	GetDataFromItem("opm-input-text", "allcomputers.left.add.computername").value = "";
	GetDataFromItem("opm-input-text", "allcomputers.left.add.serialnumber").value = "";
	GetDataFromItem("opm-input-text", "allcomputers.left.add.systemname").value = "";
	GetDataFromItem("opm-input-text", "allcomputers.left.add.computervendor").value = "";
	GetDataFromItem("opm-input-text", "allcomputers.left.add.domain").value = "";
	GetDataFromItem("opm-input-text", "allcomputers.left.add.os").value = "";
	GetDataFromItem("opm-input-text", "allcomputers.left.add.ram").value = "";
	GetDataFromItem("opm-input-text", "allcomputers.left.add.processor").value = "";
	GetDataFromItem("opm-input-text", "allcomputers.left.add.ipaddress").value = "";
	GetDataFromItem("opm-input-text", "allcomputers.left.add.harddisk").value = "";
	GetDataFromItem("opm-input-text", "allcomputers.left.add.harddiskserial").value = "";
	GetDataFromItem("opm-input-text", "allcomputers.left.add.graphicscard").value = "";
	GetDataFromItem("opm-input-text", "allcomputers.left.add.lastactiondate").value = "";
}

function showComputerInfo(e){
	showAllComputersRight();
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{allcomputers:"computerinfo",computerid:e.getAttribute('data-id')},
		success:function(data){
			if(data == "-1")
			{
				alert("token error. please log out");
			}
			else if(data == "-2")
			{
				alert("hash id error. please log out");
			}
			else if(data == "-100")
			{
				alert("You dont have access to see that");
			}
			else
			{
				var comp = data;
				comp = comp.replace('','');
				comp = JSON.parse(comp);
				SetDataToItem("opm-blade-right-header-title", "allcomputers.right.blade.header", comp.systemname);
				GetDataFromItem("opm-part-allcomputers-property-text", "allcomputers.right.info.computername").innerHTML = comp.computername;
				GetDataFromItem("opm-part-allcomputers-property-text", "allcomputers.right.info.serialnumber").innerHTML = comp.serialnumber;
				GetDataFromItem("opm-part-allcomputers-property-text", "allcomputers.right.info.systemname").innerHTML = comp.systemname;
				GetDataFromItem("opm-part-allcomputers-property-text", "allcomputers.right.info.computervendor").innerHTML = comp.computervendor;
				GetDataFromItem("opm-part-allcomputers-property-text", "allcomputers.right.info.domain").innerHTML = comp.domain;
				GetDataFromItem("opm-part-allcomputers-property-text", "allcomputers.right.info.os").innerHTML = comp.os;
				GetDataFromItem("opm-part-allcomputers-property-text", "allcomputers.right.info.ram").innerHTML = comp.ram;
				GetDataFromItem("opm-part-allcomputers-property-text", "allcomputers.right.info.processor").innerHTML = comp.processor;
				GetDataFromItem("opm-part-allcomputers-property-text", "allcomputers.right.info.ipaddress").innerHTML = comp.ipaddress;
				GetDataFromItem("opm-part-allcomputers-property-text", "allcomputers.right.info.harddisk").innerHTML = comp.harddisk;
				GetDataFromItem("opm-part-allcomputers-property-text", "allcomputers.right.info.harddiskserial").innerHTML = comp.harddiskserial;
				GetDataFromItem("opm-part-allcomputers-property-text", "allcomputers.right.info.graphicscard").innerHTML = comp.graphicscard;
				GetDataFromItem("opm-part-allcomputers-property-text", "allcomputers.right.info.lastactiondate").innerHTML = comp.lastactiondate;
				if(comp.pathvariable != "none" || comp.pathvariable != "")
					GetDataFromItem("opm-part-allcomputers-property-text", "allcomputers.right.info.pathvariable").innerHTML = atob(comp.pathvariable);
				else
					GetDataFromItem("opm-part-allcomputers-property-text", "allcomputers.right.info.pathvariable").innerHTML = "none";
			}
		}
	});
	
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{allcomputers:"computerloginevents",serialnumber:e.getAttribute('data-serialnumber'),piece:0},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "-100")
			{
				SetDataToItem("opm-table-tbody", "allcomputers.right.blade.table", "<tr><td>you dont have access</td><td></td><td></td></tr>");
			}
			else
			{
				var loginevents = data;
				loginevents = JSON.parse(loginevents);
				var item = GetDataFromItem("opm-table-tbody", "allcomputers.right.blade.table");
				item.innerHTML = '';
				for (var i = 0; i < loginevents.length; i++) {
					var actiontypetext = "";
					if(loginevents[i].actiontype == "1")
						actiontypetext = "Log in"
					else if(loginevents[i].actiontype == "2")
						actiontypetext = "Log off"
					else
						actiontypetext = "Unknown"
					
					SetDataToItem("opm-table-tbody", "allcomputers.right.blade.table", item.innerHTML + "<tr><td>" + loginevents[i].login + "</td><td>" + actiontypetext + "</td><td>" + loginevents[i].time + "</td></tr>");
				}
			}
		}
	});
	
	var item_loadmore = GetDataFromItem("opm-load-more", "allcomputers.right.loadmore");
	item_loadmore.setAttribute('data-count', 1);
	item_loadmore.setAttribute('data-serialnumber', e.getAttribute('data-serialnumber'));
	
	var item_addtobookmarks = GetDataFromItem("opm-blade-button-purple", "allcomputers.right.addtobookmarks");
	item_addtobookmarks.setAttribute('data-id', e.getAttribute('data-id'));
	
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{bookmarks:"getcomputerbookmarkinfo",computerid:e.getAttribute('data-id')},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "1")
			{
				var item = GetDataFromItem("opm-blade-button-purple", "allcomputers.right.addtobookmarks");
				item.classList.remove("opm-hidden");
				item.classList.add("opm-part-bookmarks-pin");
			}
			else if(data == "2")
			{
				var item = GetDataFromItem("opm-blade-button-purple", "allcomputers.right.addtobookmarks");
				item.classList.remove("opm-hidden");
				item.classList.remove("opm-part-bookmarks-pin");
			}
			else if(data == "-100")
			{
				var item = GetDataFromItem("opm-blade-button-purple", "allcomputers.right.addtobookmarks");
				item.classList.add("opm-hidden");
			}
			else
			{
				alert("Please log off and log on the system")
			}
		}
	});
}

function showComputersBladeLeft(){
	hideAllComputersRight();
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{allcomputers:"getcomputers",piece:0},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "-100")
			{
				SetDataToItem("opm-table-tbody" ,"allcomputers.left.table.tbody", "You dont have access to see that");
				GetDataFromItem("opm-label-default", "allcomputers.left.itemscount").innerHTML = "0 items";
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmore").setAttribute('data-count', 1);
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmore").style.visibility = "visible";
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmoresearch").setAttribute('data-count', 1);
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmoresearch").style.visibility = "hidden";
			}
			else
			{
				SetDataToItem("opm-table-tbody" ,"allcomputers.left.table.tbody", data);
				GetDataFromItem("opm-label-default", "allcomputers.left.itemscount").innerHTML = GetDataFromItem("opm-table-tbody", "allcomputers.left.table.tbody").getElementsByTagName("tr").length + " items";
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmore").setAttribute('data-count', 1);
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmore").style.visibility = "visible";
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmoresearch").setAttribute('data-count', 1);
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmoresearch").style.visibility = "hidden";
			}
		}
	});
}

function showMoreComputersBladeLeft(e){
	var count = parseInt(e.getAttribute('data-count'));
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{allcomputers:"getcomputers",piece:count},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "-100")
			{
				SetDataToItem("opm-table-tbody" ,"allcomputers.left.table.tbody", "You dont have access to see that");
				e.setAttribute('data-count', 1);
				GetDataFromItem("opm-label-default", "allcomputers.left.itemscount").innerHTML = "0 items";
			}
			else
			{
				SetDataToItem("opm-table-tbody" ,"allcomputers.left.table.tbody", GetDataFromItem("opm-table-tbody", "allcomputers.left.table.tbody").innerHTML + data);
				count = count + 1;
				e.setAttribute('data-count', count);
				GetDataFromItem("opm-label-default", "allcomputers.left.itemscount").innerHTML = GetDataFromItem("opm-table-tbody", "allcomputers.left.table.tbody").getElementsByTagName("tr").length + " items";
			}
		}
	});
}

function showMoreLogineventsBladeRight(e){
	var count = parseInt(e.getAttribute('data-count'));
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{allcomputers:"computerloginevents",serialnumber:e.getAttribute('data-serialnumber'),piece:count},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "-100")
			{
				SetDataToItem("opm-table-tbody" ,"allcomputers.right.blade.table", "<tr><td>You dont have access to see that</td><td></td><td></td></tr>");
				e.setAttribute('data-count', 1);
			}
			else
			{
				var loginevents = data;
				loginevents = JSON.parse(loginevents);
				for (var i = 0; i < loginevents.length; i++) {
					SetDataToItem("opm-table-tbody", "allcomputers.right.blade.table", GetDataFromItem("opm-table-tbody", "allcomputers.right.blade.table").innerHTML + "<tr><td>" + loginevents[i].login + "</td><td>" + loginevents[i].actiontype + "</td><td>" + loginevents[i].time + "</td></tr>");
				}
				count = count + 1;
				e.setAttribute('data-count', count);
			}
		}
	});
}

function searchComputer(){
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{allcomputers:"searchcomputer",searchtext:GetDataFromItem("opm-input-text", "allcomputers.left.searchcomputer.input").value,searchtype:GetDataFromItem("opm-default-select", "allcomputers.left.searchcomputer.select").value,piece:0},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "-100")
			{
				SetDataToItem("opm-table-tbody" ,"allcomputers.left.table.tbody", "You dont have access to see that");
				GetDataFromItem("opm-label-default", "allcomputers.left.itemscount").innerHTML = "0 items";
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmore").setAttribute('data-count', 1);
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmore").style.visibility = "hidden";
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmoresearch").setAttribute('data-count', 1);
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmoresearch").style.visibility = "visible";
			}
			else
			{
				SetDataToItem("opm-table-tbody" ,"allcomputers.left.table.tbody", "");
				SetDataToItem("opm-table-tbody" ,"allcomputers.left.table.tbody", data);
				GetDataFromItem("opm-label-default", "allcomputers.left.itemscount").innerHTML = GetDataFromItem("opm-table-tbody", "allcomputers.left.table.tbody").getElementsByTagName("tr").length + " results found";
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmore").setAttribute('data-count', 1);
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmore").style.visibility = "hidden";
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmoresearch").setAttribute('data-count', 1);
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmoresearch").style.visibility = "visible";
			}
		}
	});
}

function showMoreSearchComputer(e){
	var count = parseInt(e.getAttribute('data-count'));
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{allcomputers:"searchcomputer",searchtext:GetDataFromItem("opm-input-text", "allcomputers.left.searchcomputer.input").value,searchtype:GetDataFromItem("opm-default-select", "allcomputers.left.searchcomputer.select").value,piece:count},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "-100")
			{
				SetDataToItem("opm-table-tbody" ,"allcomputers.left.table.tbody", "You dont have access to see that");
				GetDataFromItem("opm-label-default", "allcomputers.left.itemscount").innerHTML = "0 items";
				e.setAttribute('data-count', 1);
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmore").setAttribute('data-count', 1);
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmore").style.visibility = "hidden";
			}
			else
			{
				SetDataToItem("opm-table-tbody" ,"allcomputers.left.table.tbody", GetDataFromItem("opm-table-tbody", "allcomputers.left.table.tbody").innerHTML + data);
				count = count + 1;
				e.setAttribute('data-count', count);
				GetDataFromItem("opm-label-default", "allcomputers.left.itemscount").innerHTML = GetDataFromItem("opm-table-tbody", "allcomputers.left.table.tbody").getElementsByTagName("tr").length + " items for search loaded";
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmore").setAttribute('data-count', 1);
				GetDataFromItem("opm-load-more", "allcomputers.left.loadmore").style.visibility = "hidden";
			}
		}
	});
}

function addComputerToBookmarks(){
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{bookmarks:"addcomputertobookmarks",computerid:GetDataFromItem("opm-blade-button-purple", "allcomputers.right.addtobookmarks").getAttribute('data-id')},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "1")
			{
				var item = GetDataFromItem("opm-blade-button-purple", "allcomputers.right.addtobookmarks");
				item.classList.remove("opm-part-bookmarks-pin");
			}
			else if(data == "2")
			{
				var item = GetDataFromItem("opm-blade-button-purple", "allcomputers.right.addtobookmarks");
				item.classList.add("opm-part-bookmarks-pin");
			}
			else if(data == "-100")
			{
				alert("You dont have access to do that");
			}
			else
			{
				alert("Please log off and log on the system");
			}
		}
	});
}

function onEnterPressedSearchAllComps(event){
	if (event.which == 13 || event.keyCode == 13) 
	{
        searchComputer();
    }
}