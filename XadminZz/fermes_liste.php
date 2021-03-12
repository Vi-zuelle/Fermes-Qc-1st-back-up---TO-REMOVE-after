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
		 $requete = "SELECT * FROM fermes ORDER BY nom ASC";
		 $resultats = mysql_query($requete);
		// $data = mysql_fetch_array($resultats) ;
		
		?>
		
		<table width="800" cellpadding="0" cellspacing="0" align="center">
			<tr align="center">
			<td class="entete" height="151" valign="bottom">
			<?php  include("menu/menu2.php");?>
			
			<div style="line-height:30px"><span class="stats">&nbsp;&nbsp;Les Fermes du Qu&eacute;bec</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="fermes_add.php">Ajouter une Ferme (CLIQUER ICI)</a></div>
		<hr width="790"></td>
			</tr>
			<?php

			   while($data = mysql_fetch_array($resultats)) { // informations jour ***************************************************************
			  
				?>
					<tr >
						<td class="corps">
						 
						  <table width="790" cellspacing="0" cellpadding="5">
						   <tr bgcolor="<?php echo $couleur1 ;?>" height="40">
							 <?php $p = 0; ?>
							<?php if($data['photo1']){?>   
								<td width="100" align="left" valign="top"> <img src="../images/fermes_quebec/photos/<?php echo $data['photo1'];?>" height = "100" /></td>
							<?php $p = $p + 1;
								 }?>	
							
							<td width="412" valign="top">
								<?php echo stripslashes($data["nom"]);?><br />
								<?php echo stripslashes($data["adresse"]);?><br /><br />
								<?php echo stripslashes($data["descriptif"]);?><br />
								
							<?php if($data['photo2']){?>   
								<img src="../images/fermes_quebec/photos/<?php echo $data['photo2'];?>" height = "30" />
							<?php $p = $p + 1;
								 }?>	

							<?php if($data['photo3']){?>   
								<img src="../images/fermes_quebec/photos/<?php echo $data['photo3'];?>" height = "30" />
							<?php $p = $p + 1;
								 }?>	

							<?php if($data['photo4']){?>   
								<img src="../images/fermes_quebec/photos/<?php echo $data['photo4'];?>" height = "30" />
							<?php $p = $p + 1;
								 }?>	

							<?php if($data['photo5']){?>   
								<img src="../images/fermes_quebec/photos/<?php echo $data['photo5'];?>" height = "30" />
							<?php $p = $p + 1;
								 }?>	

							<?php if($data['photo6']){?>   
								<img src="../images/fermes_quebec/photos/<?php echo $data['photo6'];?>" height = "30" />
							<?php  $p = $p + 1;
								 }?>	

							<?php if($data['photo7']){?>   
								<img src="../images/fermes_quebec/photos/<?php echo $data['photo7'];?>" height = "30" />
							<?php $p = $p + 1;
								 }?>	
							<?php echo "&nbsp;&nbsp;".$p.' Photos';?>
							</td>
                            
							<td width="76" align="center" valign="middle"><a href="fermes_modif.php?id=<?php echo $data["id"]; ?>">MODIFIER<img src="images/Modify.png" width="30" height="30" alt="Modifier" border="0" /></a></td>
							<td width="71" align="center" valign="middle"><a href="fermes_supp.php?id=<?php echo $data["id"]; ?>">SUPPRIMER<img src="images/Delete.png" width="27" height="27" alt="Supprimer" border="0" /></a></td>
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
