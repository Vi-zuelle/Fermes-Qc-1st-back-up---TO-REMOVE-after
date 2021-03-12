<?php
// session_start(); // Initialize session data
 session_start();

if ((isset($_SESSION['username_imex'])) && (!empty($_SESSION['username_imex']))){
		ob_start(); // Turn on output buffering
		
		include("../connexion.php"); 

		$id = $_GET["id"];
		
		// Get action
		$sAction = $_POST["a_edit"];
		
		if ($sAction == "S") {
		
			mysql_query("DELETE FROM photos_accueil WHERE id = '".$id."'");
			mysql_close(); 
		
			header("Location: photos_accueil_liste.php");
			exit;
		}
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
		 $requete = "SELECT * FROM photos_accueil WHERE id = '".$id."'";
		 $resultats = mysql_query($requete);
		 $data = mysql_fetch_array($resultats) ;
		?>
		
		
		
		<table width="800" cellpadding="0" cellspacing="0" align="center">
			<tr align="center">
			<td class="entete" height="151" valign="bottom">
			  <?php  include("menu/menu2.php");?>
			
			  <div style="line-height:30px"><span class="stats">&nbsp;&nbsp;Supprimer la photo du diaporama</span></div>
		  
			<hr width="790"></td>
			</tr>
			<tr>
			<td class="corps">
			<form action="photo_accueil_supp.php?id=<?php echo $id;?>" method="POST">
			<input type="hidden" name="a_edit" value="S">
			
			<table align="left" cellpadding="5">
            <tr>
				<td>
				<img src='../images/diaporama_accueil/<?php echo $data["nom_photo"];?>' height = '150'/><br />
				<?php echo $data["adresse"];?>    
				</td>
			</tr>
			
			<tr>
			<td colspan="3"><br />
			<input name="form_stats" type="submit" value="supprimer" />&nbsp;&nbsp; <input name="form_stats" type="button" value="Annuler / Retour à la liste" onclick="location.href='photos_accueil_liste.php'" /></td>
			</tr>
		</table>
		
		</form>
		</td>
		</tr>
		<tr>
		<td height="30" class="pieds">&nbsp;</td>
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
