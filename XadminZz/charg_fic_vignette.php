<?php

$dossier = '../'. $x_chemin .'/';

$fichier = basename($_FILES['vignette']['name']);



$taille_maxi = 5000000000;
$taille = filesize($_FILES['vignette']['tmp_name']);
$extensions = array('.PDF', '.pdf', '.DOC', '.doc', '.jpg', '.JPG', '.gif', '.GIF', '.png', '.PNG');
$extension = strrchr($_FILES['vignette']['name'], '.'); 

//Début des vérifications de sécurité...
	if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
	{
		 $erreur = 'Vous devez t&eacute;l&eacute;charger un fichier de type pdf ou doc...';
	}
	
	if($taille>$taille_maxi)
	{
		 $erreur = 'Le fichier est trop gros...';
	}

	if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
	{
		 
			 if(move_uploaded_file($_FILES['vignette']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
			 {
			}
			 else //Sinon (la fonction renvoie FALSE).
			 {
				  echo '&Eacute;chec du t&eacute;l&eacute;chargement!';
			 }
	}
	else
	{
     echo $erreur;
	 break;
	}
?>
