<?php
	$msg = '';
	$list = '';
	$estate = '';
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//add state
	if(isset($_POST['btnAdd'])) {
		$r_name = $_POST['r_name'];
		
		if(!$r_name) {
			$msg = '<div class="msg">State name is required</div>';
		} else {
			$log = mysql_query("SELECT * FROM state WHERE state='$r_name' LIMIT 1");
			if(mysql_num_rows($log) > 0) {
				$msg = '<div class="msg">State already exist</div>';
			} else {
				//insert state
				if(mysql_query("INSERT INTO state (state) VALUES ('$r_name')")) {
					$msg = '<div class="msg">State added successfully</div>';
				} else {
					$msg = '<div class="msg">There is problem adding state now. Please try again</div>';
				}
			}
		}
	} else if(isset($_GET['e'])) {
		//edit state
		$e = $_GET['e'];
		$query = '?e='.$e;
			
		$q = mysql_query("SELECT * FROM state WHERE state_id='$e' LIMIT 1");
		if(mysql_num_rows($q) <= 0) {
			$msg = '<div class="msg">State might have been moved</div>';
		} else {
			while($qrow = mysql_fetch_assoc($q)) {
				$estate_id = $qrow['state_id'];
				$estate = $qrow['state'];	
			}
		}
			
		if(isset($_POST['btnUpdate'])) {
			$r_name = $_POST['r_name'];
			$r_id = $_POST['r_id'];
		
			if(!$r_name) {
				$msg = '<div class="msg">State name is required</div>';
			} else {
				if(mysql_query("UPDATE state SET state='$r_name' WHERE state_id='$r_id' LIMIT 1")) {
				 	$msg = '<div class="msg">State update successfully | <a href="'.$root.'/state/">Refresh Page</a></div>';
				} else {
					$msg = '<div class="msg">There is problem updating state now. Please try again</div>';
				}	
			}
		}
	} else if(isset($_GET['d'])) {
		//remove state
		$d = $_GET['d'];
		if(mysql_query("DELETE FROM state WHERE state_id='$d' LIMIT 1")) {
			$msg = '<div class="msg">State removed successfully | <a href="'.$root.'/state/">Refresh Page</a></div>';
		} else {
			$msg = '<div class="msg">There is problem removing state now. Please try again</div>';
		}	
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//query state
	$all = mysql_query("SELECT * FROM state ORDER BY state ASC");
	$all_c = mysql_num_rows($all);
	if($all_c <= 0) {
		$list = '<h2 style="text-align:center;">No State Registered Yet</h2>';
	} else {
		while($arow = mysql_fetch_assoc($all)) {
			$state_id = $arow['state_id'];
			$state = $arow['state'];
			
			$list .= '
				<tr>
					<td>'.$state.'</td>
					<td align="center">
						<a href="'.$root.'/state/?e='.$state_id.'" class="btn">EDIT</a>&nbsp;
                        <a href="'.$root.'/state/?d='.$state_id.'" class="btn">DELETE</a>
					</td>
				</tr>
			';
		}
	}
	
	echo $msg;
?>