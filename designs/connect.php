<?php
	//start session
	session_start();
	
	$db_host = "localhost";
	$db_username = "root";
	$db_pass = "root";
	$db_name = "vlsdb";
	
	mysql_connect("$db_host","$db_username","$db_pass") or die(mysql_error());
	mysql_select_db("$db_name") or die("Database Connection Error");
	
	$root = 'http://'.$_SERVER['HTTP_HOST'].'/vls';;
?>