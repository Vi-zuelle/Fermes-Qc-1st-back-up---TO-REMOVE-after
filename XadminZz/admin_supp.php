<?php
// session_start(); // Initialize session data
 session_start();
$niv = substr($_SESSION['username_imex'],0,1);

if ((isset($_SESSION['username_imex'])) && (!empty($_SESSION['username_imex'])) && ($niv == 1)){
		ob_start(); // Turn on output buffering

		include("../connexion.php");
		$id = $_GET["id"];
		
		// Get action
		$sAction = $_POST["a_edit"];
		
		if ($sAction == "S") {
		
			// Get fields from form
			// Get fields from form
			$x_nom = $_POST["nom"];
		//	echo $x_titre;
			$x_passe = $_POST["passe"];
			
				mysql_query("DELETE FROM administrateurs WHERE id = '".$id."'");
				
			mysql_close(); 
		
			header("Location: admin_liste.php");
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
		 $requete = "SELECT * FROM administrateurs WHERE id = '".$id."'";
		 $resultats = mysql_query($requete);
		 $data = mysql_fetch_array($resultats) ;
		?>
		
		
		
		<table width="800" cellpadding="0" cellspacing="0" align="center">
			<tr align="center">
			<td class="entete" height="151" valign="bottom">
			  <?php  include("menu/menu2.php");?>
			<div style="line-height:30px">
			  <span class="stats">&nbsp;&nbsp;Supprimer un Administrateur</span>
		  	</div>
			<hr width="790"></td>
			</tr>
			<tr>
			<td class="corps">
			<form action="admin_supp.php?id=<?php echo $id;?>" method="POST">
			<input type="hidden" name="a_edit" value="S">
			
			<table align="center" width="500"><tr>
							<td  align="left"><img src="images/boule.gif" width="6" height="6" /> Administrateur : <span class="stats"><?php echo $data["nom"];?></span></td>
							<td  height="50"><!--Mot de passe : <span class="stats"><?php echo $data["passe"];?></span>--></td>
			</tr>
			
			<tr>
			<td colspan="2"><br />
			<input name="form_stats" type="submit" value="supprimer" />&nbsp;&nbsp; <input name="form_stats" type="button" value="annuler" onclick="location.href='admin_liste.php'" /></td>
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
