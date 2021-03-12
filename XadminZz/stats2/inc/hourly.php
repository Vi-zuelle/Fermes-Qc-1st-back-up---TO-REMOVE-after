<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu;

$table = new ktable(KLN_HEURE, KLN_VISIT.kie_img_percent(0,0,0,1,true), KLN_PAGES.kie_img_percent(0,0,0,2,true), KLN_PCENT);
$table->set_class('center', 'center', 'center', 'justify');
$table->set_tri(TRUE, TRUE, TRUE, FALSE);
$table->set_name('hourly');

$connexion = new ksqllayer ($kietu['mysql_host'], $kietu['mysql_user'], $kietu['mysql_pass'], $kietu['mysql_database']);
$connexion->query('SELECT heure, SUM(nb_vis) AS vis, SUM(nb_pag) AS pag FROM '.$kietu['mysql_prefixe'].'heure '.$kietu['filtre'].' GROUP BY heure');
$connexion->close();

$kie['gueststotal']  = 0;
$kie['pagestotal']   = 0;
$kie['guestsrecord'] = 0;
$kie['pagesrecord']  = 0;
while ($data = $connexion->fetch_array())
{
 $kie['temp'][$data['heure']] = array($data['vis'], $data['pag']);
 $kie['gueststotal'] += $data['vis'];
 $kie['pagestotal']  += $data['pag'];
 if ($data['vis'] > $kie['guestsrecord']) $kie['guestsrecord'] = $data['vis'];
 if ($data['pag'] > $kie['pagesrecord'])  $kie['pagesrecord']  = $data['pag'];
}

for ($i = 0; $i < 24; $i++)
{
 if (strlen($i)   < 2) {$j = '0'.$i;}     else {$j = $i;}
 if (strlen($i+1) < 2) {$k = '0'.($i+1);} else {$k = $i+1;}
 if (!empty($kie['temp'][$i]))
 {
  $table->add_line($j.' - '.($k), $kie['temp'][$i][0], $kie['temp'][$i][1], kie_img_percent($kie['temp'][$i][0], $kie['gueststotal'], $kie['guestsrecord'], 1) . '<br />' . kie_img_percent($kie['temp'][$i][1], $kie['pagestotal'], $kie['pagesrecord'], 2));
 }
 else
 {
  $table->add_line($j.' - '.($k), '-', '-', kie_img_percent(0, $kie['gueststotal'], $kie['guestsrecord'], 1) . '<br />' . kie_img_percent(0, $kie['pagestotal'], $kie['pagesrecord'], 2));
 }
}

echo '<h1>'.KLN_HEU_TIT.'</h1>';
echo '<p>'.KLN_HEU_INF.'</p>';
echo $table->show();
?>
