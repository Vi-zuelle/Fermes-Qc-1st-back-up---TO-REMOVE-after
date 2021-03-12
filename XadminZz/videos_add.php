<?php
// session_start(); // Initialize session data
 session_start();

if ((isset($_SESSION['username_imex'])) && (!empty($_SESSION['username_imex']))){
		ob_start(); // Turn on output buffering

		include("../connexion.php");
		
		//$id = $_GET["id"];
		
		
		//echo $_POST["a_edit"];
		//echo $_POST["FCK_titre"];
		
		// Get action
		$sAction = $_POST["a_edit"];
		
		if ($sAction == "U") {
		
			// Get fields from form
			$x_description = addslashes($_POST["description"]);
			$x_photo = $_FILES["vignette"]['name'];
			$x_script = $_POST["script"];
			$x_script = $_POST["script"];
			$x_classement = $_POST['classement'];
			
				if($x_photo){
					include('charg_fic_vignette.php');
				}
			
			mysql_query("INSERT INTO videos(vignette,description,classement,script) VALUES('".$x_photo."','".$x_description."','".$x_classement."','".$x_script."')");
			
			mysql_close(); 
		
			header("Location: videos_liste.php");
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
			<td class="entete" height="151" valign="bottom"><br /><br /><br /><br />
			  <?php include("menu/menu2.php");?><br /><br />
			
			  <div align="center"><span class="stats">&nbsp;&nbsp;Ajouter une Photo</span></div>
		  
			<hr width="790"></td>
			</tr>
			<tr><td>
			  <form action="videos_add.php" method="POST" enctype="multipart/form-data">
			  <input type="hidden" name="a_edit" value="U">
			  <input type="hidden" name="chemin" value="photos">
              
		  
			<table width="800" cellpadding="5" cellspacing="0">
                <tr>
				<td class="corps">
                Fichier vignette<br />
                <input name="vignette" type="file" size="70" maxlength="80" value="">
                le fichier se t&eacute;l&eacute;charge en cliquant sur ajouter
				</td>
				</tr>
                <tr>
                <td class="corps">Description&nbsp;&nbsp;<br />
                
                <textarea name="description" rows="5" cols="70" value=""> </textarea></td>
                </tr>
                <tr>
                <td class="corps">Script&nbsp;&nbsp;<br />
                
                <textarea name="script" rows="7" cols="70" value=""> </textarea></td>
                </tr>
                
                <tr>
				<td class="corps">
                Classement&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="classement" type="text"  size="4" value="">
                </td>
				</tr>
                
				<tr>
				<td class="corps"><br />
				<input name="form_stats" type="submit" value="Ajouter" />&nbsp;&nbsp;<input type="button" value="Annuler / Retour à la liste" onclick="location.href='videos_liste.php'" /></td>
			</table>
            
		</form>    
		</td>
		</tr><tr>
		<td class="pieds" height="25" align="center">&nbsp;</td>
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
