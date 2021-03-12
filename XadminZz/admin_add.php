<?php
// session_start(); // Initialize session data
 session_start();
$niv = substr($_SESSION['username_imex'],0,1);

if ((isset($_SESSION['username_imex'])) && (!empty($_SESSION['username_imex'])) && ($niv == 1)){
		ob_start(); // Turn on output buffering

		include("../connexion.php");
		$id = $_GET["id"];
		
		
		//echo $_POST["a_edit"];
		//echo $_POST["FCK_titre"];
		
		// Get action
		$sAction = $_POST["a_edit"];
		
		if ($sAction == "U") {
		
			// Get fields from form
			$x_nom = $_POST["nom"];
		//	echo $x_titre;
			$x_passe = $_POST["passe"];
			$x_niv = $_POST["niv"];
		
			if($x_nom AND $x_passe){
				mysql_query("INSERT INTO administrateurs(nom,passe,id_groupe) VALUES('".$x_nom."','".$x_passe."','".$x_niv."')");
			}
			
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
		
		
		<table width="800" cellpadding="0" cellspacing="0" align="center">
			<tr>
			<td class="entete" height="151" valign="bottom">
			  <?php  include("menu/menu2.php");?>
              <div style="line-height:30px">
			
			  <span class="stats">&nbsp;&nbsp;Ajouter un administrateur</span>
		  </div>
			<hr width="790"></td>
			</tr>
			<tr><td class="corps">
			  <form action="admin_add.php" method="POST">
			  <input type="hidden" name="a_edit" value="U">
		  
			<table width="500" cellpadding="5" cellspacing="0" align="center">
				<tr>
				<td>Nom de l'administrateur<br />
				<input name="nom" type="text" size="30" value="<?php echo $data["nom"];?>"> </td>
				</tr>
                <tr>
				<td>Mot de passe<br />
				<input name="passe" type="password" size="30" value="<?php echo $data["passe"];?>"></td>
				</tr>
                <tr>
				<td>Niveau<br />
				<input name="niv" type="text" size="4" value="<?php echo $data["id_groupe"];?>">&nbsp;&nbsp;1 = Administrateur &nbsp;&nbsp;-&nbsp;&nbsp; 2 = Les autres</td>
				</tr>
                
				<tr>
				<td><br />
				<input name="form_stats" type="submit" value="ajouter" />&nbsp;&nbsp; <input name="form_stats" type="button" value="annuler" onclick="location.href='admin_liste.php'" /></td>
			</table>
		</form>    
		</td>
		</tr><tr>
		<td class="pieds" height="25" align="center">&nbsp;</td>
		</tr>
		<table>
		
		
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
