<?php
	//include files
	include('designs/connect.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vehical License System</title>
<link rel="stylesheet" type="text/css" href="style/lay.css"/>
</head>

<body>
	<div id="all">
    	<div id="header">
        	<?php include('designs/header.php'); ?>
        </div>
        
        <div id="menu">
        	<?php include('designs/menu.php'); ?>
        </div>
        
        <div id="main">
        	<div>
            	<img src="images/v.jpg" width="800" />
            </div>
            <div>
            	<h2>Vehical License System</h2>
                
                <?php include('logics/login.php'); ?>
                
                <form action="<?php echo $root; ?>/" method="post" enctype="multipart/form-data" style="padding:10px;">
                	<b>Username:</b><br />
                    <input type="text" name="r_name" /><br /><br />
                    <b>Password:</b><br />
                    <input type="password" name="r_password" /><br /><br />
                    <input type="submit" name="btnLogin" value="Sign In" />
                </form>
            </div>
        </div>
        
        <div id="footer">
        	<?php include('designs/footer.php'); ?>
        </div>
    </div>
</body>
</html>