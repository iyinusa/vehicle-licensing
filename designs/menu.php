<?php
	$sub_menus = '';
	
	if(isset($_SESSION['v_name']))
	{
		$ew_name = $_SESSION['v_name'];
		
		echo '
			<ul>
				<li><a href="'.$root.'/">Home</a></li>
				<li><a href="'.$root.'/state/">State</a></li>
				<li><a href="'.$root.'/format/">Plate Format</a></li>
				<li><a href="'.$root.'/number/">Plate Numbers</a></li>
				<li><a href="'.$root.'/vehicle/">License</a></li>
				<li><a href="'.$root.'/signout/">Sign Out</a></li>
			</ul>
		';
	} else
	{
		echo '
			<ul>
				<li><a href="'.$root.'/">Home</a></li>
				<li><a href="'.$root.'/search/">License Verification</a></li>
				<li><a href="'.$root.'/about/">About</a></li>
			</ul>
		';
	}
?>