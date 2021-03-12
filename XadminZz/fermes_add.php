<?php
// session_start(); // Initialize session data
 session_start();

//if ((isset($_SESSION['username_imex'])) && (!empty($_SESSION['username_imex']))){
		ob_start(); // Turn on output buffering

		include("../connexion.php");
		
			
			mysql_query("INSERT INTO fermes(nom) VALUES('')");
			
			mysql_close(); 
		
			header("Location: fermes_liste.php");
			exit;
		?>
