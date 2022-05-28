<?php
	//include files
	include('../designs/connect.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign Out</title>
<link rel="stylesheet" type="text/css" href="../style/lay.css"/>
</head>

<body>
	<div id="all">
    	<div id="header">
        	<?php include('../designs/header.php'); ?>
        </div>
        
        <div id="menu">
        	<?php include('../designs/menu.php'); ?>
        </div>
        
        <div id="main">
            <div>
            	<h2>Sign out</h2>
            </div>
            <?php
				session_destroy();
				
				echo 'You have signed out from the system.<br /><a href="'.$root.'/">Click here</a> to continue';
			?>
        </div>
        
        <div id="footer">
        	<?php include('../designs/footer.php'); ?>
        </div>
    </div>
</body>
</html>