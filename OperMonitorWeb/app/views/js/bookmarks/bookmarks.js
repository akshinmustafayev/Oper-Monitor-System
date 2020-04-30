function showBookmarks(){
	hideAllPannels();
	document.getElementById("RootBlade").classList.remove("opm-hidden");
	document.getElementById("BookmarksBlade").classList.remove("opm-hidden");
	document.getElementById("BookmarksBladeLeft").classList.remove("opm-hidden");
	document.getElementById("BookmarksBladeLeft").classList.add("opm-blade-left-long");
	document.getElementById("BookmarksBladeRight").classList.add("opm-hidden");
	BladeLeftTableToggle("bookmarks.left.table.hide", false);
	showBookmarksBladeLeft();
	hideDashboardPannel();
	hideBookmarksRight();
}

function hideBookmarksLeft(){
	document.getElementById("RootBlade").classList.remove("opm-hidden");
	document.getElementById("BookmarksBlade").classList.add("opm-hidden");
	document.getElementById("BookmarksBladeLeft").classList.add("opm-hidden");
	document.getElementById("BookmarksBladeLeft").classList.remove("opm-blade-left-long");
	document.getElementById("BookmarksBladeRight").classList.add("opm-hidden");
	BladeLeftTableToggle("bookmarks.left.table.hide", false);
	showDashboardPannel();
}

function hideBookmarksRight(){
	document.getElementById("RootBlade").classList.remove("opm-hidden");
	document.getElementById("BookmarksBladeLeft").classList.add("opm-blade-left-long");
	document.getElementById("BookmarksBladeRight").classList.add("opm-hidden");
	BladeLeftTableToggle("bookmarks.left.table.hide", false);
}

function showBookmarksRight(){
	document.getElementById("BookmarksBladeLeft").classList.remove("opm-blade-left-long");
	document.getElementById("BookmarksBladeRight").classList.remove("opm-hidden");
	BladeLeftTableToggle("bookmarks.left.table.hide", true);
}

function showBookmarksBladeLeft(){
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{bookmarks:"getbookmarkcomputers",piece:0},
		success:function(data){
			SetDataToItem("opm-table-tbody" ,"bookmarks.left.table.tbody", data);
			GetDataFromItem("opm-label-default", "bookmarks.left.itemscount").innerHTML = GetDataFromItem("opm-table-tbody", "bookmarks.left.table.tbody").getElementsByTagName("tr").length + " items";
			GetDataFromItem("opm-load-more", "bookmarks.left.loadmore").setAttribute('data-count', 1);
			GetDataFromItem("opm-load-more", "bookmarks.left.loadmore").style.visibility = "visible";
			GetDataFromItem("opm-load-more", "bookmarks.left.loadmoresearch").setAttribute('data-count', 1);
			GetDataFromItem("opm-load-more", "bookmarks.left.loadmoresearch").style.visibility = "hidden";
		}
	});
}

function searchBookmarkComputer(){
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{bookmarks:"searchcomputer",searchtext:GetDataFromItem("opm-input-text", "bookmarks.left.searchcomputer.input").value,searchtype:GetDataFromItem("opm-default-select", "bookmarks.left.searchcomputer.select").value,piece:0},
		success:function(data){
			SetDataToItem("opm-table-tbody" ,"bookmarks.left.table.tbody", "");
			SetDataToItem("opm-table-tbody" ,"bookmarks.left.table.tbody", data);
			GetDataFromItem("opm-label-default", "bookmarks.left.itemscount").innerHTML = GetDataFromItem("opm-table-tbody", "bookmarks.left.table.tbody").getElementsByTagName("tr").length + " results found";
			GetDataFromItem("opm-load-more", "bookmarks.left.loadmore").setAttribute('data-count', 1);
			GetDataFromItem("opm-load-more", "bookmarks.left.loadmore").style.visibility = "hidden";
			GetDataFromItem("opm-load-more", "bookmarks.left.loadmoresearch").setAttribute('data-count', 1);
			GetDataFromItem("opm-load-more", "bookmarks.left.loadmoresearch").style.visibility = "visible";
		}
	});
}

function showMoreBookmarksBladeLeft(e){
	var count = parseInt(e.getAttribute('data-count'));
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{bookmarks:"getbookmarkcomputers",piece:count},
		success:function(data){
			SetDataToItem("opm-table-tbody" ,"bookmarks.left.table.tbody", GetDataFromItem("opm-table-tbody", "bookmarks.left.table.tbody").innerHTML + data);
			count = count + 1;
			e.setAttribute('data-count', count);
			GetDataFromItem("opm-label-default", "bookmarks.left.itemscount").innerHTML = GetDataFromItem("opm-table-tbody", "bookmarks.left.table.tbody").getElementsByTagName("tr").length + " items";
		}
	});
}

function showMoreSearchBookmarks(e){
	var count = parseInt(e.getAttribute('data-count'));
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{bookmarks:"searchcomputer",searchtext:GetDataFromItem("opm-input-text", "bookmarks.left.searchcomputer.input").value,searchtype:GetDataFromItem("opm-default-select", "bookmarks.left.searchcomputer.select").value,piece:count},
		success:function(data){
			SetDataToItem("opm-table-tbody" ,"bookmarks.left.table.tbody", GetDataFromItem("opm-table-tbody", "bookmarks.left.table.tbody").innerHTML + data);
			count = count + 1;
			e.setAttribute('data-count', count);
			GetDataFromItem("opm-label-default", "bookmarks.left.itemscount").innerHTML = GetDataFromItem("opm-table-tbody", "bookmarks.left.table.tbody").getElementsByTagName("tr").length + " items for search loaded";
			GetDataFromItem("opm-load-more", "bookmarks.left.loadmore").setAttribute('data-count', 1);
			GetDataFromItem("opm-load-more", "bookmarks.left.loadmore").style.visibility = "hidden";
		}
	});
}

function showBookmarkInfo(e){
	showBookmarksRight();
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{bookmarks:"computerinfo",computerid:e.getAttribute('data-id')},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "-1")
			{
				alert("token error. please log out");
			}
			else if(data == "-2")
			{
				alert("hash id error. please log out");
			}
			else
			{
				var comp = data;
				comp = comp.replace('','');
				comp = JSON.parse(comp);
				SetDataToItem("opm-blade-right-header-title", "bookmarks.right.blade.header", comp.systemname);
				GetDataFromItem("opm-part-bookmarks-property-text", "bookmarks.right.info.computername").innerHTML = comp.computername;
				GetDataFromItem("opm-part-bookmarks-property-text", "bookmarks.right.info.serialnumber").innerHTML = comp.serialnumber;
				GetDataFromItem("opm-part-bookmarks-property-text", "bookmarks.right.info.systemname").innerHTML = comp.systemname;
				GetDataFromItem("opm-part-bookmarks-property-text", "bookmarks.right.info.computervendor").innerHTML = comp.computervendor;
				GetDataFromItem("opm-part-bookmarks-property-text", "bookmarks.right.info.domain").innerHTML = comp.domain;
				GetDataFromItem("opm-part-bookmarks-property-text", "bookmarks.right.info.os").innerHTML = comp.os;
				GetDataFromItem("opm-part-bookmarks-property-text", "bookmarks.right.info.ram").innerHTML = comp.ram;
				GetDataFromItem("opm-part-bookmarks-property-text", "bookmarks.right.info.processor").innerHTML = comp.processor;
				GetDataFromItem("opm-part-bookmarks-property-text", "bookmarks.right.info.ipaddress").innerHTML = comp.ipaddress;
				GetDataFromItem("opm-part-bookmarks-property-text", "bookmarks.right.info.harddisk").innerHTML = comp.harddisk;
				GetDataFromItem("opm-part-bookmarks-property-text", "bookmarks.right.info.harddiskserial").innerHTML = comp.harddiskserial;
				GetDataFromItem("opm-part-bookmarks-property-text", "bookmarks.right.info.graphicscard").innerHTML = comp.graphicscard;
				GetDataFromItem("opm-part-bookmarks-property-text", "bookmarks.right.info.lastactiondate").innerHTML = comp.lastactiondate;
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
		data:{bookmarks:"computerloginevents",serialnumber:e.getAttribute('data-serialnumber'),piece:0},
		success:function(data){
			var loginevents = data;
			loginevents = JSON.parse(loginevents);
			var item = GetDataFromItem("opm-table-tbody", "bookmarks.right.blade.table");
			item.innerHTML = '';
			for (var i = 0; i < loginevents.length; i++) {
				SetDataToItem("opm-table-tbody", "bookmarks.right.blade.table", item.innerHTML + "<tr><td>" + loginevents[i].login + "</td><td>" + loginevents[i].actiontype + "</td><td>" + loginevents[i].time + "</td></tr>");
			}
		}
	});
	
	var item_loadmore = GetDataFromItem("opm-load-more", "bookmarks.right.loadmore");
	item_loadmore.setAttribute('data-count', 1);
	item_loadmore.setAttribute('data-serialnumber', e.getAttribute('data-serialnumber'));
	
	var item_addtobookmarks = GetDataFromItem("opm-blade-button-purple", "bookmarks.right.addtobookmarks");
	item_addtobookmarks.setAttribute('data-id', e.getAttribute('data-id'));
	
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{bookmarks:"getcomputerbookmarkinfo",computerid:e.getAttribute('data-id')},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "1")
			{
				var item = GetDataFromItem("opm-blade-button-purple", "bookmarks.right.addtobookmarks");
				item.classList.add("opm-part-bookmarks-pin");
			}
			else if(data == "2")
			{
				var item = GetDataFromItem("opm-blade-button-purple", "bookmarks.right.addtobookmarks");
				item.classList.remove("opm-part-bookmarks-pin");
			}
			else
			{
				alert("Please log off and log on the system")
			}
		}
	});
}

function addComputerToBookmarksBookmaks(){
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{bookmarks:"addcomputertobookmarks",computerid:GetDataFromItem("opm-blade-button-purple", "bookmarks.right.addtobookmarks").getAttribute('data-id')},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "1")
			{
				var item = GetDataFromItem("opm-blade-button-purple", "bookmarks.right.addtobookmarks");
				item.classList.remove("opm-part-bookmarks-pin");
			}
			else if(data == "2")
			{
				var item = GetDataFromItem("opm-blade-button-purple", "bookmarks.right.addtobookmarks");
				item.classList.add("opm-part-bookmarks-pin");
			}
			else
			{
				alert("Please log off and log on the system")
			}
		}
	});
}

function showMoreLogineventsBookmarksBladeRight(e){
	var count = parseInt(e.getAttribute('data-count'));
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{bookmarks:"computerloginevents",serialnumber:e.getAttribute('data-serialnumber'),piece:count},
		success:function(data){
			var loginevents = data;
			loginevents = JSON.parse(loginevents);
			for (var i = 0; i < loginevents.length; i++) {
				SetDataToItem("opm-table-tbody", "bookmarks.right.blade.table", GetDataFromItem("opm-table-tbody", "bookmarks.right.blade.table").innerHTML + "<tr><td>" + loginevents[i].login + "</td><td>" + loginevents[i].actiontype + "</td><td>" + loginevents[i].time + "</td></tr>");
			}
			count = count + 1;
			e.setAttribute('data-count', count);
		}
	});
}