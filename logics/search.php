<?php
	if(isset($_POST['btnSearch'])) {
		$r_item = $_POST['r_item'];
		
		if(!$r_item) {
			echo '
				<h1 style="text-align:center;">You must type Plate Number</h1>
			';
		} else {
			//break item
			$plate = explode('-',$r_item);
			$c = count($plate);
			
			if($c >= 3) {
				$plate = $plate[1].'-'.$plate[2];
			} else {
				$plate = '';
			}
			
			$q = mysql_query("SELECT * FROM platenumber WHERE number='$plate' LIMIT 1");
			if(mysql_num_rows($q) <= 0) {
				echo '
					<h1 style="text-align:center;">License not found or Invalid Plate Number</h1>
				';
			} else {
				while($qr = mysql_fetch_assoc($q)) {
					$plate_id = $qr['plate_id'];
					$format_id = $qr['format_id'];
					$number = $qr['number'];
					
					//get format
					$f = mysql_query("SELECT * FROM plateformat WHERE format_id='$format_id' LIMIT 1");
					if(mysql_num_rows($f) > 0) {
						while($fr = mysql_fetch_assoc($f)) {
							$state_id = $fr['state_id'];
							$prefix = $fr['prefix'];
						}
					}
					
					//get state
					$s = mysql_query("SELECT * FROM state WHERE state_id='$state_id' LIMIT 1");
					if(mysql_num_rows($s) > 0) {
						while($sr = mysql_fetch_assoc($s)) {
							$state = $sr['state'];
						}
					}
					
					//load information
					$info = mysql_query("SELECT * FROM owner WHERE plate_id='$plate_id' LIMIT 1");
					if(mysql_num_rows($info) > 0) {
						while($qrow = mysql_fetch_assoc($info)) {
							$eplate_id = $qrow['plate_id'];
							$etitle = $qrow['title'];
							$efname = $qrow['firstname'];
							$emname = $qrow['middlename'];
							$elname = $qrow['lastname'];
							$esex= $qrow['sex'];
							$edob = $qrow['dob'];
							$eemail = $qrow['email'];
							$ephone = $qrow['phone'];
							$eaddress = $qrow['address'];
							$ecompany = $qrow['company'];
							$ecaddress = $qrow['c_address'];
							$ecphone = $qrow['c_phone'];
							$ecreated = $qrow['created'];
							$eexpires = $qrow['expires'];
							$eimg = $qrow['img'];
						}
						
						$sstatus = '';
					} else {
						$eplate_id = 'None';
						$etitle = 'None';
						$efname = 'None';
						$emname = 'None';
						$elname = 'None';
						$esex= 'None';
						$edob = 'None';
						$eemail = 'None';
						$ephone = 'None';
						$eaddress = 'None';
						$ecompany = 'None';
						$ecaddress = 'None';
						$ecphone = 'None';
						$ecreated = 'None';
						$eexpires = 'None';
						$eimg = 'None';
						
						$sstatus = '<h2 style="text-align:center; background-color:pink; padding:5px;">Plate Number ('.strtoupper($prefix).'-'.strtoupper($number).') is not registered</h2>';
					}
					
					//display informtion
					echo $sstatus.'
						<div style="margin-bottom:10px; overflow:auto;">
							<div style="float:right; width:250px; border-radius:10px; border:1px solid #999; box-shadow:0px 0px 5px #333; padding:10px; text-align:center;">
								<div style="color:blue; font-weight:bold; font-size:34px;">
									* '.strtoupper($state).' *
								</div>
								<div style="color:red; font-weight:bold; font-size:26px;">
									'.strtoupper($prefix).'-'.strtoupper($number).'
								</div>
								<div style="color:gray; font-size:10px;">
									Created: '.$ecreated.' | Expires: '.$eexpires.'
								</div>
							</div>
						</div>
						
						<div style="border:1px solid #ccc; padding:10px;">
							<table style="width:100%;">
								<tr>
									<td width="100px" valign="top" align="center">
										<img alt="" src="'.$root.'/'.$eimg.'" /><br />
										'.$etitle.' '.$efname.' '.$emname.' '.$efname.'
									</td>
									<td valign="top">
										<b>Sex:</b> '.$esex.'<br /><br />
										<b>DOB:</b> '.$edob.'<br /><br />
										<b>Email:</b> '.$eemail.'<br /><br />
										<b>Phone:</b> '.$ephone.'<br /><br />
										<b>Address:</b> '.$eaddress.'<br /><br />
										<b>Company:</b> '.$ecompany.'<br /><br />
										<b>Company Address:</b> '.$ecaddress.'<br /><br />
										<b>Company Phone:</b> '.$ecphone.'
									</td>
								</tr>
							</table>
						</div>
					';
				}
			}
		}
	}
?>