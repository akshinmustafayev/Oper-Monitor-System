<?php 
	$user = new User($login->GetUser());
?>
<html>
	<head>
		<title>Oper Monitor System - Portal</title>
		<link href="app/views/css/style.css" rel="stylesheet">
		<?php if($user->Access("access_computers", "1")) { ?>
		<link href="app/views/css/allcomputers/allcomputers.css" rel="stylesheet">
		<?php } ?>
		
		<?php if($user->Access("access_bookmarks", "1")) { ?>
		<link href="app/views/css/bookmarks/bookmarks.css" rel="stylesheet">
		<?php } ?>
		
		<?php if($user->Access("access_login_events", "1")) { ?>
		<link href="app/views/css/loginevents/loginevents.css" rel="stylesheet">
		<?php } ?>
		
		<?php if($user->Access("access_monitoring", "1")) { ?>
		<link href="app/views/css/monitoring/monitoring.css" rel="stylesheet">
		<?php } ?>
		
		<?php if($user->Access("access_messages", "1")) { ?>
		<link href="app/views/css/messages/messages.css" rel="stylesheet">
		<?php } ?>
		
		<?php if($user->Access("access_users", "1")) { ?>
		<link href="app/views/css/users/users.css" rel="stylesheet">
		<?php } ?>
		
		<script src="app/views/js/jquery.js"></script>
		<script src="app/views/js/opermon.min.js"></script>
		<?php if($user->Access("access_computers", "1")) { ?>
		<script src="app/views/js/allcomputers/allcomputers.js"></script>
		<?php } ?>
		
		<?php if($user->Access("access_bookmarks", "1")) { ?>
		<script src="app/views/js/bookmarks/bookmarks.js"></script>
		<?php } ?>
		
		<?php if($user->Access("access_login_events", "1")) { ?>
		<script src="app/views/js/loginevents/loginevents.js"></script>
		<?php } ?>
		
		<?php if($user->Access("access_monitoring", "1")) { ?>
		<script src="app/views/js/html2canvas.js"></script>
		<script src="app/views/js/jspdf.min.js"></script>
		<script src="app/views/js/monitoring/monitoring.js"></script>
		<?php } ?>
		
		<?php if($user->Access("access_messages", "1")) { ?>
		<script src="app/views/js/messages/messages.js"></script>
		<?php } ?>
		
		<?php if($user->Access("access_users", "1")) { ?>
		<script src="app/views/js/users/users.js"></script>
		<?php } ?>
		
		<script type="text/javascript" src="app/views/js/chartsloader.js"></script>
		<link href="icon.ico" rel="shortcut icon">
	</head>
	<body class="opm-container" onload="Startup()">
		<div class="opm-container">
			<div class="opm-topbar">
				<a href="index.php" class="opm-topbar-home opm-hover-default">Oper monitor system</a>
				<div class="opm-breadcrumb"></div>
				<a class="opm-topbar-button opm-hover-default" title="Settings" onclick="showSettingsPannel()"><img src="app/views/img/settings_topbar.png"></a>
				<div class="opm-avatarmenu">
					<button id="userButton" class="opm-avatarmenu-button opm-hover-default" onclick="openUserMenu()"><?php echo $user->Name(); ?> <?php echo $user->Surname(); ?></button>
					<div id="userMenu" class="opm-dropmenu">
						<div class="opm-dropmenu-content">
							<ul>
								<li>
									<a href="index.php?logout" class="opm-hover-default">
										<div class="opm-dropmenu-list-content">Sign Out</div>
										<div class="opm-dropmenu-list-image"><img src="app/views/img/useraccount_signout.png"></div>
									</a>
								</li>
								<li>
									<a class="opm-hover-default" onclick="showSettingsPannel()">
										<div class="opm-dropmenu-list-content">Change password</div>
										<div class="opm-dropmenu-list-image"><img src="app/views/img/useraccount_changepass.png"></div>
									</a>
								</li>
								<li>
									<a class="opm-hover-default" href="http://bkopermonitor/storage/" target="_blank">
										<div class="opm-dropmenu-list-content">Oper Monitor Storage</div>
										<div class="opm-dropmenu-list-image"><img src="app/views/img/opermonitorlogo.png"></div>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="opm-portal">
				<div class="opm-sidebar <?php if($user->Sidebar() == "0") { echo 'opm-sidebar-small'; } ?>">
					<ul>
						<li class="opm-sidebar-item opm-hover-default">
							<a class="opm-sidebar-item-link" onclick="opmSidebarChangeType()">
								<div class="opm-sidebar-item-icon"><img src="app/views/img/expand.png"></div>
							</a>
						</li>
						<div class="opm-sidebar-separator"></div>
						<li class="opm-sidebar-item opm-hover-default">
							<a class="opm-sidebar-item-link" onclick="showDashboard()">
								<div class="opm-sidebar-item-icon"><img src="app/views/img/dashboard.png"></div>
								<div class="opm-sidebar-item-label <?php if($user->Sidebar() == "0") { echo 'opm-hidden'; } ?>">Dashboard</div>
							</a>
						</li>
						<div class="opm-sidebar-separator"></div>
						
						<?php if($user->Access("access_computers", "1")) { ?>
						<li class="opm-sidebar-item opm-hover-default">
							<a class="opm-sidebar-item-link" onclick="showAllComputers()">
								<div class="opm-sidebar-item-icon"><img src="app/views/img/computer.png"></div>
								<div class="opm-sidebar-item-label <?php if($user->Sidebar() == "0") { echo 'opm-hidden'; } ?>">All computers</div>
							</a>
						</li>
						<?php } ?>
						
						<?php if($user->Access("access_bookmarks", "1")) { ?>
						<li class="opm-sidebar-item opm-hover-default">
							<a class="opm-sidebar-item-link" onclick="showBookmarks()">
								<div class="opm-sidebar-item-icon"><img src="app/views/img/bookmarks.png"></div>
								<div class="opm-sidebar-item-label <?php if($user->Sidebar() == "0") { echo 'opm-hidden'; } ?>">Bookmarks</div>
							</a>
						</li>
						<?php } ?>
						
						<?php if($user->Access("access_login_events", "1")) { ?>
						<li class="opm-sidebar-item opm-hover-default">
							<a class="opm-sidebar-item-link" onclick="showLoginevents()">
								<div class="opm-sidebar-item-icon"><img src="app/views/img/loginevents.png"></div>
								<div class="opm-sidebar-item-label <?php if($user->Sidebar() == "0") { echo 'opm-hidden'; } ?>">Login events</div>
							</a>
						</li>
						<?php } ?>
						
						<?php if($user->Access("access_monitoring", "1")) { ?>
						<li class="opm-sidebar-item opm-hover-default">
							<a class="opm-sidebar-item-link" onclick="showMonitoring()">
								<div class="opm-sidebar-item-icon"><img src="app/views/img/monitoring.png"></div>
								<div class="opm-sidebar-item-label <?php if($user->Sidebar() == "0") { echo 'opm-hidden'; } ?>">Monitoring</div>
							</a>
						</li>
						<?php } ?>
						
						<?php if($user->Access("access_messages", "1")) { ?>
						<li class="opm-sidebar-item opm-hover-default">
							<a class="opm-sidebar-item-link" onclick="showMessages()">
								<div class="opm-sidebar-item-icon"><img src="app/views/img/messages.png"></div>
								<div class="opm-sidebar-item-label <?php if($user->Sidebar() == "0") { echo 'opm-hidden'; } ?>">Messages</div>
							</a>
						</li>
						<?php } ?>
						
						<?php if($user->Access("access_users", "1")) { ?>
						<li class="opm-sidebar-item opm-hover-default">
							<a class="opm-sidebar-item-link" onclick="showUsers()">
								<div class="opm-sidebar-item-icon"><img src="app/views/img/users.png"></div>
								<div class="opm-sidebar-item-label <?php if($user->Sidebar() == "0") { echo 'opm-hidden'; } ?>">Users</div>
							</a>
						</li>
						<?php } ?>
					</ul>
				</div>
				<div class="opm-settingspane opm-hidden">
					<button type="button" class="opm-settingspane-close" title="Close" onclick="hideSettingsPannel()">
						<img src="app/views/img/close.png">
					</button>
					<div class="opm-settingspane-content">
						<div class="opm-settingspane-upper">
							<h2 class="opm-settingspane-header">Oper Monitor System settings</h2>
							<p class="opm-settingspane-user">Login : <?php echo $user->Login(); ?><br>Name : <?php echo $user->Name(); ?><br>Surname : <?php echo $user->Surname(); ?><br>Last login date : <?php echo $user->Logindate(); ?><br>Sidebar state : <?php echo ($user->Sidebar() == '0') ? "Small" : "Expanded"; ?>
							</p>
							<div class="opm-settingspane-separator"></div>
						</div>
						<div class="opm-settingspane-middle">
							<div class="opm-settingspane-labelcontainer">
								<label>Change password</label>
								<input placeholder="New password" data-info="opermon.settings.password.new" class="opm-input-text opm-margin-top-two" type="password">
								<input placeholder="Confirm password" data-info="opermon.settings.password.confirm" class="opm-input-text opm-margin-top-two" type="password">
							</div>
							<div class="opm-settingspane-labelcontainer">
								<label>Domain</label>
								<input placeholder="Domain" data-info="opermon.settings.domain" class="opm-input-text opm-margin-top-two" type="text" value="<?php echo $user->Domain(); ?>">
							</div>
							<div class="opm-settingspane-labelcontainer">
								<label class="opm-red-message opm-hidden" data-info="opermon.settings.error">Done</label>
							</div>
						</div>
						<div class="opm-settingspane-bottom">
							<div class="opm-settingspane-separator"></div>
							<div class="opm-button-default" onclick="applyUserSettings()">Apply</div>
							<div class="opm-button-gray" onclick="hideSettingsPannel()" style="margin-left:10px;">Cancel</div>
						</div>
					</div>
				</div>
				<div id="RootBlade" class="opm-portal-content">
					<div class="opm-dashboard">
						<div class="opm-dashboard-users">
							<h3 class="opm-dashboard-users-header">Users online</h3>
							<div class="opm-dashboard-users-content" data-info="dashboard.users.content">
							</div>
						</div>
						<div class="opm-dashboard-content">
							<div class="opm-dashboard-messages-container">
								<h4 class="opm-dashboard-messages-header">News</h4>
								<div class="opm-dashboard-messages" data-info="dashboard.messages">
								</div>
							</div>
							<div class="opm-dashboard-items">
								<div class="opm-dashboard-item">
									<canvas width="160px" height="160px" class="opm-dashboard-clock" data-info="dashboard.clock"></canvas>
								</div>
							</div>
						</div>
					</div>
					
					<?php if($user->Access("access_computers", "1")) { ?>
					<div id="AllCompsBlade" class="opm-portal-content opm-portal-blades opm-portal-js opm-hidden">
						<div id="AllCompsBladeLeft" class="opm-blade-left opm-portal-blades opm-portal-js opm-hidden">
							<div class="opm-blade-left-header opm-blade-left-header-border">
								<div class="opm-blade-left-header-title">All computers</div>
								<div class="opm-blade-left-header-actions">
									<button type="button" class="opm-blade-close" title="Hide" onclick="hideAllComputersLeft()">
										<img src="app/views/img/close.png">
									</button>
								</div>
							</div>
							<div class="opm-blade-left-content opm-blade-left-content-border">
								<div class="opm-blade-commandbar">
									<ul class="opm-blade-commandbar-itemlist">
										<?php if($user->Access("access_computers_add", "1")) { ?>
										<li class="opm-blade-commandbar-item opm-hover-light" onclick="createComputerShow()">
											<div class="opm-blade-commandbar-item-icon"><img src="app/views/img/add_icon.png"></div>
											<div class="opm-blade-commandbar-item-label">Add</div>
										</li>
										<?php } ?>
										<li class="opm-blade-commandbar-item opm-hover-light" onclick="showComputersBladeLeft()">
											<div class="opm-blade-commandbar-item-icon"><img src="app/views/img/refresh.png"></div>
											<div class="opm-blade-commandbar-item-label">Refresh</div>
										</li>
									</ul>
								</div>
								<div class="opm-blade-left-content-long">
									<?php if($user->Access("access_computers_add", "1")) { ?>
									<div class="opm-part-two opm-hidden" data-info="allcomputers.left.add.pannel" style="margin-bottom:15px;">
										<table class="opm-grid-table">
											<tbody>
												<tr>
													<td>
														Computer Name <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<input data-info="allcomputers.left.add.computername" class="opm-input-text" type="text" placeholder="computer name">
													</td>
												</tr>
												<tr>
													<td>
														Serial number <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<input data-info="allcomputers.left.add.serialnumber" class="opm-input-text" type="text" placeholder="serial number">
													</td>
												</tr>
												<tr>
													<td>
														System name <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<input data-info="allcomputers.left.add.systemname" class="opm-input-text" type="text" placeholder="system name">
													</td>
												</tr>
												<tr>
													<td>
														Computer vendor <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<input data-info="allcomputers.left.add.computervendor" class="opm-input-text" type="text" placeholder="computer vendor">
													</td>
												</tr>
												<tr>
													<td>
														Domain <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<input data-info="allcomputers.left.add.domain" class="opm-input-text" type="text" placeholder="domain">
													</td>
												</tr>
												<tr>
													<td>
														Operating system <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<input data-info="allcomputers.left.add.os" class="opm-input-text" type="text" placeholder="operating system">
													</td>
												</tr>
												<tr>
													<td>
														RAM <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<input data-info="allcomputers.left.add.ram" class="opm-input-text" type="text" placeholder="ram">
													</td>
												</tr>
												<tr>
													<td>
														Processor <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<input data-info="allcomputers.left.add.processor" class="opm-input-text" type="text" placeholder="processor">
													</td>
												</tr>
												<tr>
													<td>
														IP address <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<input data-info="allcomputers.left.add.ipaddress" class="opm-input-text" type="text" placeholder="ip address">
													</td>
												</tr>
												<tr>
													<td>
														Hard disk <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<input data-info="allcomputers.left.add.harddisk" class="opm-input-text" type="text" placeholder="hard disk">
													</td>
												</tr>
												<tr>
													<td>
														Hard disk serial <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<input data-info="allcomputers.left.add.harddiskserial" class="opm-input-text" type="text" placeholder="hard disk serial">
													</td>
												</tr>
												<tr>
													<td>
														Graphics card <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<input data-info="allcomputers.left.add.graphicscard" class="opm-input-text" type="text" placeholder="graphics card">
													</td>
												</tr>
												<tr>
													<td>
														Last action date <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<input data-info="allcomputers.left.add.lastactiondate" class="opm-input-text" type="text" placeholder="last action date">
													</td>
												</tr>
											</tbody>
										</table>
										<div class="opm-users-adduser-buttons">
											<div class="opm-button-default" onclick="createComputer()">Add</div>
											<div class="opm-button-gray" style="margin-left:10px;" onclick="createComputerClean()">Clean</div>
											<div class="opm-button-gray" style="margin-left:10px;" onclick="createComputerHide()">Close</div>
											<div data-info="users.left.add.message" class="opm-red-message opm-hidden"></div>
										</div>
									</div>
									<?php } ?>
									
									<div class="opm-inline-flex opm-part-allcomputers-padding">
										<input class="opm-input-text" data-info="allcomputers.left.searchcomputer.input" type="text" placeholder="search computer..." onkeypress="onEnterPressedSearchAllComps(event)">
										<select class="opm-default-select opm-part-allcomputers-select" data-info="allcomputers.left.searchcomputer.select">
											<option value="1" selected>System name</option>
											<option value="2">Computer name</option>
											<option value="3">Serial number</option>
											<option value="4">Computer vendor</option>
											<option value="5">Domain</option>
											<option value="6">Operating system</option>
											<option value="7">Ram</option>
											<option value="8">Processor</option>
											<option value="9">Ip address</option>
											<option value="10">Hard disk</option>
											<option value="11">Hard disk serial</option>
											<option value="12">Graphics card</option>
											<option value="13">Last action date</option>
										</select>
										<button class="opm-button-default" onclick="searchComputer()">Search</button>
									</div>
									<div class="opm-label-default opm-part-allcomputers-padding" data-info="allcomputers.left.itemscount"></div>
									<table class="opm-grid-table opm-part-allcomputers-padding">
										<thead>
											<tr>
												<th>System name</th>
												<th data-info="allcomputers.left.table.hide" class="opm-grid-hide">Computer name</th>
												<th>Serial number</th>
												<th data-info="allcomputers.left.table.hide" class="opm-grid-hide">Operating system</th>
											</tr>
										</thead>
										<tbody data-info="allcomputers.left.table.tbody" class="opm-table-tbody">
											
										</tbody>
									</table>
									<div class="opm-load-more" data-info="allcomputers.left.loadmore" data-count="1" onclick="showMoreComputersBladeLeft(this)">Load more</div>
									<div class="opm-load-more" data-info="allcomputers.left.loadmoresearch" data-count="1" style="visibility:hidden;" onclick="showMoreSearchComputer(this)">Load more (search)</div>
								</div>
							</div>
						</div>
						<div id="AllCompsBladeRight" class="opm-blade-right opm-portal-blades opm-portal-js opm-hidden">
							<div class="opm-blade-right-header">
								<span class="opm-blade-right-header-icon"><img src="app/views/img/computer.png"></span>
								<div data-info="allcomputers.right.blade.header" class="opm-blade-right-header-title"></div>
								<div class="opm-blade-right-header-actions">
									<button type="button" class="opm-blade-button-purple" data-id="" data-hashid="" data-token="" data-info="allcomputers.right.addtobookmarks" title="Add to bookmarks" onclick="addComputerToBookmarks()">
										<img src="app/views/img/pin.png">
									</button>
									<button type="button" class="opm-blade-button-red" title="Hide" onclick="hideAllComputersRight()">
										<img src="app/views/img/close.png">
									</button>
								</div>
							</div>
							<div class="opm-blade-right-content">
								<div class="opm-blade-right-content-long">
									<div class="opm-part-one opm-part-allcomputers">
										<ul>
											<li>
												<label class="opm-part-allcomputers-property-name">Computer name</label>
												<label data-info="allcomputers.right.info.computername" class="opm-part-allcomputers-property-text"></label>
											</li>
											<li>
												<label class="opm-part-allcomputers-property-name">Serial Number</label>
												<label data-info="allcomputers.right.info.serialnumber" class="opm-part-allcomputers-property-text"></label>
											</li>
											<li>
												<label class="opm-part-allcomputers-property-name">System name</label>
												<label data-info="allcomputers.right.info.systemname" class="opm-part-allcomputers-property-text"></label>
											</li>
											<li>
												<label class="opm-part-allcomputers-property-name">Computer vendor</label>
												<label data-info="allcomputers.right.info.computervendor" class="opm-part-allcomputers-property-text"></label>
											</li>
											<li>
												<label class="opm-part-allcomputers-property-name">Domain</label>
												<label data-info="allcomputers.right.info.domain" class="opm-part-allcomputers-property-text"></label>
											</li>
											<li>
												<label class="opm-part-allcomputers-property-name">Operating system</label>
												<label data-info="allcomputers.right.info.os" class="opm-part-allcomputers-property-text"></label>
											</li>
											<li>
												<label class="opm-part-allcomputers-property-name">Ram</label>
												<label data-info="allcomputers.right.info.ram" class="opm-part-allcomputers-property-text"></label>
											</li>
											<li>
												<label class="opm-part-allcomputers-property-name">Processor</label>
												<label data-info="allcomputers.right.info.processor" class="opm-part-allcomputers-property-text"></label>
											</li>
											<li>
												<label class="opm-part-allcomputers-property-name">IP address</label>
												<label data-info="allcomputers.right.info.ipaddress" class="opm-part-allcomputers-property-text"></label>
											</li>
											<li>
												<label class="opm-part-allcomputers-property-name">Hard disk</label>
												<label data-info="allcomputers.right.info.harddisk" class="opm-part-allcomputers-property-text"></label>
											</li>
											<li>
												<label class="opm-part-allcomputers-property-name">Hard disk serial</label>
												<label data-info="allcomputers.right.info.harddiskserial" class="opm-part-allcomputers-property-text"></label>
											</li>
											<li>
												<label class="opm-part-allcomputers-property-name">Graphics card</label>
												<label data-info="allcomputers.right.info.graphicscard" class="opm-part-allcomputers-property-text"></label>
											</li>
											<li>
												<label class="opm-part-allcomputers-property-name">Last action date</label>
												<label data-info="allcomputers.right.info.lastactiondate" class="opm-part-allcomputers-property-text"></label>
											</li>
											<li>
												<label class="opm-part-allcomputers-property-name">Path variable</label>
												<label data-info="allcomputers.right.info.pathvariable" class="opm-part-allcomputers-property-text"></label>
											</li>
										</ul>
									</div>
									<div class="opm-blade-right-content-long-inner">
										<table class="opm-grid-table">
											<thead>
												<tr>
													<th>Login</th>
													<th>Action type</th>
													<th>Time</th>
												</tr>
											</thead>
											<tbody data-info="allcomputers.right.blade.table" class="opm-table-tbody">
												<tr>
													<td>No login events</td>
													<td></td>
													<td></td>
												</tr>
											</tbody>
										</table>
										<div class="opm-load-more" data-serialnumber="" data-hashid="" data-token="" data-info="allcomputers.right.loadmore" data-count="1" onclick="showMoreLogineventsBladeRight(this)">Load more</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					
					<?php if($user->Access("access_bookmarks", "1")) { ?>
					<div id="BookmarksBlade" class="opm-portal-content opm-portal-blades opm-portal-js opm-hidden">
						<div id="BookmarksBladeLeft" class="opm-blade-left opm-portal-blades opm-portal-js opm-hidden">
							<div class="opm-blade-left-header opm-blade-left-header-border">
								<div class="opm-blade-left-header-title">Bookmarks</div>
								<div class="opm-blade-left-header-actions">
									<button type="button" class="opm-blade-close" title="Hide" onclick="hideBookmarksLeft()">
										<img src="app/views/img/close.png">
									</button>
								</div>
							</div>
							<div class="opm-blade-left-content opm-blade-left-content-border">
								<div class="opm-blade-commandbar">
									<ul class="opm-blade-commandbar-itemlist">
										<li class="opm-blade-commandbar-item opm-hover-light" onclick="showBookmarksBladeLeft()">
											<div class="opm-blade-commandbar-item-icon"><img src="app/views/img/refresh.png"></div>
											<div class="opm-blade-commandbar-item-label">Refresh</div>
										</li>
									</ul>
								</div>
								<div class="opm-blade-left-content-long opm-blade-left-content-padding">
									<div class="opm-inline-flex">
										<input class="opm-input-text" data-info="bookmarks.left.searchcomputer.input" type="text" placeholder="search computer...">
										<select class="opm-default-select opm-part-bookmarks-select" data-info="bookmarks.left.searchcomputer.select">
											<option value="1" selected>System name</option>
											<option value="2">Computer name</option>
											<option value="3">Serial number</option>
											<option value="4">Computer vendor</option>
											<option value="5">Domain</option>
											<option value="6">Operating system</option>
											<option value="7">Ram</option>
											<option value="8">Processor</option>
											<option value="9">Ip address</option>
											<option value="10">Hard disk</option>
											<option value="11">Hard disk serial</option>
											<option value="12">Graphics card</option>
											<option value="13">Last action date</option>
										</select>
										<button class="opm-button-default" onclick="searchBookmarkComputer()">Search</button>
									</div>
									<div class="opm-label-default" data-info="bookmarks.left.itemscount"></div>
									<table class="opm-grid-table">
										<thead>
											<tr>
												<th>System name</th>
												<th data-info="bookmarks.left.table.hide" class="opm-grid-hide">Computer name</th>
												<th>Serial number</th>
												<th data-info="bookmarks.left.table.hide" class="opm-grid-hide">Operating system</th>
											</tr>
										</thead>
										<tbody data-info="bookmarks.left.table.tbody" class="opm-table-tbody">
											
										</tbody>
									</table>
									<div class="opm-load-more" data-info="bookmarks.left.loadmore" data-count="1" onclick="showMoreBookmarksBladeLeft(this)">Load more</div>
									<div class="opm-load-more" data-info="bookmarks.left.loadmoresearch" data-count="1" style="visibility:hidden;" onclick="showMoreSearchBookmarks(this)">Load more (search)</div>
								</div>
							</div>
						</div>
						<div id="BookmarksBladeRight" class="opm-blade-right opm-portal-blades opm-portal-js opm-hidden">
							<div class="opm-blade-right-header">
								<span class="opm-blade-right-header-icon"><img src="app/views/img/bookmarks.png"></span>
								<div data-info="bookmarks.right.blade.header" class="opm-blade-right-header-title"></div>
								<div class="opm-blade-right-header-actions">
									<button type="button" class="opm-blade-button-purple" data-id="" data-hashid="" data-token="" data-info="bookmarks.right.addtobookmarks" title="Add to bookmarks" onclick="addComputerToBookmarksBookmaks()">
										<img src="app/views/img/pin.png">
									</button>
									<button type="button" class="opm-blade-button-red" title="Hide" onclick="hideBookmarksRight()">
										<img src="app/views/img/close.png">
									</button>
								</div>
							</div>
							<div class="opm-blade-right-content">
								<div class="opm-blade-right-content-long">
									<div class="opm-part-one opm-part-bookmarks">
										<ul>
											<li>
												<label class="opm-part-bookmarks-property-name">Computer name</label>
												<label data-info="bookmarks.right.info.computername" class="opm-part-bookmarks-property-text"></label>
											</li>
											<li>
												<label class="opm-part-bookmarks-property-name">Serial Number</label>
												<label data-info="bookmarks.right.info.serialnumber" class="opm-part-bookmarks-property-text"></label>
											</li>
											<li>
												<label class="opm-part-bookmarks-property-name">System name</label>
												<label data-info="bookmarks.right.info.systemname" class="opm-part-bookmarks-property-text"></label>
											</li>
											<li>
												<label class="opm-part-bookmarks-property-name">Computer vendor</label>
												<label data-info="bookmarks.right.info.computervendor" class="opm-part-bookmarks-property-text"></label>
											</li>
											<li>
												<label class="opm-part-bookmarks-property-name">Domain</label>
												<label data-info="bookmarks.right.info.domain" class="opm-part-bookmarks-property-text"></label>
											</li>
											<li>
												<label class="opm-part-bookmarks-property-name">Operating system</label>
												<label data-info="bookmarks.right.info.os" class="opm-part-bookmarks-property-text"></label>
											</li>
											<li>
												<label class="opm-part-bookmarks-property-name">Ram</label>
												<label data-info="bookmarks.right.info.ram" class="opm-part-bookmarks-property-text"></label>
											</li>
											<li>
												<label class="opm-part-bookmarks-property-name">Processor</label>
												<label data-info="bookmarks.right.info.processor" class="opm-part-bookmarks-property-text"></label>
											</li>
											<li>
												<label class="opm-part-bookmarks-property-name">IP address</label>
												<label data-info="bookmarks.right.info.ipaddress" class="opm-part-bookmarks-property-text"></label>
											</li>
											<li>
												<label class="opm-part-bookmarks-property-name">Hard disk</label>
												<label data-info="bookmarks.right.info.harddisk" class="opm-part-bookmarks-property-text"></label>
											</li>
											<li>
												<label class="opm-part-bookmarks-property-name">Hard disk serial</label>
												<label data-info="bookmarks.right.info.harddiskserial" class="opm-part-bookmarks-property-text"></label>
											</li>
											<li>
												<label class="opm-part-bookmarks-property-name">Graphics card</label>
												<label data-info="bookmarks.right.info.graphicscard" class="opm-part-bookmarks-property-text"></label>
											</li>
											<li>
												<label class="opm-part-bookmarks-property-name">Last action date</label>
												<label data-info="bookmarks.right.info.lastactiondate" class="opm-part-bookmarks-property-text"></label>
											</li>
											<li>
												<label class="opm-part-bookmarks-property-name">Path variable</label>
												<label data-info="bookmarks.right.info.pathvariable" class="opm-part-bookmarks-property-text"></label>
											</li>
										</ul>
									</div>
									<div class="opm-blade-right-content-long-inner">
										<table class="opm-grid-table">
											<thead>
												<tr>
													<th>Login</th>
													<th>Action type</th>
													<th>Time</th>
												</tr>
											</thead>
											<tbody data-info="bookmarks.right.blade.table" class="opm-table-tbody">
												<tr>
													<td>No login events</td>
													<td></td>
													<td></td>
												</tr>
											</tbody>
										</table>
										<div class="opm-load-more" data-serialnumber="" data-hashid="" data-token="" data-info="bookmarks.right.loadmore" data-count="1" onclick="showMoreLogineventsBookmarksBladeRight(this)">Load more</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					
					<?php if($user->Access("access_login_events", "1")) { ?>
					<div id="LogineventsBlade" class="opm-portal-content opm-portal-blades opm-portal-js opm-hidden">
						<div id="LogineventsBladeLeft" class="opm-blade-left opm-portal-blades opm-portal-js opm-hidden">
							<div class="opm-blade-left-header opm-blade-left-header-border">
								<div class="opm-blade-left-header-title">Login events</div>
								<div class="opm-blade-left-header-actions">
									<button type="button" class="opm-blade-close" title="Hide" onclick="hideLogineventsLeft()">
										<img src="app/views/img/close.png">
									</button>
								</div>
							</div>
							<div class="opm-blade-left-content opm-blade-left-content-border">
								<div class="opm-blade-commandbar">
									<ul class="opm-blade-commandbar-itemlist">
										<li class="opm-blade-commandbar-item opm-hover-light" onclick="clearLogineventsSearch()">
											<div class="opm-blade-commandbar-item-icon"><img src="app/views/img/refresh.png"></div>
											<div class="opm-blade-commandbar-item-label">Clear</div>
										</li>
									</ul>
								</div>
								<div class="opm-blade-left-content-long">
									<div class="opm-part-two opm-loginevents-search">
										<table>
											<tr>
												<td>
													<label class="opm-loginevents-search-property">Serial number</label>
													<input data-info="loginevents.left.searchproperty.serialnumber" class="opm-input-text" type="text" placeholder="serial number" onkeypress="onEnterPressedSearch(event)">
												</td>
												<td class="opm-loginevents-search-right">
													<label class="opm-loginevents-search-property">Action</label>
													<select data-info="loginevents.left.searchproperty.action" class="opm-loginevents-dropdown">
														<option value="0">Any</option>
														<option value="1">Login</option>
														<option value="2">Log off</option>
													</select>
												</td>
											</tr>
											<tr>
												<td class="opm-loginevents-search-table-td">
													<label class="opm-loginevents-search-property">System name</label>
													<input data-info="loginevents.left.searchproperty.systemname" class="opm-input-text" type="text" placeholder="computer name" onkeypress="onEnterPressedSearch(event)">
													<select data-info="loginevents.left.searchproperty.systemname.value" class="opm-loginevents-dropdown opm-loginevents-margin">
														<option value="0">Contains</option>
														<option value="1">Starts with</option>
														<option value="2">Ends with</option>
														<option value="3">Equals</option>
													</select>
												</td>
												<td class="opm-loginevents-search-table-td opm-loginevents-search-right">
													<label class="opm-loginevents-search-property">Login</label>
													<input data-info="loginevents.left.searchproperty.login" class="opm-input-text" type="text" placeholder="login" onkeypress="onEnterPressedSearch(event)">
													<select data-info="loginevents.left.searchproperty.login.value" class="opm-loginevents-dropdown opm-loginevents-margin">
														<option value="0">Contains</option>
														<option value="1">Starts with</option>
														<option value="2">Ends with</option>
														<option value="3">Equals</option>
													</select>
												</td>
											</tr>
										</table>
										<div class="opm-loginevents-search-buttons">
											<div data-info="loginevents.left.search.apply" class="opm-button-default" onclick="logineventsSearch()">Search</div>
											<div data-info="loginevents.left.search.cancel" class="opm-button-gray" style="margin-left:10px;" onclick="resetLogineventsSearch()">Reset</div>
											<div data-info="loginevents.left.search.error" class="opm-red-message opm-hidden"></div>
										</div>
									</div>
									<table class="opm-grid-table opm-loginevents-table">
										<thead>
											<tr>
												<th>System name</th>
												<th>Serial number</th>
												<th>Login</th>
												<th>Action type</th>
												<th>Time</th>
											</tr>
										</thead>
										<tbody data-info="loginevents.left.search.table" class="opm-table-tbody">
											<tr>
												<td>No login events</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div id="LogineventsBladeRight" class="opm-blade-right opm-portal-blades opm-portal-js opm-hidden">
							<div class="opm-blade-right-header">
								<span class="opm-blade-right-header-icon"><img src="app/views/img/computer.png"></span>
								<div data-info="allcomputers.right.blade.header" class="opm-blade-right-header-title"></div>
								<div class="opm-blade-right-header-actions">
									<button type="button" class="opm-blade-button-red" title="Hide" onclick="hideLogineventsRight()">
										<img src="app/views/img/close.png">
									</button>
								</div>
							</div>
							<div class="opm-blade-right-content">
								<div class="opm-blade-right-content-long">
									
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					
					<?php if($user->Access("access_monitoring", "1")) { ?>
					<div id="MonitoringBlade" class="opm-portal-content opm-portal-blades opm-portal-js opm-hidden">
						<div id="MonitoringBladeLeft" class="opm-blade-left opm-portal-blades opm-portal-js opm-hidden">
							<div class="opm-blade-left-header opm-blade-left-header-border">
								<div class="opm-blade-left-header-title">Monitoring</div>
								<div class="opm-blade-left-header-actions">
									<button type="button" class="opm-blade-close" title="hide" onclick="hideMonitoringLeft()">
										<img src="app/views/img/close.png">
									</button>
								</div>
							</div>
							<div class="opm-blade-left-content opm-blade-left-content-border">
								<div class="opm-blade-commandbar">
									<ul class="opm-blade-commandbar-itemlist">
										<li class="opm-blade-commandbar-item opm-hover-light" onclick="loadMonitoringInfo()">
											<div class="opm-blade-commandbar-item-icon"><img src="app/views/img/refresh.png"></div>
											<div class="opm-blade-commandbar-item-label">Refresh</div>
										</li>
										<li class="opm-blade-commandbar-item opm-hover-light" onclick="exportToPdfMonitoringInfo()">
											<div class="opm-blade-commandbar-item-icon"><img src="app/views/img/export.png"></div>
											<div class="opm-blade-commandbar-item-label">Export</div>
										</li>
									</ul>
								</div>
								<div id="MonitoringExport" class="opm-blade-left-content-long">
									<div data-info="monitoring.left.loading" class="opm-monitoring-loading">
										<div class="wBall" id="wBall_1">
											<div class="wInnerBall"></div>
										</div>
										<div class="wBall" id="wBall_2">
											<div class="wInnerBall"></div>
										</div>
										<div class="wBall" id="wBall_3">
											<div class="wInnerBall"></div>
										</div>
										<div class="wBall" id="wBall_4">
											<div class="wInnerBall"></div>
										</div>
										<div class="wBall" id="wBall_5">
											<div class="wInnerBall"></div>
										</div>
									</div>
									
									<div data-info="monitoring.left.pieprocessorusage" id="pieprocessorusage" class="opm-monitoring-pie opm-hidden" style="width:100%;"></div>
									<div data-info="monitoring.left.pieramusage" id="pieramusage" class="opm-monitoring-pie opm-hidden" style="width:100%;"></div>
									<div data-info="monitoring.left.piediskusage" id="piediskusage" class="opm-monitoring-pie opm-hidden" style="width:100%;"></div>
									
									<div id="MonitoringExportItem1" data-info="monitoring.left.part.computerscount" class="opm-monitoring-part opm-hidden">
										<div class="opm-monitoring-title">
											<h4>Computers</h4>
										</div>
										<div class="opm-monitoring-content">
											<div class="opm-monitoring-content-info">
												<ul>
													<li>
														<div class="opm-monitoring-content-infoup">Total computers count</div>
														<div data-info="monitoring.left.part.computerscount.value" class="opm-monitoring-content-infodown"></div>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div id="MonitoringExportItem2" data-info="monitoring.left.part.logineventscount" class="opm-monitoring-part opm-hidden">
										<div class="opm-monitoring-title">
											<h4>Login events</h4>
										</div>
										<div class="opm-monitoring-content">
											<div class="opm-monitoring-content-info">
												<ul>
													<li>
														<div class="opm-monitoring-content-infoup">Login events</div>
														<div data-info="monitoring.left.part.logineventscount.value" class="opm-monitoring-content-infodown"></div>
													</li>
													<li>
														<div class="opm-monitoring-content-infoup">Login events today</div>
														<div data-info="monitoring.left.part.logineventscounttoday.value" class="opm-monitoring-content-infodown"></div>
													</li>
													<li>
														<div class="opm-monitoring-content-infoup">Login events for last week</div>
														<div data-info="monitoring.left.part.logineventscountweek.value" class="opm-monitoring-content-infodown"></div>
													</li>
													<li>
														<div class="opm-monitoring-content-infoup">Login events for last month</div>
														<div data-info="monitoring.left.part.logineventscountmonth.value" class="opm-monitoring-content-infodown"></div>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					
					<?php if($user->Access("access_messages", "1")) { ?>
					<div id="MessagesBlade" class="opm-portal-content opm-portal-blades opm-portal-js opm-hidden">
						<div id="MessagesBladeLeft" class="opm-blade-left opm-portal-blades opm-portal-js opm-hidden">
							<div class="opm-blade-left-header opm-blade-left-header-border">
								<div class="opm-blade-left-header-title">Messages</div>
								<div class="opm-blade-left-header-actions">
									<button type="button" class="opm-blade-close" title="hide" onclick="hideMessagesLeft()">
										<img src="app/views/img/close.png">
									</button>
								</div>
							</div>
							<div class="opm-blade-left-content opm-blade-left-content-border">
								<div class="opm-blade-commandbar">
									<ul class="opm-blade-commandbar-itemlist">
										<li class="opm-blade-commandbar-item opm-hover-light" onclick="createMessageShow()">
											<div class="opm-blade-commandbar-item-icon"><img src="app/views/img/add_icon.png"></div>
											<div class="opm-blade-commandbar-item-label">Add</div>
										</li>
										<li class="opm-blade-commandbar-item opm-hover-light" onclick="showMessages()">
											<div class="opm-blade-commandbar-item-icon"><img src="app/views/img/refresh.png"></div>
											<div class="opm-blade-commandbar-item-label">Refresh</div>
										</li>
									</ul>
								</div>
								<div class="opm-blade-left-content-long">
									<div class="opm-part-two opm-hidden" data-info="messages.left.add.pannel" style="margin-bottom:15px;">
										<table class="opm-grid-table">
											<tbody>
												<tr>
													<td>
														Header <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<textarea class="opm-textarea" data-info="messages.left.add.header" type="text" placeholder="header"></textarea>
													</td>
												</tr>
												<tr>
													<td>
														Text <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<textarea class="opm-textarea" data-info="messages.left.add.text" type="text" placeholder="text"></textarea>
													</td>
												</tr>
												<tr>
													<td>
														Visible <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<input class="opm-checkbox" data-info="messages.left.add.visibility" id="message_visibility_add" type="checkbox" checked="checked">
													</td>
												</tr>
											</tbody>
										</table>
										<div class="opm-users-adduser-buttons">
											<div class="opm-button-default" onclick="createMessage()">Add</div>
											<div class="opm-button-gray" style="margin-left:10px;" onclick="createMessageClean()">Clean</div>
											<div class="opm-button-gray" style="margin-left:10px;" onclick="createMessageHide()">Close</div>
											<div data-info="messages.left.add.message" class="opm-red-message opm-hidden"></div>
										</div>
									</div>
									<table class="opm-grid-table opm-users-table">
										<thead>
											<tr>
												<th>Header</th>
												<th data-info="messages.left.table.hide" class="opm-grid-hide">Text</th>
											</tr>
										</thead>
										<tbody data-info="messages.left.table.tbody" class="opm-table-tbody">
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div id="MessagesBladeRight" class="opm-blade-right opm-portal-blades opm-portal-js opm-hidden">
							<div class="opm-blade-right-header">
								<span class="opm-blade-right-header-icon"><img src="app/views/img/messages.png"></span>
								<div data-id="" data-info="messages.right.blade.header" class="opm-blade-right-header-title"></div>
								<div class="opm-blade-right-header-actions">
									<button type="button" class="opm-blade-button-red" title="Hide" onclick="hideMessagesRight()">
										<img src="app/views/img/close.png">
									</button>
								</div>
							</div>
							<div class="opm-blade-right-content">
								<div class="opm-blade-right-content-long">
									<div class="opm-blade-right-content-long-inner">
										<div> 
											<div class="opm-label-default" style="padding-bottom:10px;">Header</div>
											<textarea class="opm-textarea" data-info="messages.right.blade.textarea.header" type="text" placeholder="text"></textarea>
											<div class="opm-label-default" style="padding-bottom:10px;">Text</div>
											<textarea class="opm-textarea" data-info="messages.right.blade.textarea.text" type="text" placeholder="text"></textarea>
											<br>
											<div class="opm-label-default" style="padding-bottom:10px;">Visibility</div>
											<input class="opm-checkbox" data-info="messages.right.blade.visibility" id="message_visibility" type="checkbox">
											<label for="message_visibility">Visible</label>
											<br>
											<h6 class="opm-red-message opm-hidden" data-info="messages.right.blade.label.message" style="margin:0px;"></h6>
											<button class="opm-button-default" onclick="changeMessageText()" style="margin-top: 10px;">Change</button>
										</div>
										<div class="opm-separator"></div>
										<div> 
											<div class="opm-label-default" style="padding-bottom:10px;">Delete message</div>
											<h6 class="opm-red-message opm-hidden" data-info="messages.right.blade.label.delete" style="margin:0px;"></h6>
											<button class="opm-button-red" onclick="deleteMessage()" style="margin-top: 10px;">Delete</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					
					<?php if($user->Access("access_users", "1")) { ?>
					<div id="UsersBlade" class="opm-portal-content opm-portal-blades opm-portal-js opm-hidden">
						<div id="UsersBladeLeft" class="opm-blade-left opm-portal-blades opm-portal-js opm-hidden">
							<div class="opm-blade-left-header opm-blade-left-header-border">
								<div class="opm-blade-left-header-title">Users</div>
								<div class="opm-blade-left-header-actions">
									<button type="button" class="opm-blade-close" title="Hide" onclick="hideUsersLeft()">
										<img src="app/views/img/close.png">
									</button>
								</div>
							</div>
							<div class="opm-blade-left-content opm-blade-left-content-border">
								<div class="opm-blade-commandbar">
									<ul class="opm-blade-commandbar-itemlist">
										<?php if($user->Access("access_users_add", "1")) { ?>
										<li class="opm-blade-commandbar-item opm-hover-light" onclick="addUserShow()">
											<div class="opm-blade-commandbar-item-icon"><img src="app/views/img/add_icon.png"></div>
											<div class="opm-blade-commandbar-item-label">Add</div>
										</li>
										<?php } ?>
										<li class="opm-blade-commandbar-item opm-hover-light" onclick="showUsers()">
											<div class="opm-blade-commandbar-item-icon"><img src="app/views/img/refresh.png"></div>
											<div class="opm-blade-commandbar-item-label">Refresh</div>
										</li>
									</ul>
								</div>
								<div class="opm-blade-left-content-long">
								
									<?php if($user->Access("access_users_add", "1")) { ?>
									<div class="opm-part-two opm-hidden" data-info="users.left.add.panel">
										<table class="opm-grid-table">
											<tbody>
												<tr>
													<td>
														Name <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<input data-info="users.left.add.name" class="opm-input-text" type="text" placeholder="name">
													</td>
												</tr>
												<tr>
													<td>
														Surname <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<input data-info="users.left.add.surname" class="opm-input-text" type="text" placeholder="surname">
													</td>
												</tr>
												<tr>
													<td>
														Login <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<input data-info="users.left.add.login" class="opm-input-text" type="text" placeholder="login">
													</td>
												</tr>
												<tr>
													<td>
														Password <h6 class="opm-red-message" style="display:inline;">*</h6>
													</td>
													<td>
														<input data-info="users.left.add.password" class="opm-input-text" type="text" placeholder="password">
													</td>
												</tr>
											</tbody>
										</table>
										<div class="opm-users-adduser-buttons">
											<div class="opm-button-default" onclick="createUser()">Add</div>
											<div class="opm-button-gray" style="margin-left:10px;" onclick="addUserClean()">Clean</div>
											<div class="opm-button-gray" style="margin-left:10px;" onclick="addUserHide()">Close</div>
											<div data-info="users.left.add.message" class="opm-red-message opm-hidden"></div>
										</div>
									</div>
									<?php } ?>
									
									<table class="opm-grid-table opm-users-table">
										<thead>
											<tr>
												<th>Login</th>
												<th data-info="users.left.table.hide" class="opm-grid-hide">Name</th>
												<th data-info="users.left.table.hide" class="opm-grid-hide">Surname</th>
												<th>Access</th>
												<th data-info="users.left.table.hide" class="opm-grid-hide">Last login date</th>
											</tr>
										</thead>
										<tbody data-info="users.left.table.tbody" class="opm-table-tbody">
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div id="UsersBladeRight" class="opm-blade-right opm-portal-blades opm-portal-js opm-hidden">
							<div class="opm-blade-right-header">
								<span class="opm-blade-right-header-icon"><img src="app/views/img/user.png"></span>
								<div data-id="" data-login="" data-info="users.right.blade.header" class="opm-blade-right-header-title"></div>
								<div class="opm-blade-right-header-actions">
									<button type="button" class="opm-blade-button-red" title="Hide" onclick="hideUsersRight()">
										<img src="app/views/img/close.png">
									</button>
								</div>
							</div>
							<div class="opm-blade-right-content">
								<div class="opm-blade-right-content-long">
									<div class="opm-blade-right-content-long-inner">
										<div> 
											<div class="opm-label-default" style="padding-bottom:10px;">Name</div>
											<input class="opm-input-text" data-info="users.right.blade.input.name" type="text" placeholder="name">
											<div class="opm-label-default" style="padding-bottom:10px;">Surname</div>
											<input class="opm-input-text" data-info="users.right.blade.input.surname" type="text" placeholder="surname">
											<h6 class="opm-red-message opm-hidden" data-info="users.right.blade.label.namesurname" style="margin:0px;"></h6>
											<button class="opm-button-default" onclick="changeUserNamesurname()" style="margin-top: 10px;">Change</button>
										</div>
										<div class="opm-separator"></div>
										<div> 
											<div class="opm-label-default" style="padding-bottom:10px;">Change password</div>
											<input class="opm-input-text" data-info="users.right.blade.input.password" type="text" placeholder="new password">
											<h6 class="opm-red-message opm-hidden" data-info="users.right.blade.label.password" style="margin:0px;"></h6>
											<button class="opm-button-default" onclick="changeUserPassword()" style="margin-top: 10px;">Change</button>
										</div>
										<div class="opm-separator"></div>
										<div> 
											<div class="opm-label-default" style="padding-bottom:10px;">Log off user</div>
											<h6 class="opm-red-message opm-hidden" data-info="users.right.blade.label.logoff" style="margin:0px;"></h6>
											<button class="opm-button-gray" onclick="logOffUser()" style="margin-top: 10px;">Log off</button>
										</div>
										<div class="opm-separator"></div>
										<div> 
											<div class="opm-label-default" style="padding-bottom:10px;">Delete user</div>
											<h6 class="opm-red-message opm-hidden" data-info="users.right.blade.label.delete" style="margin:0px;"></h6>
											<button class="opm-button-red" onclick="deleteUser()" style="margin-top: 10px;">Delete</button>
										</div>
										<div class="opm-separator"></div>
										<div> 
											<div class="opm-label-default" style="padding-bottom:10px;">Access list</div>
											<p>
												<input class="opm-checkbox" data-info="users.right.blade.access.comps" id="access_comps" type="checkbox">
												<label for="access_comps">Computers</label>
												<br>
												<input class="opm-checkbox" data-info="users.right.blade.access.compsadd" id="access_compsadd" type="checkbox">
												<label for="access_compsadd">Computer Add</label>
												<br>
												<input class="opm-checkbox" data-info="users.right.blade.access.bookmarks" id="access_bookmarks" type="checkbox">
												<label for="access_bookmarks">Bookmarks</label>
												<br>
												<input class="opm-checkbox" data-info="users.right.blade.access.loginevents" id="access_loginevents" type="checkbox">
												<label for="access_loginevents">Login events</label>
												<br>
												<input class="opm-checkbox" data-info="users.right.blade.access.monitoring" id="access_monitoring" type="checkbox">
												<label for="access_monitoring">Monitoring</label>
												<br>
												<input class="opm-checkbox" data-info="users.right.blade.access.messages" id="access_messages" type="checkbox">
												<label for="access_messages">Messages</label>
												<br>
												<input class="opm-checkbox" data-info="users.right.blade.access.users" id="access_users" type="checkbox">
												<label for="access_users">Users</label>
												<br>
												<input class="opm-checkbox" data-info="users.right.blade.access.usersadd" id="access_usersadd" type="checkbox">
												<label for="access_usersadd">User add</label>
											</p>
											<h6 class="opm-red-message opm-hidden" data-info="users.right.blade.label.access" style="margin:0px;"></h6>
											<button class="opm-button-default" onclick="changeUserAccess()" style="margin-top: 10px;">Change</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					
				</div>
			</div>
		</div>
		<script src="app/views/js/clock.min.js"></script>
	</body>
<html>