<?php
// session_start(); // Initialize session data
 session_start();

if ((isset($_SESSION['username_imex'])) && (!empty($_SESSION['username_imex']))){
		ob_start(); // Turn on output buffering
		
		include("../connexion.php"); 

?>
		
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title></title>
		
		<link href="admin.css" rel="stylesheet" type="text/css" />
		</head>
		<body>
		<?php
		 $requete = "SELECT * FROM concour ORDER BY date_ins ASC";
		 $resultats = mysql_query($requete);
		// $data = mysql_fetch_array($resultats) ;
		
		?>
		
		<table width="800" cellpadding="0" cellspacing="0" align="center">
			<tr align="center">
			<td class="entete" height="151" valign="bottom">
			<?php  include("menu/menu2.php");?>
			
			<div style="line-height:30px"><span class="stats">&nbsp;&nbsp;Liste des inscrits aux promotions</span></a></div>
		<hr width="790"></td>
			</tr>
			<?php

			   while($data1 = mysql_fetch_array($resultats)) { // informations jour ***************************************************************
			  
				?>
					<tr >
						<td class="corps">
						 
						  <table width="790" cellspacing="0" cellpadding="5">
						   <tr bgcolor="<?php echo $couleur1 ;?>" height="40">
								<td width="15" align="left"><?php echo $data1["date_ins"];?></td>
								<td width="200" align="left"><?php echo stripslashes($data1["nom3"])." ".stripslashes($data1["prenom3"]);?><br />
								<?php echo stripslashes($data1["adresse"])." ".stripslashes($data1["ville"])." ".$data1["cp"];?></td>
								<td width="200" align="left"><?php echo stripslashes($data1["entreprise"]);?><br />
								<?php echo stripslashes($data1["secteur"]);?></td>
								<td width="150" align="left"><?php echo $data1["tph"];?><br />
								<?php echo $data1["mail"];?></td>
								<td align="left"><strong><?php echo $data1["forfait"];?></strong></td>



<!--
							<td width="76" align="center" valign="middle"><a href="?id=<?php echo $data["id"]; ?>"><img src="images/Modify.png" width="30" height="30" alt="Modifier" border="0" /></a></td>
							<td width="71" align="center" valign="middle"><a href="inscrits_supp.php?id=<?php echo $data["id"]; ?>"><img src="images/Delete.png" width="27" height="27" alt="Supprimer" border="0" /></a></td>
-->
						  </tr>
						 </table>
					 
				      </td>
				   </tr>  
				<?php 
					if($couleur1=="#FCD99D"){
						$couleur1 = $couleur2 ;
					} else {
						$couleur1 = "#FCD99D" ;
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
