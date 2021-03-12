<?php
	
$folder = $_POST['folder'] ;

// break;
	
$DESTINATION_FOLDER = $folder ;	
// echo $folder ;		

// Taille maximale de fichier, valeur en bytes					
$MAX_SIZE = 5000000000;	

// R�cup�ration de l'url de retour								
$RETURN_LINK = $_SERVER['HTTP_REFERER'];	

// D�finition des extensions de fichier autoris�es (avec le ".")
$AUTH_EXT = array(".doc", ".pdf", ".jpg",".bmp", ".gif", ".JPG", ".GIF", ".PDF", ".DOC", ".png", ".PNG");		  

// Fonction permettant de cr�er un lien de retour automatique

function createReturnLink(){
	global $RETURN_LINK;
	echo "<table align='center'><tr><td><a href='telechargement.php'>Retour</a></td></tr></table>";
}

// Fonction permettant de v�rifier si l'extension du fichier est
// autoris�e.

function isExtAuthorized($ext){
	global $AUTH_EXT;
	if(in_array($ext, $AUTH_EXT)){
		return true;
	}else{
		return false;
	}
}

// On v�rifie que le champs contenant le chemin du fichier soit
// bien rempli.
if(isset($_FILES["file"]["name"])){

// if(!empty($_FILES[$file]["name"])){
	
	// Nom du fichier choisi:
	$nomFichier = $_FILES["file"]["name"] ;
	// Nom temporaire sur le serveur:
	$nomTemporaire = $_FILES["file"]["tmp_name"] ;
	// Type du fichier choisi:
	$typeFichier = $_FILES["file"]["type"] ;
	// Poids en octets du fichier choisit:
	$poidsFichier = $_FILES["file"]["size"] ;
	// Code de l'erreur si jamais il y en a une:
	$codeErreur = $_FILES["file"]["error"] ;
	// Extension du fichier
	$extension = strrchr($nomFichier, ".");
	
	// Si le poids du fichier est de 0 bytes, le fichier est
	// invalide (ou le chemin incorrect) => message d'erreur
	// sinon, le script continue.
	if($poidsFichier <> 0){
		// Si la taille du fichier est sup�rieure � la taille
		// maximum sp�cifi�e => message d'erreur
		if($poidsFichier < $MAX_SIZE){
			// On teste ensuite si le fichier a une extension autoris�e
			if(isExtAuthorized($extension)){
				// Ensuite, on copie le fichier upload� ou bon nous semble.
				// echo($DESTINATION_FOLDER.$nomFichier);
				
				$uploadOk = move_uploaded_file($nomTemporaire, $DESTINATION_FOLDER.$nomFichier);
				
				if($uploadOk){
					echo "					
			<html>
			<head>
			
			<link href='../admin.css' rel='stylesheet' type='text/css' />
			</head>
			
			<body>
			
			<table width='800' cellpadding='0' cellspacing='0' align='center'>
				<tr>
				<td class='entete' height='155' valign='bottom'>";
				
				  include("menu/menu2.php");
				  
				  echo "<br />
				
				  <span class='stats'>&nbsp;&nbsp;T�l�chargement</span>
			  
				<hr width='790'>
                </td>
				</tr>
				<tr>
				<td height='300' class='corps' align='center'>
                <span class='corps'>
					<div align='center'>Le t�l�chargement a r�ussi !<br /><br />";
					
						if($extension =='.png' OR $extension =='.jpg' OR $extension =='.JPG' OR $extension =='.PNG'){
									echo '<img src='.$folder.''.$nomFichier.' /><br /><br />';
						}
					
					echo 'Le fichier <a href='.$folder.''.$nomFichier. '><b>'.$nomFichier. '</b></a> est sur le serveur.</div><br />';

					echo(createReturnLink());	
					
               echo " </span>
                
				</td>
				</tr>
				<tr>
				<td class='pieds' height='30'>&nbsp;</td>
				</tr>
			</table>
						
			</body>
			</html>";
						
				}else{
					
					echo "					
			<html>
			<head>
			
			<link href='../admin.css' rel='stylesheet' type='text/css' />
			</head>
			
			<body>
			
			<table width='800' cellpadding='0' cellspacing='0' align='center'>
				<tr>
				<td class='entete' height='155' valign='bottom'>";
				
				  include("../menu/menu2.php");
				  
				  echo "<br />
				
				  <span class='stats'>&nbsp;&nbsp;T�l�chargement</span>
			  
				<hr width='790'>
                </td>
				</tr>
				<tr>
				<td height='300' class='corps' align='center'>
                <span class='corps'>
					<div align='center'>Le t�l�chargement a �chou� pour le fichier <b>".$nomFichier."</b> !<br /><br />";
					
					echo (createReturnLink());
					
               echo " </span>
                
				</td>
				</tr>
				<tr>
				<td class='pieds' height='30'>&nbsp;</td>
				</tr>
			</table>
						
			</body>
			</html>";


				}
			}else{
				echo ("Les fichiers avec l'extension $extension ne peuvent pas �tre t�l�charg� !<br />");
				echo (createReturnLink()."<br>");
			}
		}else{
			$tailleKo = $MAX_SIZE / 1024;
			echo("Vous ne pouvez pas t�l�charger de fichiers dont la taille est sup�rieure � : $tailleKo Ko.<br />");
			echo (createReturnLink()."<br>");
		}		
	}else{
		echo("Le fichier choisi est invalide !<br>");
		echo (createReturnLink()."<br>");
	}
}else{
	echo("Vous n'avez pas choisi de fichier !<br>");
	echo (createReturnLink()."<br>");
}
?>