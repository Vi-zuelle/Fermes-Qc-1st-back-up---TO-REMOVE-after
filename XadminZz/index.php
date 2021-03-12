<?php
// session_start(); // Initialize session data
 session_start();
 $niv = substr($_SESSION['username_imex'],0,1);

include("../connexion.php"); 

if ((isset($_SESSION['username_imex'])) && (!empty($_SESSION['username_imex'])) && ($niv == 1)){
		 
			 
			//ob_start(); // Turn on output buffering 
			?>
						
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
			<title></title>
			
			<link href="admin.css" rel="stylesheet" type="text/css" />
			</head>
			
			<body>
			
			<table width="800" cellpadding="0" cellspacing="0" align="center">
			  <tr>
				<td width="700" height="151" valign="bottom" class="entete">
				<?php  include("menu/menu2.php");?><br /><br />
				<hr width="790">
                </td>
			  </tr>
				<tr>
				<td height="200" class="corps" align="center">
                  <span class="stats2">Bienvenue dans l'administration du site.</span>
                
                  </td>
			  </tr>
				<tr>
				<td class="pieds" height="30">&nbsp;</td>
				</tr>
			</table>
						
			</body>
			</html>
			<?php 
			  mysql_close(); 
} else {
	
		ob_end_clean();
		header("Location: login.html");
		exit;
}
?>