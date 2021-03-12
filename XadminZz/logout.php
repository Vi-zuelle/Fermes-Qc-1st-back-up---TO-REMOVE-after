<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering

	// Unset all of the session variables
	$_SESSION = array();

	// Delete the session cookie and kill the session
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
	}

	// Finally, destroy the session
	@session_destroy();
	echo '<script language="Javascript">
		<!--
		document.location.replace("login.html");
		// -->
		</script>';
?>
