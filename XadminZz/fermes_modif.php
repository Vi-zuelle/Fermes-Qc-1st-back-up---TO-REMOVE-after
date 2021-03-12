<?php
// session_start(); // Initialize session data
 session_start();

if ((isset($_SESSION['username_imex'])) && (!empty($_SESSION['username_imex']))){
		ob_start(); // Turn on output buffering

		include("../connexion.php");
		
		$id = $_GET["id"];
		
		$sAction = $_POST["a_edit"];
		
		if ($sAction == "U") {
			
			
			$x_nom = addslashes($_POST["nom"]);
			$x_adresse = addslashes($_POST["adresse"]);
			$x_description = addslashes($_POST["description"]);
			$x_web = $_POST["web"];
			
			$x_photo1  = $_FILES["photo1"]["name"];			
			$x_code1   = $_POST["photo1_code"];
			$x_supp1   = $_POST["supp1"];			
			
			$x_photo2  = $_FILES["photo2"]["name"];			
			$x_code2   = $_POST["photo2_code"];
			$x_supp2   = $_POST["supp2"];

			$x_photo3  = $_FILES["photo3"]["name"];			
			$x_code3   = $_POST["photo3_code"];
			$x_supp3   = $_POST["supp3"];

			$x_photo4  = $_FILES["photo4"]["name"];			
			$x_code4   = $_POST["photo4_code"];
			$x_supp4   = $_POST["supp4"];
			
			$x_photo5  = $_FILES["photo5"]["name"];			
			$x_code5   = $_POST["photo5_code"];
			$x_supp5   = $_POST["supp5"];

			$x_video   = $_FILES["video"]["name"];			
			$x_supp6   = $_POST["supp6"];
			$x_script  = $_POST['video_script'];

			$x_photo6 = $_FILES["photo6"]["name"];			
			$x_supp7   = $_POST["supp7"];
			$x_code6   = $_POST["photo6_code"];
			
			$x_photo7 = $_FILES["photo7"]["name"];			
			$x_supp8   = $_POST["supp8"];
			$x_code7   = $_POST["photo7_code"];
			
			$x_chemin  = $_POST['chemin'];			
			
			$maj = "UPDATE fermes SET nom = '".$x_nom."', adresse = '".$x_adresse."', descriptif = '".$x_description."', web = '".$x_web."', photo1_code = '".$x_code1."', photo2_code = '".$x_code2."', photo3_code = '".$x_code3."', photo4_code = '".$x_code4."', photo5_code = '".$x_code5."', photo6_code = '".$x_code6."', photo7_code = '".$x_code7."' ";
			
						 
				if($x_photo1){
					$maj .= ", photo1='".$x_photo1."' ";
				} 
				
				if($x_photo2){
					$maj .= ", photo2='".$x_photo2."' ";
				}
				
				if($x_photo3){
					$maj .= ", photo3 = '".$x_photo3."'";
				}
				
				if($x_photo4){
					$maj .= ", photo4 = '".$x_photo4."'";
				}
				
				if($x_photo5){
					$maj .= ", photo5 = '".$x_photo5."'";
				}				
				
				if($x_video){
					$maj .= ", video = '".$x_video."', video_script = '".$x_script."'";
				}
				
				if($x_photo6){
					$maj .= ", photo6 = '".$x_photo6."'";
				}	

				if($x_photo7){
					$maj .= ", photo7 = '".$x_photo7."'";
				}	


				if($x_supp1 == 1){
					$maj .= ", photo1='', photo1_code = '' ";
				}
				
				if($x_supp2 == 1){
					$maj .= ", photo2='', photo2_code = '' ";
				}
				
				if($x_supp3 == 1){
					$maj .= ", photo3='', photo3_code = '' ";
				}

				if($x_supp4 == 1){
					$maj .= ", photo4='', photo4_code = '' ";
				}
				
				if($x_supp5 == 1){
					$maj .= ", photo5='', photo5_code = '' ";
				}

				if($x_supp6 == 1){
					$maj .= ", video='' ";
				}
				
				if($x_supp7 == 1){
					$maj .= ", photo6='', photo6_code = '' ";
				}

				if($x_supp8 == 1){
					$maj .= ", photo7='', photo7_code = '' ";
				}

				
				
			$maj .= " WHERE id = '".$id."'";
				 
			include("charg_fic.php");

			mysql_query($maj);
			
			mysql_close(); 
		
			header("Location: fermes_liste.php");
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
		 $requete = "SELECT * FROM fermes WHERE id = '".$id."'";
		 $resultats = mysql_query($requete);
		 $data = mysql_fetch_array($resultats) ;
		
		?>
		
		<form action="fermes_modif.php?id=<?php echo $id;?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="chemin" value="images/fermes_quebec/" />
		<input type="hidden" name="a_edit" value="U" />
		
		<table width="800" cellpadding="0" cellspacing="0" align="center">
			<tr align="center">
			<td class="entete" height="151" valign="bottom">
			  <?php include("menu/menu2.php");?>
			
			  <div style="line-height:30px"><span class="stats">&nbsp;&nbsp;Modifier une Ferme</span> </div>
		  
			<hr width="790"></td>
			</tr>
		<td>
        
			<table width="800" cellpadding="5" cellspacing="0">

				<tr>
				<td class="corps">NOTE: <br /> Tous les textes doivent etre trait&eacute;s dans NotePad ou BlocNotes - mode txt- avant d etre ins&eacute;r&eacute;s ici. Les images doivent etre trait&eacute;es dans le bon format 923 x 615 px et compress&eacute;es pour le web.
                
                 <br /><br /><strong >Nom de la ferme</strong><br />
				<input type="text" size="80" name="nom" id="nom" value="<?php echo stripslashes($data["nom"]);?>">	
				</td>	
				</tr>

				<tr>
				<td class="corps"><strong >Adresse</strong><br />
				<input type="text" size="80" name="adresse" id="adresse" value="<?php echo stripslashes($data["adresse"]);?>">	
				</td>	
				</tr>
				
                <tr>
                <td class="corps"><strong>Description</strong><br />
                <textarea name="description" rows="4" cols="80" value=""><?php echo stripslashes($data["descriptif"]);?> </textarea></td>
                </tr>

				<tr>
				<td class="corps"><strong >Site WEB</strong><br />
				<input type="text" size="80" name="web" id="web" value="<?php echo $data["web"];?>">	
				</td>	
				</tr>

                <tr>
				<td class="corps">
				<hr width="450" align="left">
					
                <strong>Photo qui sera dans la Galerie</strong> 
                
                   	<?php if($data['photo1']){ ?>
						<span class="form_labels">&nbsp;&nbsp;&nbsp;fichier actuel --> <strong><?php echo $data['photo1']; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name ="supp1" value="1">
                        &nbsp;&nbsp;efface le fichier si coch&eacute;</span><br />
					<?php } ?>

				<input name="photo1" type="file" size="60" maxlength="80" /><br />
				
				
                Code &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="photo1_code" type="text"  size="2" value="<?php echo $data["photo1_code"];?>">
                &nbsp;&nbsp;&nbsp;1 pour photos obliques&nbsp;&nbsp;&nbsp;&nbsp;2 pour orthogonales&nbsp;&nbsp;&nbsp;3 pour Archives &nbsp;&nbsp;&nbsp;0 sans cat&eacute;gorie
                </td>
				</tr>
				
                <tr>
				<td class="corps">
				<hr width="450" align="left">
                <strong>Photo 2</strong>
                
                   	<?php if($data['photo2']){ ?>
						<span class="form_labels">&nbsp;&nbsp;&nbsp;fichier actuel --> <strong><?php echo $data['photo2']; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name ="supp2" value="1">
                        &nbsp;&nbsp;efface le fichier si coch&eacute;</span><br />
					<?php } ?>

				<input name="photo2" type="file" size="60" maxlength="80" /><br />
				
                Code &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="photo2_code" type="text"  size="2" value="<?php echo $data["photo2_code"];?>">
                &nbsp;&nbsp;&nbsp;1 pour photos obliques&nbsp;&nbsp;&nbsp;&nbsp;2 pour orthogonales&nbsp;&nbsp;&nbsp;3 pour Archives &nbsp;&nbsp;&nbsp;0 sans cat&eacute;gorie
				</td>
				</tr>
				
                <tr>
				<td class="corps">
				<hr width="450" align="left">
                <strong>Photo 3</strong>
                
                   	<?php if($data['photo3']){ ?>
						<span class="form_labels">&nbsp;&nbsp;&nbsp;fichier actuel --> <strong><?php echo $data['photo3']; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name ="supp3" value="1">
                        &nbsp;&nbsp;efface le fichier si coch&eacute;</span><br />
					<?php } ?>

				<input name="photo3" type="file" size="60" maxlength="80" /><br />
				
                Code &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="photo3_code" type="text"  size="2" value="<?php echo $data["photo3_code"];?>">
                &nbsp;&nbsp;&nbsp;1 pour photos obliques&nbsp;&nbsp;&nbsp;&nbsp;2 pour orthogonales&nbsp;&nbsp;&nbsp;3 pour Archives &nbsp;&nbsp;&nbsp;0 sans cat&eacute;gorie
				</td>
				</tr>

                <tr>
				<td class="corps">
				<hr width="450" align="left">
                <strong>Photo 4</strong>
                
                   	<?php if($data['photo4']){ ?>
						<span class="form_labels">&nbsp;&nbsp;&nbsp;fichier actuel --> <strong><?php echo $data['photo4']; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name ="supp4" value="1">
                        &nbsp;&nbsp;efface le fichier si coch&eacute;</span><br />
					<?php } ?>

				<input name="photo4" type="file" size="60" maxlength="80" /><br />
				
                Code &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="photo4_code" type="text"  size="2" value="<?php echo $data["photo4_code"];?>">
                &nbsp;&nbsp;&nbsp;1 pour photos obliques&nbsp;&nbsp;&nbsp;&nbsp;2 pour orthogonales&nbsp;&nbsp;&nbsp;3 pour Archives &nbsp;&nbsp;&nbsp;0 sans cat&eacute;gorie
				</td>
				</tr>
				
                <tr>
				<td class="corps">
				<hr width="450" align="left">
                <strong>Photo 5</strong>
                
                   	<?php if($data['photo5']){ ?>
						<span class="form_labels">&nbsp;&nbsp;&nbsp;fichier actuel --> <strong><?php echo $data['photo5']; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name ="supp5" value="1">
                        &nbsp;&nbsp;efface le fichier si coch&eacute;</span><br />
					<?php } ?>

				<input name="photo5" type="file" size="60" maxlength="80" /><br />
				
                Code &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="photo5_code" type="text"  size="2" value="<?php echo $data["photo5_code"];?>">
                &nbsp;&nbsp;&nbsp;1 pour photos obliques&nbsp;&nbsp;&nbsp;&nbsp;2 pour orthogonales&nbsp;&nbsp;&nbsp;3 pour Archives &nbsp;&nbsp;&nbsp;0 sans cat&eacute;gorie
				
				</td>
				</tr>
				
                <tr>
				<td class="corps">
				<hr width="450" align="left">
                <strong>Photo 6</strong>
                
                   	<?php if($data['photo6']){ ?>
						<span class="form_labels">&nbsp;&nbsp;&nbsp;fichier actuel --> <strong><?php echo $data['photo6']; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name ="supp7" value="1">
                        &nbsp;&nbsp;efface le fichier si coch&eacute;</span><br />
					<?php } ?>

				<input name="photo6" type="file" size="60" maxlength="80" /><br />
				
                Code &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="photo6_code" type="text"  size="2" value="<?php echo $data["photo6_code"];?>">
                &nbsp;&nbsp;&nbsp;1 pour photos obliques&nbsp;&nbsp;&nbsp;&nbsp;2 pour orthogonales&nbsp;&nbsp;&nbsp;3 pour Archives &nbsp;&nbsp;&nbsp;0 sans cat&eacute;gorie
                
				</td>
				</tr>

                <tr>
                <td class="corps">
   				<hr width="450" align="left">    
	            <strong>Photo 7</strong><br />
	            
                   	<?php if($data['photo7']){ ?>
						<span class="form_labels">&nbsp;&nbsp;&nbsp;fichier actuel --> <strong><?php echo $data['photo7']; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name ="supp8" value="1">
                        &nbsp;&nbsp;efface le fichier si coch&eacute;</span><br />
					<?php } ?>

				<input name="photo7" type="file" size="60" maxlength="80" /><br />
				
                Code &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="photo7_code" type="text"  size="2" value="<?php echo $data["photo7_code"];?>">
                &nbsp;&nbsp;&nbsp;1 pour photos obliques&nbsp;&nbsp;&nbsp;&nbsp;2 pour orthogonales&nbsp;&nbsp;&nbsp;3 pour Archives &nbsp;&nbsp;&nbsp;0 sans cat&eacute;gorie
                
                </td>
                </tr>				

<!--
                <tr>
				<td class="corps">
				<hr width="450" align="left">
                <strong>Vidéo</strong><br />
                Image
                
                   	<?php if($data['video']){ ?>
						<span class="form_labels">&nbsp;&nbsp;&nbsp;fichier actuel --> <strong><?php echo $data['video']; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--                        <input type="checkbox" name ="supp6" value="1">
                        &nbsp;&nbsp;efface le fichier si coché</span><br />
					<?php } ?>

				<input name="video" type="file" size="60" maxlength="80" /><br />
				
				 Script vidéo <textarea name="video_script" id="video_script" rows="5" cols="70"  value=""><?php echo $data['video_script'];?></textarea>
				
				</td>
				</tr>
-->


				<tr>
				<td class="corps"><br />
				<input name="form_stats" type="submit" value="Mettre &agrave; jour" />&nbsp;&nbsp;<input type="button" value="Annuler / Retour &agrave; la liste" onclick="location.href='fermes_liste.php'" />
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
