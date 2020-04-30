function showUsers() {
	hideAllPannels();
	document.getElementById("RootBlade").classList.remove("opm-hidden");
	document.getElementById("UsersBlade").classList.remove("opm-hidden");
	document.getElementById("UsersBladeLeft").classList.remove("opm-hidden");
	document.getElementById("UsersBladeLeft").classList.add("opm-blade-left-long");
	document.getElementById("UsersBladeRight").classList.add("opm-hidden");
	BladeLeftTableToggle("users.left.table.hide", false);
	showUsersBladeLeft();
	hideDashboardPannel();
}

function hideUsersLeft(){
	document.getElementById("RootBlade").classList.remove("opm-hidden");
	document.getElementById("UsersBlade").classList.add("opm-hidden");
	document.getElementById("UsersBladeLeft").classList.add("opm-hidden");
	document.getElementById("UsersBladeLeft").classList.remove("opm-blade-left-long");
	document.getElementById("UsersBladeRight").classList.add("opm-hidden");
	BladeLeftTableToggle("users.left.table.hide", false);
	showDashboardPannel();
}

function hideUsersRight(){
	document.getElementById("RootBlade").classList.remove("opm-hidden");
	document.getElementById("UsersBladeLeft").classList.add("opm-blade-left-long");
	document.getElementById("UsersBladeRight").classList.add("opm-hidden");
	BladeLeftTableToggle("users.left.table.hide", false);
}

function showUsersRight(){
	document.getElementById("UsersBladeLeft").classList.remove("opm-blade-left-long");
	document.getElementById("UsersBladeRight").classList.remove("opm-hidden");
	BladeLeftTableToggle("users.left.table.hide", true);
}

function addUserShow(){
	GetDataFromItem("opm-part-two", "users.left.add.panel").classList.remove("opm-hidden");
}

function addUserHide(){
	GetDataFromItem("opm-part-two", "users.left.add.panel").classList.add("opm-hidden");
}

function addUserClean(){
	GetDataFromItem("opm-input-text", "users.left.add.name").value = "";
	GetDataFromItem("opm-input-text", "users.left.add.surname").value = "";
	GetDataFromItem("opm-input-text", "users.left.add.login").value = "";
	GetDataFromItem("opm-input-text", "users.left.add.password").value = "";
	GetDataFromItem("opm-red-message", "users.left.add.message").classList.add("opm-hidden");
}

function createUser(){
	if(GetDataFromItem("opm-input-text", "users.left.add.name").value == "" || GetDataFromItem("opm-input-text", "users.left.add.surname").value == "" ||
		GetDataFromItem("opm-input-text", "users.left.add.login").value == "" || GetDataFromItem("opm-input-text", "users.left.add.password").value == "")
	{
		GetDataFromItem("opm-red-message", "users.left.add.message").innerHTML = "Enter all fields marked with red dot";
		GetDataFromItem("opm-red-message", "users.left.add.message").classList.remove("opm-hidden");
	}
	else
	{
		GetDataFromItem("opm-red-message", "users.left.add.message").innerHTML = "";
		GetDataFromItem("opm-red-message", "users.left.add.message").classList.add("opm-hidden");
		
		var usernameitem = GetDataFromItem("opm-input-text", "users.left.add.name").value;
		var usersurnameitem = GetDataFromItem("opm-input-text", "users.left.add.surname").value;
		var userloginitem = GetDataFromItem("opm-input-text", "users.left.add.login").value;
		var userpassworditem = GetDataFromItem("opm-input-text", "users.left.add.password").value;
		
		$.ajax({
			type:"GET",
			url:"index.php",
			data:{users:"createuser",username:usernameitem,usersurname:usersurnameitem,userlogin:userloginitem,userpassword:userpassworditem},
			success:function(data){
				data = jQuery.trim(data);
				if(data == "0")
				{
					GetDataFromItem("opm-red-message", "users.left.add.message").innerHTML = "Hacking attempt detected";
					GetDataFromItem("opm-red-message", "users.left.add.message").classList.remove("opm-hidden");
				}
				else if(data == "-100")
				{
					GetDataFromItem("opm-red-message", "users.left.add.message").innerHTML = "You dont have access to do that";
					GetDataFromItem("opm-red-message", "users.left.add.message").classList.remove("opm-hidden");
				}
				else if(data == "1")
				{
					GetDataFromItem("opm-red-message", "users.left.add.message").innerHTML = "This user with give login exists. Please set another login";
					GetDataFromItem("opm-red-message", "users.left.add.message").classList.remove("opm-hidden");
				}
				else if(data == "2")
				{
					GetDataFromItem("opm-red-message", "users.left.add.message").innerHTML = "Successfully done!";
					GetDataFromItem("opm-red-message", "users.left.add.message").classList.remove("opm-hidden");
					showUsers();
				}
				else if(data == "3")
				{
					GetDataFromItem("opm-red-message", "users.left.add.message").innerHTML = "Unknown error. User was not add!";
					GetDataFromItem("opm-red-message", "users.left.add.message").classList.remove("opm-hidden");
				}
				else if(data == "4")
				{
					GetDataFromItem("opm-red-message", "users.left.add.message").innerHTML = "Password must not be empty or less than 4 digits";
					GetDataFromItem("opm-red-message", "users.left.add.message").classList.remove("opm-hidden");
				}
			}
		});
	}
}

function showUsersBladeLeft(){
	hideUsersRight();
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{users:"getusers"},
		success:function(data){
			if(data == "-100")
			{
				alert("You dont have access to see that");
			}
			else
			{
				SetDataToItem("opm-table-tbody" ,"users.left.table.tbody", data);
			}
		}
	});
}

function showUserInfo(e){
	document.getElementById("access_comps").checked = false;
	document.getElementById("access_compsadd").checked = false;
	document.getElementById("access_bookmarks").checked = false;
	document.getElementById("access_loginevents").checked = false;
	document.getElementById("access_monitoring").checked = false;
	document.getElementById("access_users").checked = false;
	document.getElementById("access_usersadd").checked = false;
					
	showUsersRight();
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{users:"userinfo",userid:e.getAttribute('data-id'),userlogin:e.getAttribute('data-login')},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "0")
			{
				alert("hacking attempt detected");
			}
			else if(data == "1")
			{
				alert("such user not found or hacking attempt");
			}
			else if(data == "-100")
			{
				alert("You dont have access to see that");
			}
			else
			{
				var user = data;
				user = user.replace('','');
				user = JSON.parse(user);
				SetDataToItem("opm-blade-right-header-title", "users.right.blade.header", user.login)
				GetDataFromItem("opm-input-text", "users.right.blade.input.name").value = user.name;
				GetDataFromItem("opm-input-text", "users.right.blade.input.surname").value = user.surname;
				GetDataFromItem("opm-blade-right-header-title", "users.right.blade.header").setAttribute('data-id', e.getAttribute('data-id'));
				GetDataFromItem("opm-blade-right-header-title", "users.right.blade.header").setAttribute('data-login', e.getAttribute('data-login'));
			}
		}
	});
	
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{users:"getuseraccess",userid:e.getAttribute('data-id'),userlogin:e.getAttribute('data-login')},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "0")
			{
				alert("hacking attempt detected");
			}
			else if(data == "1")
			{
				alert("such user not found or hacking attempt");
			}
			else if(data == "-100")
			{
				alert("You dont have access to see that");
			}
			else
			{
				var useraccess = data;
				useraccess = JSON.parse(useraccess);
				if(useraccess.access_computers == "1")
					document.getElementById("access_comps").checked = true;
				else
					document.getElementById("access_comps").checked = false;
				if(useraccess.access_computers_add == "1")
					document.getElementById("access_compsadd").checked = true;
				else
					document.getElementById("access_compsadd").checked = false;
				if(useraccess.access_bookmarks == "1")
					document.getElementById("access_bookmarks").checked = true;
				else
					document.getElementById("access_bookmarks").checked = false;
				if(useraccess.access_login_events == "1")
					document.getElementById("access_loginevents").checked = true;
				else
					document.getElementById("access_loginevents").checked = false;
				if(useraccess.access_monitoring == "1")
					document.getElementById("access_monitoring").checked = true;
				else
					document.getElementById("access_monitoring").checked = false;
				if(useraccess.access_messages == "1")
					document.getElementById("access_messages").checked = true;
				else
					document.getElementById("access_messages").checked = false;
				if(useraccess.access_users == "1")
					document.getElementById("access_users").checked = true;
				else
					document.getElementById("access_users").checked = false;
				if(useraccess.access_users_add == "1")
					document.getElementById("access_usersadd").checked = true;
				else
					document.getElementById("access_usersadd").checked = false;
			}
		}
	});
	
	GetDataFromItem("opm-red-message", "users.right.blade.label.password").classList.add("opm-hidden");
	GetDataFromItem("opm-red-message", "users.right.blade.label.logoff").classList.add("opm-hidden");
	GetDataFromItem("opm-red-message", "users.right.blade.label.delete").classList.add("opm-hidden");
	GetDataFromItem("opm-red-message", "users.right.blade.label.access").classList.add("opm-hidden");
}

function changeUserPassword(){
	GetDataFromItem("opm-red-message", "users.right.blade.label.password").classList.add("opm-hidden");
	var useriditem = GetDataFromItem("opm-blade-right-header-title", "users.right.blade.header").getAttribute('data-id');
	var userpassworditem = GetDataFromItem("opm-input-text", "users.right.blade.input.password").value;
	
	if(userpassworditem == "" || userpassworditem.length < 4)
	{
		GetDataFromItem("opm-red-message", "users.right.blade.label.password").innerHTML = "Password must not be empty or less than 4 digits";
		GetDataFromItem("opm-red-message", "users.right.blade.label.password").classList.remove("opm-hidden");
		return;
	}
	
	showUsersRight();
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{users:"setuserpassword",userid:useriditem,userpassword:userpassworditem},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "0")
			{
				GetDataFromItem("opm-red-message", "users.right.blade.label.password").innerHTML = "Hacking attempt detected";
				GetDataFromItem("opm-red-message", "users.right.blade.label.password").classList.remove("opm-hidden");
			}
			else if(data == "-100")
			{
				GetDataFromItem("opm-red-message", "users.right.blade.label.password").innerHTML = "You dont have access to do that";
				GetDataFromItem("opm-red-message", "users.right.blade.label.password").classList.remove("opm-hidden");
			}
			else if(data == "2")
			{
				GetDataFromItem("opm-red-message", "users.right.blade.label.password").innerHTML = "Unknown error occured";
				GetDataFromItem("opm-red-message", "users.right.blade.label.password").classList.remove("opm-hidden");
			}
			else if(data == "3")
			{
				GetDataFromItem("opm-red-message", "users.right.blade.label.password").innerHTML = "Php returned that: Password must not be empty or less than 4 digits. May be hacking attempt";
				GetDataFromItem("opm-red-message", "users.right.blade.label.password").classList.remove("opm-hidden");
			}
			else if(data == "1")
			{
				GetDataFromItem("opm-red-message", "users.right.blade.label.password").innerHTML = "Successfully changed!";
				GetDataFromItem("opm-red-message", "users.right.blade.label.password").classList.remove("opm-hidden");
			}
		}
	});
}

function logOffUser(){
	GetDataFromItem("opm-red-message", "users.right.blade.label.logoff").classList.add("opm-hidden");
	var useriditem = GetDataFromItem("opm-blade-right-header-title", "users.right.blade.header").getAttribute('data-id');
	showUsersRight();
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{users:"logoffuser",userid:useriditem},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "0")
			{
				GetDataFromItem("opm-red-message", "users.right.blade.label.logoff").innerHTML = "hacking attempt detected";
				GetDataFromItem("opm-red-message", "users.right.blade.label.logoff").classList.remove("opm-hidden");
			}
			else if(data == "-100")
			{
				GetDataFromItem("opm-red-message", "users.right.blade.label.logoff").innerHTML = "You dont have access to do that";
				GetDataFromItem("opm-red-message", "users.right.blade.label.logoff").classList.remove("opm-hidden");
			}
			else if(data == "2")
			{
				GetDataFromItem("opm-red-message", "users.right.blade.label.logoff").innerHTML = "Something went wrong";
				GetDataFromItem("opm-red-message", "users.right.blade.label.logoff").classList.remove("opm-hidden");
			}
			else if(data == "1")
			{
				GetDataFromItem("opm-red-message", "users.right.blade.label.logoff").innerHTML = "Successfully logged off!";
				GetDataFromItem("opm-red-message", "users.right.blade.label.logoff").classList.remove("opm-hidden");
			}
		}
	});
}

function changeUserNamesurname(){
	GetDataFromItem("opm-red-message", "users.right.blade.label.namesurname").classList.add("opm-hidden");
	var useriditem = GetDataFromItem("opm-blade-right-header-title", "users.right.blade.header").getAttribute('data-id');
	var username = GetDataFromItem("opm-input-text", "users.right.blade.input.name").value;
	var usersurname = GetDataFromItem("opm-input-text", "users.right.blade.input.surname").value;
	showUsersRight();
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{users:"changeusernamesurname",userid:useriditem,username:username,usersurname:usersurname},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "0")
			{
				GetDataFromItem("opm-red-message", "users.right.blade.label.namesurname").innerHTML = "hacking attempt detected";
				GetDataFromItem("opm-red-message", "users.right.blade.label.namesurname").classList.remove("opm-hidden");
			}
			else if(data == "-100")
			{
				GetDataFromItem("opm-red-message", "users.right.blade.label.namesurname").innerHTML = "You dont have access to do that";
				GetDataFromItem("opm-red-message", "users.right.blade.label.namesurname").classList.remove("opm-hidden");
			}
			else if(data == "2")
			{
				GetDataFromItem("opm-red-message", "users.right.blade.label.namesurname").innerHTML = "Something went wrong";
				GetDataFromItem("opm-red-message", "users.right.blade.label.namesurname").classList.remove("opm-hidden");
			}
			else if(data == "1")
			{
				GetDataFromItem("opm-red-message", "users.right.blade.label.namesurname").innerHTML = "Successfully changed!";
				GetDataFromItem("opm-red-message", "users.right.blade.label.namesurname").classList.remove("opm-hidden");
			}
		}
	});
}

function deleteUser(){
	GetDataFromItem("opm-red-message", "users.right.blade.label.delete").classList.add("opm-hidden");
	var useriditem = GetDataFromItem("opm-blade-right-header-title", "users.right.blade.header").getAttribute('data-id');
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{users:"deleteuser",userid:useriditem},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "0")
			{
				alert("hacking attempt detected");
				GetDataFromItem("opm-red-message", "users.right.blade.label.delete").innerHTML = "Hacking attempt detected";
				GetDataFromItem("opm-red-message", "users.right.blade.label.delete").classList.remove("opm-hidden");
			}
			else if(data == "-100")
			{
				GetDataFromItem("opm-red-message", "users.right.blade.label.delete").innerHTML = "You dont have access to do that";
				GetDataFromItem("opm-red-message", "users.right.blade.label.delete").classList.remove("opm-hidden");
			}
			else if(data == "2")
			{
				GetDataFromItem("opm-red-message", "users.right.blade.label.delete").innerHTML = "Something went wrong";
				GetDataFromItem("opm-red-message", "users.right.blade.label.delete").classList.remove("opm-hidden");
			}
			else if(data == "1")
			{
				showUsers();
			}
		}
	});
}

function changeUserAccess(){
	GetDataFromItem("opm-red-message", "users.right.blade.label.access").classList.add("opm-hidden");
	var useriditem = GetDataFromItem("opm-blade-right-header-title", "users.right.blade.header").getAttribute('data-id');
	
	var acc_comps = "0", acc_compsadd = "0", acc_bookmarks = "0", acc_loginevents = "0", acc_monitoring = "0", acc_messages = "0", acc_users = "0", acc_usersadd = "0";
	if(document.getElementById("access_comps").checked == true)
		acc_comps = "1";
	if(document.getElementById("access_compsadd").checked == true)
		acc_compsadd = "1";
	if(document.getElementById("access_bookmarks").checked == true)
		acc_bookmarks = "1";
	if(document.getElementById("access_loginevents").checked == true)
		acc_loginevents = "1";
	if(document.getElementById("access_monitoring").checked == true)
		acc_monitoring = "1";
	if(document.getElementById("access_messages").checked == true)
		acc_messages = "1";
	if(document.getElementById("access_users").checked == true)
		acc_users = "1";
	if(document.getElementById("access_usersadd").checked == true)
		acc_usersadd = "1";
	
	var json_string = "{\"access_computers\":\"" + acc_comps + "\" ,\"access_computers_add\":\"" + acc_compsadd + "\" ,\"access_bookmarks\":\"" + acc_bookmarks + "\" ,\"access_login_events\":\"" + acc_loginevents + "\" ,\"access_monitoring\":\"" + acc_monitoring + "\" ,\"access_messages\":\"" + acc_messages + "\" ,\"access_users\":\"" + acc_users + "\" ,\"access_users_add\":\"" + acc_usersadd + "\"}";
	
	$.ajax({
		type:"GET",
		url:"index.php",
		data:{users:"changeuseraccess",userid:useriditem, useraccess:json_string},
		success:function(data){
			data = jQuery.trim(data);
			if(data == "0")
			{
				alert("hacking attempt detected");
				GetDataFromItem("opm-red-message", "users.right.blade.label.access").innerHTML = "Hacking attempt detected";
				GetDataFromItem("opm-red-message", "users.right.blade.label.access").classList.remove("opm-hidden");
			}
			else if(data == "-100")
			{
				GetDataFromItem("opm-red-message", "users.right.blade.label.access").innerHTML = "You dont have access to do that";
				GetDataFromItem("opm-red-message", "users.right.blade.label.access").classList.remove("opm-hidden");
			}
			else if(data == "2")
			{
				GetDataFromItem("opm-red-message", "users.right.blade.label.access").innerHTML = "Something went wrong";
				GetDataFromItem("opm-red-message", "users.right.blade.label.access").classList.remove("opm-hidden");
			}
			else if(data == "1")
			{
				GetDataFromItem("opm-red-message", "users.right.blade.label.access").innerHTML = "Successfully changed";
				GetDataFromItem("opm-red-message", "users.right.blade.label.access").classList.remove("opm-hidden");
			}
		}
	});
}
