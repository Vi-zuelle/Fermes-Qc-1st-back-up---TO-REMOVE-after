<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu;

$table = new ktable(KLN_NUMMER, KLN_MOIS, KLN_VISIT.kie_img_percent(0,0,0,1,true), KLN_PAGES.kie_img_percent(0,0,0,2,true), KLN_PCENT);
$table->set_class('center', 'center', 'center', 'center', 'justify');
$table->set_tri(TRUE, FALSE, TRUE, TRUE, FALSE);
$table->set_name('monthly');

$connexion = new ksqllayer ($kietu['mysql_host'], $kietu['mysql_user'], $kietu['mysql_pass'], $kietu['mysql_database']);
$connexion->query('SELECT DATE_FORMAT(date, \'%c\') AS moi, SUM(nb_vis) AS vis, SUM(nb_pag) AS pag FROM '.$kietu['mysql_prefixe'].'heure '.$kietu['filtre'].' GROUP BY moi');
$connexion->close();

$kie['gueststotal']  = 0;
$kie['pagestotal']   = 0;
$kie['guestsrecord'] = 0;
$kie['pagesrecord']  = 0;
while ($data = $connexion->fetch_array())
{
 $kie['gueststotal'] += $data['vis'];
 $kie['pagestotal'] += $data['pag'];
 $kie['temp'][$data['moi']] = array($data['vis'], $data['pag']);
 if ($kie['guestsrecord'] < $data['vis']) $kie['guestsrecord'] = $data['vis'];
 if ($kie['pagesrecord'] < $data['pag']) $kie['pagesrecord'] = $data['pag'];
}

for ($i = 1; $i <= 12; $i++)
{
 if (strlen($i) < 2) {$j = '0'.$i;} else {$j = $i;}
 if (!empty($kie['temp'][$i]))
 {
  $table->add_line($j, $kietu['KLN']['mois'][$i-1], $kie['temp'][$i][0], $kie['temp'][$i][1], kie_img_percent($kie['temp'][$i][0], $kie['gueststotal'], $kie['guestsrecord'], 1) . '<br />' . kie_img_percent($kie['temp'][$i][1], $kie['pagestotal'], $kie['pagesrecord'], 2));
 }
 else
 {
  $table->add_line($j, $kietu['KLN']['mois'][$i-1], '-', '-', kie_img_percent(0, $kie['gueststotal'], $kie['guestsrecord'], 1) . '<br />' . kie_img_percent(0, $kie['pagestotal'], $kie['pagesrecord'], 2));
 }
}

echo '<h1>'.KLN_MOI_TIT.'</h1>';
echo '<p>'.KLN_MOI_INF.'</p>';
echo $table->show();
?>
