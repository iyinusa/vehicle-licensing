<?php
	//include files
	include('../designs/connect.php');
	$query = '';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>License Plates Recognition</title>
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
            	<h2>License Recognition</h2>
            </div>
            
            <div class="topbox">
            	<form action="<?php echo $root.'/search/'; ?>" method="post" enctype="multipart/form-data">
                    <b>Item:</b>&nbsp;
                    <input type="text" name="r_item" style="width:60%;" placeholder="search license..." />&nbsp;(i.e. Plate Number)<br /><br />
                    <div style="text-align:right">
                    	<b>Note:</b> Licence information will be based on license number supplied&nbsp;
                        <input type="submit" name="btnSearch" value="Perform Recognition" />
                    </div>
                </form>
            </div>
            <?php include('../logics/search.php'); ?>
        </div>
        
        <div id="footer">
        	<?php include('../designs/footer.php'); ?>
        </div>
    </div>
</body>
</html>