<?php
	//include files
	include('../designs/connect.php');
	$query = '';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>About Us</title>
<link rel="stylesheet" type="text/css" href="../style/lay.css"/>

<style>
	.table{width:100%; border:1px solid #ccc; padding:0px; margin:0px;}
	.table td{padding:10px; border:1px solid #ccc;}
</style>	
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
            	<h2>About Us</h2>
            </div>
            
            <div>
            	<table class="table">
                	<tr style="background-color:#CCF; font-weight:bold;">
                    	<td>NAME</td>
                        <td>MATRIC NUMBER</td>
                    </tr>
                    <tr>
                    	<td>NWADOCHELI CHARLES</td>
                        <td>108171088</td>
                    </tr>
                    <tr>
                    	<td>ODONYE OBIAJULU WILLIAMS</td>
                        <td>108171095</td>
                    </tr>
                    <tr>
                    	<td>OGUNGBE IDOWU PETER</td>
                        <td>108171100</td>
                    </tr>
                    <tr>
                    	<td>PELEWURA PATRICK OMOLAJA</td>
                        <td>108171131</td>
                    </tr>
                    <tr>
                    	<td>SHAIBU AHUOIZA BILIKISU</td>
                        <td>108171140</td>
                    </tr>
                    <tr>
                    	<td>WILKEY BLESSING KOLAPO</td>
                        <td>108171153</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div id="footer">
        	<?php include('../designs/footer.php'); ?>
        </div>
    </div>
</body>
</html>