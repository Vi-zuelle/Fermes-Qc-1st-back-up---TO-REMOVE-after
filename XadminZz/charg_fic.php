<?php


if($x_photo1){

	$dossier = '../'. $x_chemin .'/photos/';
	
	$fichier = basename($_FILES['photo1']['name']);
	
	$taille_maxi = 5000000000;
	$taille = filesize($_FILES['photo1']['tmp_name']);
	$extensions = array('.PDF', '.pdf', '.DOC', '.doc', '.jpg', '.JPG', '.gif', '.GIF', '.png', '.PNG');
	$extension = strrchr($_FILES['photo1']['name'], '.'); 
	
	//Début des vérifications de sécurité...
		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
			 $erreur = 'Vous devez t&eacute;l&eacute;charger un fichier de type image...';
		}
		
		if($taille>$taille_maxi)
		{
			 $erreur = 'Le fichier est trop gros...';
		}
	
		if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
		{
			 
				 if(move_uploaded_file($_FILES['photo1']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
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
		}
}

if($x_photo2){

	$dossier = '../'. $x_chemin .'/photos/';
	
	$fichier = basename($_FILES['photo2']['name']);
	
	$taille_maxi = 5000000000;
	$taille = filesize($_FILES['photo2']['tmp_name']);
	$extensions = array('.PDF', '.pdf', '.DOC', '.doc', '.jpg', '.JPG', '.gif', '.GIF', '.png', '.PNG');
	$extension = strrchr($_FILES['photo2']['name'], '.'); 
	
	//Début des vérifications de sécurité...
		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
			 $erreur = 'Vous devez t&eacute;l&eacute;charger un fichier de type image...';
		}
		
		if($taille>$taille_maxi)
		{
			 $erreur = 'Le fichier est trop gros...';
		}
	
		if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
		{
			 
				 if(move_uploaded_file($_FILES['photo2']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
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
		}
}

if($x_photo3){

	$dossier = '../'. $x_chemin .'/photos/';
	
	$fichier = basename($_FILES['photo3']['name']);
	
	$taille_maxi = 5000000000;
	$taille = filesize($_FILES['photo3']['tmp_name']);
	$extensions = array('.PDF', '.pdf', '.DOC', '.doc', '.jpg', '.JPG', '.gif', '.GIF', '.png', '.PNG');
	$extension = strrchr($_FILES['photo3']['name'], '.'); 
	
	//Début des vérifications de sécurité...
		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
			 $erreur = 'Vous devez t&eacute;l&eacute;charger un fichier de type image...';
		}
		
		if($taille>$taille_maxi)
		{
			 $erreur = 'Le fichier est trop gros...';
		}
	
		if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
		{
			 
				 if(move_uploaded_file($_FILES['photo3']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
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
		}
}

if($x_photo4){

	$dossier = '../'. $x_chemin .'/photos/';
	
	$fichier = basename($_FILES['photo4']['name']);
	
	$taille_maxi = 5000000000;
	$taille = filesize($_FILES['photo4']['tmp_name']);
	$extensions = array('.PDF', '.pdf', '.DOC', '.doc', '.jpg', '.JPG', '.gif', '.GIF', '.png', '.PNG');
	$extension = strrchr($_FILES['photo4']['name'], '.'); 
	
	//Début des vérifications de sécurité...
		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
			 $erreur = 'Vous devez t&eacute;l&eacute;charger un fichier de type image...';
		}
		
		if($taille>$taille_maxi)
		{
			 $erreur = 'Le fichier est trop gros...';
		}
	
		if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
		{
			 
				 if(move_uploaded_file($_FILES['photo4']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
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
		}
}

if($x_photo5){

	$dossier = '../'. $x_chemin .'/photos/';
	
	$fichier = basename($_FILES['photo5']['name']);
	
	$taille_maxi = 5000000000;
	$taille = filesize($_FILES['photo5']['tmp_name']);
	$extensions = array('.PDF', '.pdf', '.DOC', '.doc', '.jpg', '.JPG', '.gif', '.GIF', '.png', '.PNG');
	$extension = strrchr($_FILES['photo5']['name'], '.'); 
	
	//Début des vérifications de sécurité...
		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
			 $erreur = 'Vous devez t&eacute;l&eacute;charger un fichier de type image...';
		}
		
		if($taille>$taille_maxi)
		{
			 $erreur = 'Le fichier est trop gros...';
		}
	
		if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
		{
			 
				 if(move_uploaded_file($_FILES['photo5']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
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
		}
}



if($x_video){

	$dossier = '../'. $x_chemin .'/video/';
	
	$fichier = basename($_FILES['video']['name']);
	
	$taille_maxi = 50000000000000;
	$taille = filesize($_FILES['video']['tmp_name']);
	$extensions = array('.PDF', '.pdf', '.DOC', '.doc', '.jpg', '.JPG', '.gif', '.GIF', '.png', '.PNG','.mp4','.MP4');
	$extension = strrchr($_FILES['video']['name'], '.'); 
	
	//Début des vérifications de sécurité...
		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
			 $erreur = 'Vous devez t&eacute;l&eacute;charger un fichier de type image...';
		}
		
		if($taille>$taille_maxi)
		{
			 $erreur = 'Le fichier est trop gros...';
		}
	
		if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
		{
			 
				 if(move_uploaded_file($_FILES['video']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
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
		}
}

if($x_photo6){

	$dossier = '../'. $x_chemin .'/photos/';
	
	$fichier = basename($_FILES['photo6']['name']);
	
	$taille_maxi = 5000000000;
	$taille = filesize($_FILES['photo6']['tmp_name']);
	$extensions = array('.PDF', '.pdf', '.DOC', '.doc', '.jpg', '.JPG', '.gif', '.GIF', '.png', '.PNG');
	$extension = strrchr($_FILES['photo6']['name'], '.'); 
	
	//Début des vérifications de sécurité...
		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
			 $erreur = 'Vous devez t&eacute;l&eacute;charger un fichier de type image...';
		}
		
		if($taille>$taille_maxi)
		{
			 $erreur = 'Le fichier est trop gros...';
		}
	
		if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
		{
			 
				 if(move_uploaded_file($_FILES['photo6']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
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
		}
}

if($x_photo7){

	$dossier = '../'. $x_chemin .'/photos/';
	
	$fichier = basename($_FILES['photo7']['name']);
	
	$taille_maxi = 5000000000;
	$taille = filesize($_FILES['photo7']['tmp_name']);
	$extensions = array('.PDF', '.pdf', '.DOC', '.doc', '.jpg', '.JPG', '.gif', '.GIF', '.png', '.PNG');
	$extension = strrchr($_FILES['photo7']['name'], '.'); 
	
	//Début des vérifications de sécurité...
		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
			 $erreur = 'Vous devez t&eacute;l&eacute;charger un fichier de type image...';
		}
		
		if($taille>$taille_maxi)
		{
			 $erreur = 'Le fichier est trop gros...';
		}
	
		if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
		{
			 
				 if(move_uploaded_file($_FILES['photo7']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
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
		}
}


if(photo_accueil1){

	$dossier = '../'. $x_chemin .'/';
	
	$fichier = basename($_FILES['photo_accueil1']['name']);
	
	$taille_maxi = 5000000000;
	$taille = filesize($_FILES['photo_accueil1']['tmp_name']);
	$extensions = array('.PDF', '.pdf', '.DOC', '.jpg', '.JPG', '.gif', '.GIF', '.png', '.PNG');
	$extension = strrchr($_FILES['photo_accueil1']['name'], '.'); 
	
	//Début des vérifications de sécurité...
		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
			 $erreur = 'Vous devez t&eacute;l&eacute;charger un fichier de type image...';
		}
		
		if($taille>$taille_maxi)
		{
			 $erreur = 'Le fichier est trop gros...';
		}
	
		if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
		{
			 
				 if(move_uploaded_file($_FILES['photo_accueil1']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
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
		}
}

?>
