<?php
// session_start(); // Initialize session data
 session_start();

if ((isset($_SESSION['username_imex'])) && (!empty($_SESSION['username_imex']))){
		ob_start(); // Turn on output buffering

		include("../connexion.php");
		
		$id = $_GET["id"];
		
		$sAction = $_POST["a_edit"];
		
		if ($sAction == "U") {
			
			$x_titre = addslashes($_POST["titre1"]);
			$x_lien = addslashes($_POST["lien1"]);
			$x_txt_lien = addslashes($_POST["txt_lien1"]);
			
			$x_photo_acc  = $_FILES["photo_accueil1"]["name"];			
			$x_code   = $_POST["photo_accueil_code"];
			$x_supp   = $_POST["supp"];			
			
			
			$x_chemin  = $_POST['chemin'];			
			
			$maj = "UPDATE photos_accueil SET titre = '".$x_titre."', lien = '".$x_lien."', text_lien = '". $x_txt_lien."', code = '".$x_code."' ";
			
				if($x_photo_acc){
					$maj .= ", nom_photo = '".$x_photo_acc."' ";
				} 				
				
			$maj .= " WHERE id = '".$id."'";
				 
			include("charg_fic.php");

			mysql_query($maj);
			
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
		<meta http-equiv="pragma" content="no-cache" />

		</head>
		
		<body>
		<?php
		 $requete = "SELECT * FROM photos_accueil WHERE id = '".$id."'";
		 $resultats = mysql_query($requete);
		 $data = mysql_fetch_array($resultats) ;
		
		?>
		
		<form action="photo_accueil_modif.php?id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="chemin" value="images/diaporama_accueil" />
		<input type="hidden" name="a_edit" value="U" />
		
		<table width="800" cellpadding="0" cellspacing="0" align="center">
			<tr align="center">
			<td class="entete" height="151" valign="bottom">
			  <?php include("menu/menu2.php");?>
			
			  <div style="line-height:30px"><span class="stats">&nbsp;&nbsp;Modifier une photo d'accueil</span> </div>
		  
			<hr width="790"></td>
			</tr>
		<td>
        
			<table width="800" cellpadding="5" cellspacing="0">

				<tr>
				<td class="corps">&nbsp;NOTE: <br /> Tous les <B>TEXTES </B> doivent etre trait&eacute;s dans NotePad ou BlocNotes - mode txt- avant d etre ins&eacute;r&eacute;s ici. <br />Les <B>PHOTOS du DIAPORAMA</B> doivent etre trait&eacute;es dans le bon format <B>2200 x 1376 px et sauvegard&eacute;es pour le web en mode .jpg </B>( compression 70% ou 7 sur 10)<BR /> <b> CODES HTML </b> pour lettrages de couleur et retour de ligne: CHANGER UNIQUEMENT LE TEXTE entre le CODE HTML.  Prenez note de ces codes au cas ou vous les effaceriez. (span avant, et span apr&egrave;s, avec petites parenth&egrave;ses)<br />
                Pour obtenir un TITRE SUR 2 LIGNES (voir mod&egrave;le de page 2): &eacute;mettre un "br /" avec petites parenth&egrave;ses avant et apr&egrave;s. 
                
                 <br /><br /><strong >Titre</strong><br />
				<input type="text" size="80" name="titre1" id="titre1" value="<?php echo stripslashes($data["titre"]);?>">	
				</td>	
				</tr>
                
				<tr>
				<td class="corps"><strong >Texte du lien</strong><br />
				<input type="text" size="80" name="txt_lien1" id="txt_lien1" value="<?php echo stripslashes($data["text_lien"]);?>">	
				</td>	
				</tr>
				
                <tr>
                <td class="corps"><strong>Adresse du lien</strong>&nbsp;NOTE : ins&eacute;rer ici le NOM DE LA PAGE de l'adresse URL de votre site (dans votre navigateur web): Si vous voyez : fermes.quebec/galerie.php, inscrire : <B>galerie.php</B><br />
                <input name="lien1" id="lien1" size="80" value="<?php echo stripslashes($data["lien"]);?>">
                <br /> 
                </td>
                </tr>

                <tr>
				<td class="corps">
				<hr width="450" align="left">
					
                <strong>Photo qui sera dans le diaporama de l'accueil.</strong>  Cliquez sur <b>Browse </b> et t&eacute;l&eacute;chargez votre nouvelle photo.<br /><br />
                
                   	<?php if($data['nom_photo']){ ?>
						<span class="form_labels">&nbsp;&nbsp;&nbsp;fichier actuel --> <strong><?php echo $data['nom_photo']; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </span><br />
					<?php } ?>
<br />
				<input name="photo_accueil1" id = "photo_accueil1" type="file" size="60" maxlength="80" /><br /><br />
				
				
                <strong>Ordre d'apparition</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="photo_accueil_code" type="text"  size="2" value="<?php echo $data["code"];?>">
                
                </td>
				</tr>
				
				<tr>
				<td class="corps"><br />
				<input name="form_stats" type="submit" value="Mettre &agrave; jour" />&nbsp;&nbsp;<input type="button" value="Annuler / Retour &agrave; la liste" onclick="location.href='photos_accueil_liste.php'" />
				</td>
				</tr>
			</table>
            
		</td>
		</tr><tr>
		<td class="pieds" height="25" align="center">&nbsp;</td>
		</tr>
		<table>
		
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
