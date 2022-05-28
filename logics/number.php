<?php
	$msg = '';
	$list = '';
	$enumber = '';
	$eformat_id = '';
	$eformat = '';
	$format_option = '';
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//add number
	if(isset($_POST['btnAdd'])) {
		$r_format = $_POST['r_format'];
		$r_number = $_POST['r_number'];
		
		if(!$r_format || !$r_number) {
			$msg = '<div class="msg">All fields are required</div>';
		} else {
			$log = mysql_query("SELECT * FROM platenumber WHERE number='$r_number' AND format_id='$r_format' LIMIT 1");
			if(mysql_num_rows($log) > 0) {
				$msg = '<div class="msg">Plate Number already exist for this state format</div>';
			} else {
				//insert number
				if(mysql_query("INSERT INTO platenumber (format_id,number) VALUES ('$r_format','$r_number')")) {
					$msg = '<div class="msg">Plate Number added successfully</div>';
				} else {
					$msg = '<div class="msg">There is problem adding plate number now. Please try again</div>';
				}
			}
		}
	} else if(isset($_GET['e'])) {
		//edit number
		$e = $_GET['e'];
		$query = '?e='.$e;
			
		$q = mysql_query("SELECT * FROM platenumber WHERE plate_id='$e' LIMIT 1");
		if(mysql_num_rows($q) <= 0) {
			$msg = '<div class="msg">Plate Number might have been moved</div>';
		} else {
			while($qrow = mysql_fetch_assoc($q)) {
				$enumber_id = $qrow['plate_id'];
				$eformat_id = $qrow['format_id'];
				$enumber = $qrow['number'];
				
				//get format name
				$qs = mysql_query("SELECT * FROM plateformat WHERE format_id='$eformat_id' LIMIT 1");
				if(mysql_num_rows($qs) > 0) {
					while($qsr = mysql_fetch_assoc($qs)) {
						$eformat = $qsr['prefix'];
					}
				}
			}
		}
			
		if(isset($_POST['btnUpdate'])) {
			$r_format = $_POST['r_format'];
			$r_number = $_POST['r_number'];
			$r_id = $_POST['r_id'];
		
			if(!$r_format || !$r_number) {
				$msg = '<div class="msg">All fields are required</div>';
			} else {
				if(mysql_query("UPDATE platenumber SET format_id='$r_format', number='$r_number' WHERE plate_id='$r_id' LIMIT 1")) {
				 	$msg = '<div class="msg">Plate Number update successfully | <a href="'.$root.'/number/">Refresh Page</a></div>';
				} else {
					$msg = '<div class="msg">There is problem updating plate number now. Please try again</div>';
				}	
			}
		}
	} else if(isset($_GET['d'])) {
		//remove number
		$d = $_GET['d'];
		if(mysql_query("DELETE FROM platenumber WHERE plate_id='$d' LIMIT 1")) {
			$msg = '<div class="msg">Plate Number removed successfully | <a href="'.$root.'/number/">Refresh Page</a></div>';
		} else {
			$msg = '<div class="msg">There is problem removing plate number now. Please try again</div>';
		}	
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//query format
	$qf = mysql_query("SELECT * FROM plateformat ORDER BY prefix ASC");
	if(mysql_num_rows($qf) <= 0) {
		$format_option = '<option value="">No format yet</option>';	
	} else {
		while($qrow = mysql_fetch_assoc($qf)) {
			$q_format_id = $qrow['format_id'];
			$q_state_id = $qrow['state_id'];
			$q_prefix = $qrow['prefix'];
			$format_option .= '<option value="'.$q_format_id.'">'.$q_prefix.'</option>';
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//query number
	$all = mysql_query("SELECT * FROM platenumber ORDER BY plate_id DESC");
	$all_c = mysql_num_rows($all);
	if($all_c <= 0) {
		$list = '<h2 style="text-align:center;">No Plate Number Yet</h2>';
	} else {
		while($arow = mysql_fetch_assoc($all)) {
			$plate_id = $arow['plate_id'];
			$format_id = $arow['format_id'];
			$number = $arow['number'];
			
			//get state id
			$gs = mysql_query("SELECT * FROM plateformat WHERE format_id='$format_id' LIMIT 1");
			if(mysql_num_rows($gs) > 0) {
				while($gsr = mysql_fetch_assoc($gs)) {
					$state_id = $gsr['state_id'];
					$format = $gsr['prefix'];
				}
			}
			
			//get state name
			$gsn = mysql_query("SELECT * FROM state WHERE state_id='$state_id' LIMIT 1");
			if(mysql_num_rows($gsn) > 0) {
				while($gsnr = mysql_fetch_assoc($gsn)) {
					$state = $gsnr['state'];
				}
			}
			
			$list .= '
				<tr>
					<td>'.$state.'</td>
					<td>'.$format.'-'.$number.'</td>
					<td align="center">
						<a href="'.$root.'/number/?e='.$plate_id.'" class="btn">EDIT</a>&nbsp;
                        <a href="'.$root.'/number/?d='.$plate_id.'" class="btn">DELETE</a>
					</td>
				</tr>
			';
		}
	}
	
	echo $msg;
?>