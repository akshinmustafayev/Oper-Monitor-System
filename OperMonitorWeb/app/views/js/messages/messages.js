function showMessages() {
	hideAllPannels();
	document.getElementById("RootBlade").classList.remove("opm-hidden");
	document.getElementById("MessagesBlade").classList.remove("opm-hidden");
	document.getElementById("MessagesBladeLeft").classList.remove("opm-hidden");
	document.getElementById("MessagesBladeLeft").classList.add("opm-blade-left-long");
	BladeLeftTableToggle("messages.left.table.hide", false);
	showMessagesBladeLeft();
	hideDashboardPannel();
	loadMonitoringInfo();
}

function hideMessagesLeft(){
	document.getElementById("RootBlade").classList.remove("opm-hidden");
	document.getElementById("MessagesBlade").classList.add("opm-hidden");
	document.getElementById("MessagesBladeLeft").classList.add("opm-hidden");
	document.getElementById("MessagesBladeLeft").classList.remove("opm-blade-left-long");
	BladeLeftTableToggle("messages.left.table.hide", false);
	showDashboardPannel();
}

function hideMessagesRight(){
	document.getElementById("RootBlade").classList.remove("opm-hidden");
	document.getElementById("MessagesBladeLeft").classList.add("opm-blade-left-long");
	document.getElementById("MessagesBladeRight").classList.add("opm-hidden");
	BladeLeftTableToggle("messages.left.table.hide", false);
}

function showMessagesRight(){
	document.getElementById("MessagesBladeLeft").classList.remove("opm-blade-left-long");
	document.getElementById("MessagesBladeRight").classList.remove("opm-hidden");
	BladeLeftTableToggle("messages.left.table.hide", true);
}


function showMessagesBladeLeft(){
	hideMessagesRight();
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{messages:"getmessages"},
		success:function(data){
			if(data == "-100")
			{
				alert("You dont have access to see that");
			}
			else
			{
				SetDataToItem("opm-table-tbody" ,"messages.left.table.tbody", data);
			}
		}
	});
}

function showMessageInfo(e){
	GetDataFromItem("opm-red-message", "messages.right.blade.label.delete").classList.add("opm-hidden");
	GetDataFromItem("opm-red-message", "messages.right.blade.label.message").classList.add("opm-hidden");
	showMessagesRight();
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{messages:"messageinfo",messageid:e.getAttribute('data-id')},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "0")
			{
				alert("hacking attempt detected");
			}
			else if(data == "1")
			{
				alert("such message not found or hacking attempt");
			}
			else if(data == "-100")
			{
				alert("You dont have access to see that");
			}
			else
			{
				var message = data;
				message = message.replace('','');
				message = JSON.parse(message);
				SetDataToItem("opm-blade-right-header-title", "messages.right.blade.header", message.header)
				GetDataFromItem("opm-textarea", "messages.right.blade.textarea.header").value = message.header;
				var messageheaderH = parseInt(GetDataFromItem("opm-textarea", "messages.right.blade.textarea.text").scrollHeight);
				messageheaderH = messagetextH;
				GetDataFromItem("opm-textarea", "messages.right.blade.textarea.header").style.height = (messageheaderH)+"px";
				GetDataFromItem("opm-textarea", "messages.right.blade.textarea.text").value = message.messagetext;
				var messagetextH = parseInt(GetDataFromItem("opm-textarea", "messages.right.blade.textarea.text").scrollHeight);
				messagetextH = messagetextH;
				GetDataFromItem("opm-textarea", "messages.right.blade.textarea.text").style.height = (messagetextH)+"px";
				if(message.visible == "1")
					document.getElementById("message_visibility").checked = true;
				else
					document.getElementById("message_visibility").checked = false;
				GetDataFromItem("opm-blade-right-header-title", "messages.right.blade.header").setAttribute('data-id', e.getAttribute('data-id'));
			}
		}
	});
}

function changeMessageText(){
	GetDataFromItem("opm-red-message", "messages.right.blade.label.message").classList.add("opm-hidden");
	var messageid = GetDataFromItem("opm-blade-right-header-title", "messages.right.blade.header").getAttribute('data-id');
	var messageheader = GetDataFromItem("opm-textarea", "messages.right.blade.textarea.header").value;
	var messagetext = GetDataFromItem("opm-textarea", "messages.right.blade.textarea.text").value;
	
	var messagevisible = "0";
	if(document.getElementById("message_visibility").checked == true)
		messagevisible = "1";
	
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{messages:"changemessage",messageid:messageid,messageheader:messageheader,messagetext:messagetext,messagevisible:messagevisible},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "0")
			{
				alert("hacking attempt detected");
				GetDataFromItem("opm-red-message", "messages.right.blade.label.message").innerHTML = "Hacking attempt detected";
				GetDataFromItem("opm-red-message", "messages.right.blade.label.message").classList.remove("opm-hidden");
			}
			else if(data == "-100")
			{
				GetDataFromItem("opm-red-message", "messages.right.blade.label.message").innerHTML = "You dont have access to do that";
				GetDataFromItem("opm-red-message", "messages.right.blade.label.message").classList.remove("opm-hidden");
			}
			else if(data == "2")
			{
				GetDataFromItem("opm-red-message", "messages.right.blade.label.message").innerHTML = "Something went wrong";
				GetDataFromItem("opm-red-message", "messages.right.blade.label.message").classList.remove("opm-hidden");
			}
			else if(data == "1")
			{
				GetDataFromItem("opm-red-message", "messages.right.blade.label.message").innerHTML = "Successfully changed";
				GetDataFromItem("opm-red-message", "messages.right.blade.label.message").classList.remove("opm-hidden");
			}
		}
	});
}

function deleteMessage(){
	GetDataFromItem("opm-red-message", "messages.right.blade.label.delete").classList.add("opm-hidden");
	var messageiditem = GetDataFromItem("opm-blade-right-header-title", "messages.right.blade.header").getAttribute('data-id');
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{messages:"deletemessage",messageid:messageiditem},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "0")
			{
				alert("hacking attempt detected");
				GetDataFromItem("opm-red-message", "messages.right.blade.label.delete").innerHTML = "Hacking attempt detected";
				GetDataFromItem("opm-red-message", "messages.right.blade.label.delete").classList.remove("opm-hidden");
			}
			else if(data == "-100")
			{
				GetDataFromItem("opm-red-message", "messages.right.blade.label.delete").innerHTML = "You dont have access to do that";
				GetDataFromItem("opm-red-message", "messages.right.blade.label.delete").classList.remove("opm-hidden");
			}
			else if(data == "2")
			{
				GetDataFromItem("opm-red-message", "messages.right.blade.label.delete").innerHTML = "Something went wrong";
				GetDataFromItem("opm-red-message", "messages.right.blade.label.delete").classList.remove("opm-hidden");
			}
			else if(data == "1")
			{
				showMessages();
			}
		}
	});
}

function createMessageShow(){
	GetDataFromItem("opm-part-two", "messages.left.add.pannel").classList.remove("opm-hidden");
}

function createMessageHide(){
	GetDataFromItem("opm-part-two", "messages.left.add.pannel").classList.add("opm-hidden");
}

function createMessageClean(){
	GetDataFromItem("opm-textarea", "messages.left.add.header").value = "";
	GetDataFromItem("opm-textarea", "messages.left.add.text").value = "";
	document.getElementById("message_visibility_add").checked = true;
}

function createMessage(){
	if(GetDataFromItem("opm-textarea", "messages.left.add.header").value == "" || GetDataFromItem("opm-textarea", "messages.left.add.text").value == "")
	{
		GetDataFromItem("opm-red-message", "messages.left.add.message").innerHTML = "Enter all fields marked with red dot";
		GetDataFromItem("opm-red-message", "messages.left.add.message").classList.remove("opm-hidden");
	}
	else
	{
		GetDataFromItem("opm-red-message", "messages.left.add.message").innerHTML = "";
		GetDataFromItem("opm-red-message", "messages.left.add.message").classList.add("opm-hidden");
		
		var messageheader = GetDataFromItem("opm-textarea", "messages.left.add.header").value;
		var messagetextvalue = GetDataFromItem("opm-textarea", "messages.left.add.text").value;
		var messagevisible = "0";
		if(document.getElementById("message_visibility_add").checked == true)
			messagevisible = "1";
		
		$.ajax({
			type:"GET",
			url:"index.php",
			data:{messages:"createmessage",header:messageheader,messagetext:messagetextvalue,visibility:messagevisible},
			success:function(data){
				data = jQuery.trim(data);
				if(data == "0")
				{
					GetDataFromItem("opm-red-message", "messages.left.add.message").innerHTML = "Hacking attempt detected";
					GetDataFromItem("opm-red-message", "messages.left.add.message").classList.remove("opm-hidden");
				}
				else if(data == "-100")
				{
					GetDataFromItem("opm-red-message", "messages.left.add.message").innerHTML = "You dont have access to do that";
					GetDataFromItem("opm-red-message", "messages.left.add.message").classList.remove("opm-hidden");
				}
				else if(data == "1")
				{
					GetDataFromItem("opm-red-message", "messages.left.add.message").innerHTML = "Successfully done!";
					GetDataFromItem("opm-red-message", "messages.left.add.message").classList.remove("opm-hidden");
					showMessages();
				}
				else if(data == "2")
				{
					GetDataFromItem("opm-red-message", "messages.left.add.message").innerHTML = "Unknown error. Message was not add!";
					GetDataFromItem("opm-red-message", "messages.left.add.message").classList.remove("opm-hidden");
				}
			}
		});
	}
}