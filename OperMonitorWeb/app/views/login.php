<html>
	<head>
		<title>Oper Monitor System - Login</title>
		<link href="app/views/css/login.css" rel="stylesheet">
		<script src="app/views/js/jquery.js"></script>
		<link href="icon.ico" rel="shortcut icon">
	</head>
	<body>
		<div class="login_panel">
			<div class="login_inner_container">
				<div class="inner_container cred">
					<div class="login_workload_logo_container">
						<h3 class="display-4" style="font-size:35px;">Oper Monitor System</h3>
					</div>
					<div class="login_workload_padding_container"></div>
					<div class="login_cta_container normaltext">
						<div>Enter your account credentials</div>
					</div>
					<div class="login_cred_field_container">
						<form method="post" action="index.php">
							<div id="cred_userid_container" class="login_textfield textfield">
								<span class="input_field textfield">
									<div class="input_border">
										<input id="cred_userid_inputtext" class="login_textfield textfield required email field normaltext" placeholder="login" type="text" name="login" alt="login" aria-label="User login" required autofocus>
									</div>
								</span>
							</div>
							<div id="cred_password_container" class="login_textfield textfield" style="opacity: 1;">
								<span class="input_field textfield">
									<div class="input_border">
										<input id="cred_password_inputtext" class="login_textfield textfield required field normaltext" placeholder="password" aria-label="password" alt="password" type="password" name="password" required>
									</div>
								</span>
							</div>
							<div class="login_splitter_control"></div>
							<button type="submit" class="button-sign-in normaltext">Sign in</button>
						</form>
					</div>
					<div class="normaltext redtext">
						<?php
							if(!empty($params))
							{
								if($params[0] == 1)
									echo 'Password is wrong';
								else if($params[0] == 2)
									echo 'Account with this login not found or incorrect';
								else if($params[0] == 3)
									echo 'User account is blocked or banned';
							}
						?>
					</div>
					<div class="login_footer_container">
						<div class="footer_inner_container">
							<div id="footer_table" class="footer_block">
								<div class="corporate_footer">
									<div>
										<span class="footer_link text-caption" id="footer_copyright_link">© 2016 - 2017 OperMon</span>
									</div>
								</div>
								<div class="footer_glyph">
									<a href="index.php"><img src="app/views/img/opermon_logo.png"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
<html>