<?php
	$msg = '';
	$list = '';
	$eformat = '';
	$estate_id = '';
	$estate = '';
	$eprefix = '';
	$state_option = '';
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//add format
	if(isset($_POST['btnAdd'])) {
		$r_state = $_POST['r_state'];
		$r_prefix = $_POST['r_prefix'];
		
		if(!$r_prefix || !$r_state) {
			$msg = '<div class="msg">All fields are required</div>';
		} else {
			$log = mysql_query("SELECT * FROM plateformat WHERE prefix='$r_prefix' AND state_id='$r_state' LIMIT 1");
			if(mysql_num_rows($log) > 0) {
				$msg = '<div class="msg">Prefix already set for this state</div>';
			} else {
				//insert format
				if(mysql_query("INSERT INTO plateformat (state_id,prefix) VALUES ('$r_state','$r_prefix')")) {
					$msg = '<div class="msg">Plate Format added successfully</div>';
				} else {
					$msg = '<div class="msg">There is problem adding plate format now. Please try again</div>';
				}
			}
		}
	} else if(isset($_GET['e'])) {
		//edit format
		$e = $_GET['e'];
		$query = '?e='.$e;
			
		$q = mysql_query("SELECT * FROM plateformat WHERE format_id='$e' LIMIT 1");
		if(mysql_num_rows($q) <= 0) {
			$msg = '<div class="msg">Plate Format might have been moved</div>';
		} else {
			while($qrow = mysql_fetch_assoc($q)) {
				$eformat_id = $qrow['format_id'];
				$estate_id = $qrow['state_id'];
				$eprefix = $qrow['prefix'];
				
				//get state name
				$qs = mysql_query("SELECT * FROM state WHERE state_id='$estate_id' LIMIT 1");
				if(mysql_num_rows($qs) > 0) {
					while($qsr = mysql_fetch_assoc($qs)) {
						$estate = $qsr['state'];
					}
				}
			}
		}
			
		if(isset($_POST['btnUpdate'])) {
			$r_state = $_POST['r_state'];
			$r_prefix = $_POST['r_prefix'];
			$r_id = $_POST['r_id'];
		
			if(!$r_state || !$r_prefix) {
				$msg = '<div class="msg">All fields are required</div>';
			} else {
				if(mysql_query("UPDATE plateformat SET state_id='$r_state', prefix='$r_prefix' WHERE format_id='$r_id' LIMIT 1")) {
				 	$msg = '<div class="msg">Plate Format update successfully | <a href="'.$root.'/format/">Refresh Page</a></div>';
				} else {
					$msg = '<div class="msg">There is problem updating plate format now. Please try again</div>';
				}	
			}
		}
	} else if(isset($_GET['d'])) {
		//remove format
		$d = $_GET['d'];
		if(mysql_query("DELETE FROM plateformat WHERE format_id='$d' LIMIT 1")) {
			$msg = '<div class="msg">Plate Format removed successfully | <a href="'.$root.'/format/">Refresh Page</a></div>';
		} else {
			$msg = '<div class="msg">There is problem removing plate format now. Please try again</div>';
		}	
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//query state
	$qstate = mysql_query("SELECT * FROM state ORDER BY state ASC");
	if(mysql_num_rows($qstate) <= 0) {
		$state_option = '<option value="">No state yet</option>';	
	} else {
		while($qrow = mysql_fetch_assoc($qstate)) {
			$q_state_id = $qrow['state_id'];
			$q_state = $qrow['state'];
			$state_option .= '<option value="'.$q_state_id.'">'.$q_state.'</option>';
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//query format
	$all = mysql_query("SELECT * FROM plateformat ORDER BY format_id DESC");
	$all_c = mysql_num_rows($all);
	if($all_c <= 0) {
		$list = '<h2 style="text-align:center;">No Plate Number Format Yet</h2>';
	} else {
		while($arow = mysql_fetch_assoc($all)) {
			$format_id = $arow['format_id'];
			$state_id = $arow['state_id'];
			$prefix = $arow['prefix'];
			
			//get state name
			$gs = mysql_query("SELECT * FROM state WHERE state_id='$state_id' LIMIT 1");
			if(mysql_num_rows($gs) > 0) {
				while($gsr = mysql_fetch_assoc($gs)) {
					$state = $gsr['state'];
				}
			}
			
			$list .= '
				<tr>
					<td>'.$state.'</td>
					<td>'.$prefix.'</td>
					<td align="center">
						<a href="'.$root.'/format/?e='.$format_id.'" class="btn">EDIT</a>&nbsp;
                        <a href="'.$root.'/format/?d='.$format_id.'" class="btn">DELETE</a>
					</td>
				</tr>
			';
		}
	}
	
	echo $msg;
?>