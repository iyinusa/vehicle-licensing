<?php
	//include files
	include('../designs/connect.php');
	$query = '';
	
	if(isset($_SESSION['v_name']))
	{
		if(isset($_GET['e'])) {
			$btn = 'btnUpdate';
			$btn_value = 'Update License';
		} else {
			$btn = 'btnAdd';
			$btn_value = 'Register License';
		}
	} else {
		header('location: ../');	
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Licensed Vehicles</title>
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
            	<h2>Manage Licensed Vehicles</h2>
            </div>
            
            <?php include('../logics/vehicle.php'); ?>
            <div class="topbox">
            	<form action="<?php echo $root.'/vehicle/'.$query; ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="r_id" value="<?php echo $e; ?>" />
                    <b>Plate Number:</b>&nbsp;
                    <select name="r_number">
                    	<option value="<?php echo $enumber_id; ?>"><?php echo $enumber; ?></option>
						<?php echo $plate_option; ?>
                    </select>&nbsp;
                    <b>Title:</b>&nbsp;
                    <select name="r_title">
                    	<option value="<?php echo $etitle; ?>"><?php echo $etitle; ?></option>
						<option value="Mr.">Mr.</option>
                        <option value="Miss.">Miss.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Dr.">Dr.</option>
                        <option value="Engr.">Engr.</option>
                        <option value="Jnr.">Jnr.</option>
                        <option value="Prof.">Prof.</option>
                    </select><br />
                    <b>First Name:</b>&nbsp;
                    <input type="text" name="r_fname" style="width:35%;" value="<?php echo $efname; ?>" />&nbsp;
                    <b>Middle Name:</b>&nbsp;
                    <input type="text" name="r_mname" style="width:35%;" value="<?php echo $emname; ?>" /><br />
                    <b>Last Name:</b>&nbsp;
                    <input type="text" name="r_lname" style="width:45%;" value="<?php echo $elname; ?>" />&nbsp;
                    <b>Sex:</b>&nbsp;
                    <select name="r_sex">
                    	<option value="<?php echo $esex; ?>"><?php echo $esex; ?></option>
						<option value="Male.">Male</option>
                        <option value="Female.">Female</option>
                    </select><br />
                    <b>DOB:</b>&nbsp;
                    <input type="text" name="r_dob" style="width:20%;" value="<?php echo $edob; ?>" placeholder="dd/mm/yyyy" />&nbsp;
                    <b>Email:</b>&nbsp;
                    <input type="text" name="r_email" style="width:20%;" value="<?php echo $eemail; ?>" />&nbsp;
                    <b>Phone:</b>&nbsp;
                    <input type="text" name="r_phone" style="width:20%;" value="<?php echo $ephone; ?>" /><br />
                    <b>Address:</b>&nbsp;
                    <textarea name="r_address" rows="2" cols="40"><?php echo $eaddress; ?></textarea>&nbsp;
                    <b>Passport:</b>&nbsp;
                    <input type="file" name="f" /><br />
                    <b>Company:</b>&nbsp;
                    <input type="text" name="r_company" style="width:50%;" value="<?php echo $ecompany; ?>" /><br />
                    <b>Company Address:</b>&nbsp;
                    <input type="text" name="r_caddress" style="width:50%;" value="<?php echo $ecaddress; ?>" /><br />
                    <b>Company Phone:</b>&nbsp;
                    <input type="text" name="r_cphone" style="width:50%;" value="<?php echo $ecphone; ?>" /><br /><br />
                    <b>Created/Renew:</b>&nbsp;
                    <input type="text" name="r_created" style="width:20%;" value="<?php echo $ecreated; ?>" placeholder="dd/mm/yyyy" />&nbsp;
                    <b>Expires:</b>&nbsp;
                    <input type="text" name="r_expires" style="width:20%;" value="<?php echo $eexpires; ?>" placeholder="dd/mm/yyyy" /><br /><br />
                    <input type="submit" name="<?php echo $btn; ?>" value="<?php echo $btn_value; ?>" />
                </form>
            </div>
            
            <table class="table">
                <tr class="thead">
                    <td width="50px"></td>
                    <td width="200px">FULL NAME</td>
                    <td>PLATE NUMBER</td>
                    <td>CREATED/RENEW</td>
                    <td>EXPIRES</td>
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