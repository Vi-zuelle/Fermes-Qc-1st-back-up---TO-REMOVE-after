<?php
// Initialize session data
 session_start();
$niv = substr($_SESSION['username_imex'],0,1);

if ((isset($_SESSION['username_imex'])) && (!empty($_SESSION['username_imex'])) && ($niv == 1)){
		ob_start(); // Turn on output buffering

		include("../connexion.php");
?>
		
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<title></title>
		
		<link href="admin.css" rel="stylesheet" type="text/css" />
		</head>
		<body>
		<?php
		 $requete = "SELECT * FROM administrateurs ORDER BY nom ASC";
		 $resultats = mysql_query($requete);
		// $data = mysql_fetch_array($resultats) ;
		
		?>
		
		<table width="800" cellpadding="0" cellspacing="0" align="center">
			<tr align="center">
			<td class="entete" height="151" valign="bottom">
			<?php  include("menu/menu2.php");?>
			<div style="line-height:30px">
			<span class="stats">&nbsp;&nbsp;Les Administrateurs</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin_add.php">Ajouter un administrateur</a>
            </div>
		<hr width="790"></td>
			</tr>
			<?php
			   while($data = mysql_fetch_array($resultats)) { // informations jour ***************************************************************
				?>
					<tr >
						<td class="corps">
						
						  <table width="600" cellspacing="0" cellpadding="5" align="center">
						   <tr bgcolor="<?php echo $couleur1 ;?>" height="40">
							<td  align="left"><img src="images/boule.gif" width="6" height="6" /> Administrateur : <span class="stats"><?php echo $data["nom"];?></span></td>
							<td  height="50" width="150"><span class="stats"><?php if( $data["id_groupe"]==1) echo 'Administrateur';?></span></td>
							<td width="35" align="center"><a href="admin_modif.php?id=<?php echo $data["id"]; ?>"><img src="images/Modify.png" width="30" height="30" alt="Modifier" border="0" /></a></td>
							<td width="35" align="center"><a href="admin_supp.php?id=<?php echo $data["id"]; ?>"><img src="images/Delete.png" width="27" height="27" alt="Supprimer" border="0" /></a></td>
						  </tr>
						 </table>
					 
					   </td>
				   </tr>  
				<?php 
					if($couleur1=="#FEEACA"){
						$couleur1 = $couleur2 ;
					} else {
						$couleur1 = "#FEEACA" ;
					}	 	
					
				  } //***************************************************************************************************************
			
		?> 
		<tr>
		<td class="pieds" height="25" align="center">Fin de la liste</td>
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
