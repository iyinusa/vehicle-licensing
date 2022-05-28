<?php
	$msg = '';
	
	if(isset($_POST['btnLogin'])) {
		$r_name = $_POST['r_name'];
		$r_password = $_POST['r_password'];
		
		if(!$r_name || !$r_password) {
			$msg = '<div class="msg">All fields are required</div>';
		} else {
			$log = mysql_query("SELECT * FROM user WHERE username='$r_name' AND password='$r_password' LIMIT 1");
			if(mysql_num_rows($log) <= 0) {
				$msg = '<div class="msg">Wrong username or password</div>';
			} else {
				while($row = mysql_fetch_assoc($log)) {
					$user = $row['username'];
					$pass = $row['password'];
				}
				
				session_register('v_name');
				$_SESSION['v_name'] = $user;
				
				header('location: state/');
			}
		}
	}
	
	echo $msg;
?>