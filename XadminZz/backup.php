<?php
function dumpMySQL($mode)
{
	
    include('../connexion.php');
	
    $entete = "-- ----------------------\n";
    $entete .= "-- dump de la base ".$base." au ".date("d-M-Y")."\n";
    $entete .= "-- ----------------------\n\n\n";
    $creations = "";
    $insertions = "\n\n";
    
    $listeTables = mysql_query("show tables", $connect);
    while($table = mysql_fetch_array($listeTables))
    {
        // si l'utilisateur a demandé la structure ou la totale
        if($mode == 1 || $mode == 3)
        {
            $creations .= "-- -----------------------------\n";
            $creations .= "-- creation de la table ".$table[0]."\n";
            $creations .= "-- -----------------------------\n";
            $listeCreationsTables = mysql_query("show create table ".$table[0], $connect);
            while($creationTable = mysql_fetch_array($listeCreationsTables))
            {
              $creations .= $creationTable[1].";\n\n";
            }
        }
        // si l'utilisateur a demandé les données ou la totale
        if($mode > 1)
        {
            $donnees = mysql_query("SELECT * FROM ".$table[0]);
            $insertions .= "-- -----------------------------\n";
            $insertions .= "-- insertions dans la table ".$table[0]."\n";
            $insertions .= "-- -----------------------------\n";
            while($nuplet = mysql_fetch_array($donnees))
            {
                $insertions .= "INSERT INTO ".$table[0]." VALUES(";
                for($i=0; $i < mysql_num_fields($donnees); $i++)
                {
                  if($i != 0)
                     $insertions .=  ", ";
                  if(mysql_field_type($donnees, $i) == "string" || mysql_field_type($donnees, $i) == "blob")
                     $insertions .=  "'";
                  $insertions .= addslashes($nuplet[$i]);
                  if(mysql_field_type($donnees, $i) == "string" || mysql_field_type($donnees, $i) == "blob")
                    $insertions .=  "'";
                }
                $insertions .=  ");\n";
            }
            $insertions .= "\n";
        }
    }

    mysql_close($connect);
	
	$Dat = date("d_M_Y");
    $fichierDump = fopen("sauvegardes/sauvegarde_fermes_quebec_du_".$Dat.".sql", "wb");
    fwrite($fichierDump, $entete);
    fwrite($fichierDump, $creations);
    fwrite($fichierDump, $insertions);
    fclose($fichierDump);
	
	$fic= "sauvegarde_fermes_quebec_du_".$Dat.".sql";
    echo "<div align='center'><br>Sauvegarde r&eacute;alis&eacute;e avec succ&egrave;s sur le serveur sous le nom de <br /><br /><strong>".$fic."</strong></div>";
}
?>
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
			<title></title>
			
			<link href="admin.css" rel="stylesheet" type="text/css" />
			</head>
			
			<body>
			
			<table width="800" cellpadding="0" cellspacing="0" align="center">
			  <tr>
				<td class="entete" height="151" valign="bottom">
				  <?php  include("menu/menu2.php");?>
				<span class="stats">&nbsp;&nbsp;Sauvegarde de la base de donn&eacute;es</span>
			  
				<hr width="790">
                </td>
			  </tr>
				<tr>
				<td height="200" class="corps" align="center">

					<?php
                    dumpMySQL(3);
                    
                    
                    // Test du téléchargement d'un fichier avec reconnaissance du type de fichier 
                    $Dat = date("d_M_Y");
                    
					$fic= "sauvegarde_fermes_quebec_du_".$Dat.".sql";
                    // echo "<br><br>fichier ".$fic ;
                    ?>
                    
                    <br><br><div align='center'><a href="telecharger.php?Fichier_a_telecharger=<?php echo $fic ;?>&amp;chemin=sauvegardes/">T&eacute;l&eacute;charger cette sauvegarde sur votre poste de travail</a><br>
					</div>

                  </td>
			  </tr>
				<tr>
				<td class="pieds" height="30">&nbsp;</td>
				</tr>
			</table>
						
			</body>
			</html>

