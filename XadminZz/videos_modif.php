<?php
// session_start(); // Initialize session data
 session_start();

if ((isset($_SESSION['username_imex'])) && (!empty($_SESSION['username_imex']))){
		ob_start(); // Turn on output buffering

		include("../connexion.php");
		$id = $_GET["id"];
		
		//echo $_POST["a_edit"];
		//echo $_POST["FCK_titre"];
		
		// Get action
		$sAction = $_POST["a_edit"];
		
		if ($sAction == "U") {
		
			// Get fields from form
			$x_classement        = $_POST["classement"];
			$x_vignette         = $_FILES["vignette"]["name"];
			$x_description       = addslashes($_POST["description"]);
			$x_chemin      = $_POST['chemin'];
			$x_supp        = $_POST["supp"];
			$x_script = $_POST["script"];
			
			
				if($x_vignette){
					$maj = "UPDATE videos SET script = '".$x_script."', classement = '".$x_classement."', vignette = '".$x_vignette."',description = '".$x_description."' WHERE id = '".$id."'";										
					include("charg_fic_vignette.php");
				 } else {
					$maj = "UPDATE videos SET script = '".$x_script."', classement = '".$x_classement."', ";										
					 
						if($x_supp==1){ 
							$maj .= "vignette='', ";	
						}
					
					$maj.=" description = '".$x_description."' ";
					$maj .= "WHERE id = '".$id."'";
				 }
			
			// $maj = "UPDATE communiques SET date_c = '".$x_date."', description = '".$x_description."', pdf = '".$x_pdf."',titre = '".$x_titre."' WHERE id = '".$id."'";
			
			mysql_query($maj);
			
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
		<meta http-equiv="pragma" content="no-cache" />

		</head>
		
		<body>
		<?php
		 $requete = "SELECT * FROM videos WHERE id = '".$id."'";
		 $resultats = mysql_query($requete);
		 $data = mysql_fetch_array($resultats) ;
		
		?>
		
		<form action="videos_modif.php?id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="chemin" value="photos" />
		<input type="hidden" name="a_edit" value="U" />
		
		<table width="800" cellpadding="0" cellspacing="0" align="center">
			<tr align="center">
			<td class="entete" height="151" valign="bottom">
			  <?php include("menu/menu2.php");?>
			
			  <div style="line-height:30px"><span class="stats">&nbsp;&nbsp;Modifier une video</span></div>
		  
			<hr width="790"></td>
			</tr>
		<td>
        
			<table width="800" cellpadding="5" cellspacing="0">
                <tr>
				<td class="corps">
                Fichier vignette 
                
                   	<?php if($data['vignette']){ ?>
						<span class="form_labels">&nbsp;&nbsp;&nbsp;fichier actuel --> <strong><?php echo $data['vignette']; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name ="supp" value="1">
                        &nbsp;&nbsp;efface le fichier si coché</span>,Mettre &agrave; jour pour faire disparaitre.<br>
					<?php } ?>

				<input name="vignette" type="file" size="70" maxlength="80" />
				</td>
                
				</tr>
                <tr>
                <td class="corps">Description&nbsp;&nbsp;<br />
                
                <textarea name="description" rows="5" cols="70" value=""><?php echo stripslashes($data["description"]);?> </textarea></td>
                </tr>
                <tr>
                <td class="corps">Lien vidéo&nbsp;&nbsp;<br />
                
                <textarea name="script" rows="8" cols="70" value=""><?php echo $data["script"];?> </textarea></td>
                </tr>
                
                <tr>
				<td class="corps">
                Classement&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="classement" type="text"  size="4" value="<?php echo $data["classement"];?>">
				</td>
				</tr>
				<tr>
				<td class="corps">
				<input name="form_stats" type="submit" value="Mettre à jour" />&nbsp;&nbsp;<input type="button" value="Annuler / Retour à la liste" onclick="location.href='videos_liste.php'" /></td>
                </tr>
			</table>
            
		</td>
		</tr><tr>
		<td class="pieds" height="25" align="center">&nbsp;</td>
		</tr>
		</table>
		
		</form>
		
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
