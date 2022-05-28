<?php
	//include files
	include('../designs/connect.php');
	$query = '';
	
	if(isset($_SESSION['v_name']))
	{
		if(isset($_GET['e'])) {
			$btn = 'btnUpdate';
			$btn_value = 'Update Format';
		} else {
			$btn = 'btnAdd';
			$btn_value = 'Add Format';
		}
	} else {
		header('location: ../');	
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Plate Format</title>
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
            	<h2>Manage Plate Format</h2>
            </div>
            
            <?php include('../logics/format.php'); ?>
            <div class="topbox">
            	<form action="<?php echo $root.'/format/'.$query; ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="r_id" value="<?php echo $eformat_id; ?>" />
                    <b>State:</b>&nbsp;
                    <select name="r_state">
                    	<option value="<?php echo $estate_id; ?>"><?php echo $estate; ?></option>
						<?php echo $state_option; ?>
                    </select>&nbsp;
                    <b>Format Prefix:</b>&nbsp;
                    <input type="text" name="r_prefix" style="width:50%;" value="<?php echo $eprefix; ?>" />&nbsp;
                    <input type="submit" name="<?php echo $btn; ?>" value="<?php echo $btn_value; ?>" />
                </form>
            </div>
            
            <table class="table">
                <tr class="thead">
                    <td>STATES</td>
                    <td>PLATE FORMAT [PREFIX]</td>
                    <td width="120px" align="center"></td>
                </tr>
                <?php echo $list; ?>
            </table>
        </div>
        
        <div id="footer">
        	<?php include('../designs/footer.php'); ?>
        </div>
    </div>
</body>
</html>