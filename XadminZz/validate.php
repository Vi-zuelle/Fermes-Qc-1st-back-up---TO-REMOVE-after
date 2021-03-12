<?php
session_start();
include("../connexion.php");
 
$user_name = $_POST['user_name'];
$passe = $_POST['password'];
 
 //Préparation de la requête
 $query = "SELECT * FROM administrateurs WHERE nom='".$user_name."' AND passe='".$passe."' AND id_groupe = 1";

 //exécution de la requête et récupération du nombre de résultats
 $result = mysql_query($query, $connect);
 
 $affected_rows = count($result);
 
 $data = mysql_fetch_array($result); 

if($data['nom']<>'' AND $data['id_groupe'] == 1) { 
 
			 
			 $niveau = $data['id_groupe'];
			 
			 //S'il y a exactement un résultat, l'utilisateur est authentifié, sinon, on l'empêche d'entrer

		 ?>
			 
			   <table align="center">
				<tr><td><br />
					<br />
					<br />
					<br />
					<br />
					<br />
					Vous &ecirc;tes authentifi&eacute </td></tr>
			   </table>
				 
				<script language="Javascript">
						<!--
					setTimeout("document.location = 'index.php' ", 1000) 
					// -->
				</script>
					
				<?php    
		
				 //On ajoute l'utilisateur aux variables de session
				 
				$_SESSION['username_imex'] = $niveau.'_'.$user_name; 
				
/*				echo $_SESSION['username_imex'];
				echo '         '.$affected_rows;
				echo '         '.$password;
				
				break;
*/		
		} else { ?>
			
				<table align="center">
				<tr><td><br />
					<br />
					<br />
					<br />
					<br />
					<br />Acc&egrave;s refus&eacute </td></tr>
				</table>
				 
				 
				<script language="Javascript">
						<!--
					setTimeout("document.location = 'login.html' ", 2000) 
					// -->
					</script>
				<?php    
		}
 
 mysql_close(); 
?>