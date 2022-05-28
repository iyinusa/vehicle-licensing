<?php
	$msg = '';
	$list = '';
	$plate_option = '';
	$e_id = '';$enumber_id='';$enumber = '';$etitle = '';$efname = '';$emname = '';$elname = '';$esex = '';$edob = '';$eemail = '';$ephone = '';$eaddress = '';$ecompany = '';$ecaddress = '';$ecphone = '';$ecreated = '';$eexpires = '';
	
	function findexts ($filename) 
	 { 
		 $filename = strtolower($filename) ; 
		 $exts = split("[/\\.]", $filename) ; 
		 $n = count($exts)-1; 
		 $exts = $exts[$n]; 
		 return $exts; 
	 }
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//add license
	if(isset($_POST['btnAdd'])) {
		$r_number = $_POST['r_number'];
		$r_title = $_POST['r_title'];
		$r_fname = $_POST['r_fname'];
		$r_mname = $_POST['r_mname'];
		$r_lname = $_POST['r_lname'];
		$r_sex = $_POST['r_sex'];
		$r_dob = $_POST['r_dob'];
		$r_email = $_POST['r_email'];
		$r_phone = $_POST['r_phone'];
		$r_address = $_POST['r_address'];
		$r_company = $_POST['r_company'];
		$r_caddress = $_POST['r_caddress'];
		$r_cphone = $_POST['r_cphone'];
		$r_created = $_POST['r_created'];
		$r_expires = $_POST['r_expires'];
		
		if(!$r_number || !$r_title || !$r_fname || !$r_mname || !$r_lname || !$r_sex || !$r_dob || !$r_email || !$r_phone || !$r_address || !$r_company || !$r_caddress || !$r_cphone || !$r_created || !$r_expires) {
			$msg = '<div class="msg">All fields are required</div>';
		} else {
			//////////////////////////////////////////////////////////////
			//passport upload
			$f_name=$_FILES['f']['name'];
			$f_type=$_FILES['f']['type'];
			$f_size=$_FILES['f']['size'];
			$f_temp=$_FILES['f']['tmp_name'];
			$f_error=$_FILES['f']['error'];
			
			// Picture Image Contraints
			if(!$f_temp==true){
				$msg = "<div class='msg'>No Selected Image File, Please Select File</div>";
			} elseif($f_size > 2097152){
				$msg = "<div class='msg'>File must be less than 2MB</div>";
			} elseif(!preg_match("/\.(gif|jpg|png|bmp)$/i", $f_name)){
				$msg = "<div class='msg'>Image must be in .gif, .jpeg, or .png format</div>";
			} elseif($f_error==1){
				$msg = "<div class='msg'>Failed to upload image file</div>";
			} else {
				
				$ext = findexts ($f_name) ;
				$tm = time();
				$tm .= ".";
				
				//change file name
				$f_name = $tm.$ext;
				
				//resize pics
				if($ext == "jpg" || $ext == "jpeg")
				{
					$src = imagecreatefromjpeg($f_temp);
				} else if($ext == "png")
				{
					$src = imagecreatefrompng($f_temp);
				} else
				{
					$src = imagecreatefrompng($f_temp);
				}
				
				list($width,$height)=getimagesize($f_temp);
				$newwidth=50;
				$newheight=($height/$width)*$newwidth;
				$tmp=imagecreatetruecolor($newwidth,$newheight);
				
				//prepare to save file on server
				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
				
				$fpath = "../files/".$f_name;
								
				imagejpeg($tmp,$fpath,100);
				
				imagedestroy($src);
				imagedestroy($tmp);
				
				$img_path = "files/".$f_name;
			}
			//end passport upload
			///////////////////////////////////////////////////////////////////////////////////////////////////
			
			$logp = mysql_query("SELECT * FROM owner WHERE plate_id='$r_number' LIMIT 1");
			$logu = mysql_query("SELECT * FROM owner WHERE title='$r_title' AND firstname='$r_fname' AND middlename='$r_mname' AND lastname='$r_lname' LIMIT 1");
			$logpu = mysql_query("SELECT * FROM owner WHERE plate_id='$r_number' AND title='$r_title' AND firstname='$r_fname' AND middlename='$r_mname' AND lastname='$r_lname' LIMIT 1");
			if(mysql_num_rows($logp) > 0) {
				$msg = '<div class="msg">Plate Number already belongs to someone. Check record below</div>';
			} else if(mysql_num_rows($logu) > 0) {
				$msg = '<div class="msg">Car Owner already has License. Check record below</div>';
			} else if(mysql_num_rows($logpu) > 0) {
				$msg = '<div class="msg">You have registered this License before. Check record below</div>';
			} else {
				//insert license
				if(mysql_query("INSERT INTO owner (plate_id,title,firstname,middlename,lastname,sex,dob,email,phone,address,company,c_address,c_phone,img,created,expires) VALUES ('$r_number','$r_title','$r_fname','$r_mname','$r_lname','$r_sex','$r_dob','$r_email','$r_phone','$r_address','$r_company','$r_caddress','$r_cphone','$img_path','$r_created','$r_expires')")) {
					$msg = '<div class="msg">License added successfully</div>';
				} else {
					$msg = '<div class="msg">There is problem saving license information now. Please try again</div>';
				}
			}
		}
	} else if(isset($_GET['e'])) {
		//edit license
		$e = $_GET['e'];
		$query = '?e='.$e;
			
		$q = mysql_query("SELECT * FROM owner WHERE owner_id='$e' LIMIT 1");
		if(mysql_num_rows($q) <= 0) {
			$msg = '<div class="msg">License might have been moved</div>';
		} else {
			while($qrow = mysql_fetch_assoc($q)) {
				$e_id = $qrow['owner_id'];
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
				
				//get plate license
				$qs = mysql_query("SELECT * FROM platenumber WHERE plate_id='$eplate_id' LIMIT 1");
				if(mysql_num_rows($qs) > 0) {
					while($qsr = mysql_fetch_assoc($qs)) {
						$enumber_id = $qsr['plate_id'];
						$enumber = $qsr['number'];
						$eformat_id = $qsr['format_id'];
					}
				}
				
				//get format name
				$fs = mysql_query("SELECT * FROM plateformat WHERE format_id='$eformat_id' LIMIT 1");
				if(mysql_num_rows($fs) > 0) {
					while($fsr = mysql_fetch_assoc($fs)) {
						$eprefix = $fsr['prefix'];
					}
				}
				
				$enumber = $eprefix.'-'.$enumber;
			}
		}
			
		if(isset($_POST['btnUpdate'])) {
			$r_number = $_POST['r_number'];
			$r_title = $_POST['r_title'];
			$r_fname = $_POST['r_fname'];
			$r_mname = $_POST['r_mname'];
			$r_lname = $_POST['r_lname'];
			$r_sex = $_POST['r_sex'];
			$r_dob = $_POST['r_dob'];
			$r_email = $_POST['r_email'];
			$r_phone = $_POST['r_phone'];
			$r_address = $_POST['r_address'];
			$r_company = $_POST['r_company'];
			$r_caddress = $_POST['r_caddress'];
			$r_cphone = $_POST['r_cphone'];
			$r_created = $_POST['r_created'];
			$r_expires = $_POST['r_expires'];
			$r_id = $_POST['r_id'];
		
			if(!$r_number || !$r_title || !$r_fname || !$r_mname || !$r_lname || !$r_sex || !$r_dob || !$r_email || !$r_phone || !$r_address || !$r_company || !$r_caddress || !$r_cphone || !$r_created || !$r_expires) {
				$msg = '<div class="msg">All fields are required</div>';
			} else {
				//////////////////////////////////////////////////////////////
				//passport upload
				$f_name=$_FILES['f']['name'];
				$f_type=$_FILES['f']['type'];
				$f_size=$_FILES['f']['size'];
				$f_temp=$_FILES['f']['tmp_name'];
				$f_error=$_FILES['f']['error'];
				
				// Picture Image Contraints
				if(!$f_temp==true){
					$img_path = '';
				} elseif($f_size > 2097152){
					$msg = "<div class='msg'>File must be less than 2MB</div>";
				} elseif(!preg_match("/\.(gif|jpg|png|bmp)$/i", $f_name)){
					$msg = "<div class='msg'>Image must be in .gif, .jpeg, or .png format</div>";
				} elseif($f_error==1){
					$msg = "<div class='msg'>Failed to upload image file</div>";
				} else {
					$ext = findexts ($f_name) ;
					$tm = time();
					$tm .= ".";
					
					//change file name
					$f_name = $tm.$ext;
					
					//resize pics
					if($ext == "jpg" || $ext == "jpeg")
					{
						$src = imagecreatefromjpeg($f_temp);
					} else if($ext == "png")
					{
						$src = imagecreatefrompng($f_temp);
					} else
					{
						$src = imagecreatefrompng($f_temp);
					}
					
					list($width,$height)=getimagesize($f_temp);
					$newwidth=50;
					$newheight=($height/$width)*$newwidth;
					$tmp=imagecreatetruecolor($newwidth,$newheight);
					
					//prepare to save file on server
					imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
					
					$fpath = "../files/".$f_name;
									
					imagejpeg($tmp,$fpath,100);
					
					imagedestroy($src);
					imagedestroy($tmp);
					
					$img_path = "files/".$f_name;
				}
				//end passport upload
				///////////////////////////////////////////////////////////////////////////////////////////////////
				
				if(!$img_path) {
					if(mysql_query("UPDATE owner SET plate_id='$r_number', title='$r_title',firstname='$r_fname',middlename='$r_mname',lastname='$r_lname',sex='$r_sex',dob='$r_dob',email='$r_email',phone='$r_phone',address='$r_address',company='$r_company',c_address='$r_caddress',c_phone='$r_cphone',created='$r_created',expires='$r_expires' WHERE owner_id='$r_id' LIMIT 1")) {
						$msg = '<div class="msg">License update successfully | <a href="'.$root.'/vehicle/">Refresh Page</a></div>';
					} else {
						$msg = '<div class="msg">There is problem updating license now. Please try again</div>';
					}
				} else {
					if(mysql_query("UPDATE owner SET plate_id='$r_number', title='$r_title',firstname='$r_fname',middlename='$r_mname',lastname='$r_lname',sex='$r_sex',dob='$r_dob',email='$r_email',phone='$r_phone',address='$r_address',company='$r_company',c_address='$r_caddress',c_phone='$r_cphone',img='$img_path',created='$r_created',expires='$r_expires' WHERE owner_id='$r_id' LIMIT 1")) {
						$msg = '<div class="msg">License update successfully | <a href="'.$root.'/vehicle/">Refresh Page</a></div>';
					} else {
						$msg = '<div class="msg">There is problem updating license now. Please try again</div>';
					}
				}
			}
		}
	} else if(isset($_GET['d'])) {
		//remove license
		$d = $_GET['d'];
		if(mysql_query("DELETE FROM owner WHERE owner_id='$d' LIMIT 1")) {
			$msg = '<div class="msg">License removed successfully | <a href="'.$root.'/vehicle/">Refresh Page</a></div>';
		} else {
			$msg = '<div class="msg">There is problem removing license now. Please try again</div>';
		}	
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//query format
	$qf = mysql_query("SELECT * FROM platenumber ORDER BY plate_id ASC");
	if(mysql_num_rows($qf) <= 0) {
		$format_option = '<option value="">No plate number yet</option>';	
	} else {
		while($qrow = mysql_fetch_assoc($qf)) {
			$q_plate_id = $qrow['plate_id'];
			$q_format_id = $qrow['format_id'];
			$q_plate_num = $qrow['number'];
			
			//get format name
			$gf = mysql_query("SELECT * FROM plateformat WHERE format_id='$q_format_id' LIMIT 1");
			if(mysql_num_rows($gf) > 0) {
				while($gfr = mysql_fetch_assoc($gf)) {
					$e_prefix = $gfr['prefix'];
				}
			}
				
			$plate_option .= '<option value="'.$q_plate_id.'">'.$e_prefix.'-'.$q_plate_num.'</option>';
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//query licenses
	$all = mysql_query("SELECT * FROM owner ORDER BY owner_id DESC");
	$all_c = mysql_num_rows($all);
	if($all_c <= 0) {
		$list = '<h2 style="text-align:center;">No License Yet</h2>';
	} else {
		while($arow = mysql_fetch_assoc($all)) {
			$lowner_id = $arow['owner_id'];
			$lplate_id = $arow['plate_id'];
			$ltitle = $arow['title'];
			$lfirstname = $arow['firstname'];
			$lmiddlename = $arow['middlename'];
			$llastname = $arow['lastname'];
			$lcreated = $arow['created'];
			$lexpires = $arow['expires'];
			$limg = $arow['img'];
			
			//get plate number
			$gs = mysql_query("SELECT * FROM platenumber WHERE plate_id='$lplate_id' LIMIT 1");
			if(mysql_num_rows($gs) > 0) {
				while($gsr = mysql_fetch_assoc($gs)) {
					$lformat_id = $gsr['format_id'];
					$lnumber = $gsr['number'];
				}
			}
			
			//get format
			$gsn = mysql_query("SELECT * FROM plateformat WHERE format_id='$lformat_id' LIMIT 1");
			if(mysql_num_rows($gsn) > 0) {
				while($gsnr = mysql_fetch_assoc($gsn)) {
					$lprefix = $gsnr['prefix'];
				}
			}
			
			$list .= '
				<tr>
					<td><img alt="" src="'.$root.'/'.$limg.'" width="50px" /></td>
					<td>'.$ltitle.' '.$lfirstname.' '.$lmiddlename.' '.$llastname.'</td>
					<td>'.$lprefix.'-'.$lnumber.'</td>
					<td>'.$lcreated.'</td>
					<td>'.$lexpires.'</td>
					<td align="center">
						<a href="'.$root.'/vehicle/?e='.$lowner_id.'" class="btn">EDIT</a>&nbsp;
                        <a href="'.$root.'/vehicle/?d='.$lowner_id.'" class="btn">DELETE</a>
					</td>
				</tr>
			';
		}
	}
	
	echo $msg;
?>