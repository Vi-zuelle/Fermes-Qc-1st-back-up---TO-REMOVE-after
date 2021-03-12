<?
$dv_host = "localhost";		

$dv_login = "airimex_airimex";			

$dv_pass = "Passe16022013";			

$dv_base = "airimex_AIRIMEX";	

 $connect = mysql_connect($dv_host,$dv_login,$dv_pass)
 or die("Impossible de se connecter au serveur  $dv_host - $dv_login .");

 mysql_select_db($dv_base, $connect)
 or die("Impossible de se connecter à la base");
 mysql_query("SET NAMES UTF8");
 
 //mysql_set_charset('utf8',$connect);

?>