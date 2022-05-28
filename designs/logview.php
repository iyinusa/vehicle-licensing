<?php
	if(isset($_SESSION['v_name']))
	{
		$ew_name = $_SESSION['v_name'];
		
		echo '
			<div class="lv_left">
				<a href="'.$root.'/index.php"><img src="'.$root.'/images/home.png" /> Home</a>
			</div>
			<div class="lv_right">
				Welcome <b><a href="#">'.$ew_name.'</a></b> [ <a href="'.$root.'/logout.php">LogOut</a> ]
			</div>
		';
	} else
	{
		echo '
			<div class="lv_left">
				<a href="'.$root.'/index.php"><img src="'.$root.'/images/home.png" />Home</a>
			</div>
			<div class="lv_right">
				Welcome <b>Guest</b> [ <a href="'.$root.'/login.php">Log In</a> or <a href="'.$root.'/register.php">Create Accout</a> ]
			</div>
		';
	}
?>