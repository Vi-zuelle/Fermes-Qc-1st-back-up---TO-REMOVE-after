<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu;

include 'class/kconfig.class.php';

echo '<h1>'.KLN_DEL_TIT.'</h1>';
echo '<p>'.KLN_DEL_INF.'</p>';

if ($_SESSION['kie_operation'] == 'delete')
{
 $connexion = new ksqllayer ($kietu['mysql_host'], $kietu['mysql_user'], $kietu['mysql_pass'],  $kietu['mysql_database']);
 $kie['liste_tables'] = array('domai', 'heure', 'pages', 'recent', 'refer', 'visit');
 foreach ($kie['liste_tables'] AS $value)
 {
  $connexion->query('DELETE FROM '.$kietu['mysql_prefixe'].$value.' WHERE id_sit=\''.$_SESSION['kie_id'].'\'');
 }
 $connexion->close();
 $cfg = new kconfigfile('inc/configsites.php');
 $i = 0;
 while ($cfg->valeur('kietu[\'liste_sites\']['.$_SESSION['kie_id'].']['.$i.']') == true)
 {
  $cfg->delete('kietu[\'liste_sites\']['.$_SESSION['kie_id'].']['.$i.']');
  $i++;
 }
 if ($cfg->save())
 {
  echo '<p class="success">'.KLN_DEL_OK.'</p>';
 }
 else
 {
  echo '<p class="error">'.KLN_DEL_NO.'</p>';
 }
 $_SESSION['kie_operation'] = '';
}
else
{
 echo '<p class="error">'.str_replace('%numsite%', $_SESSION['kie_id'], str_replace('%namesite%', $kietu['liste_sites'][$_SESSION['kie_id']][0], KLN_DEL_ATT)).'</p>';
 echo '<form method="post" action="?kie_action=delete&amp;kie_operation=delete">';
 echo '<button type="submit">'.KLN_DEL_BTN.'</button>';
 echo ' <button type="">'.KLN_DEL_UND.'</button>';
 echo '</form>';
}
?>
