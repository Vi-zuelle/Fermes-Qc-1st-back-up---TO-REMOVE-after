<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu;

$table = new ktable(KLN_JOURS, KLN_VISIT, '', KLN_PAGES, '');
$table->set_class('center', 'center', 'center', 'center', 'center');
$table->set_tri(TRUE, TRUE, FALSE, TRUE, FALSE);
$table->set_name('last30');
$table->merge_title(1, 2, 0, 2, 0);

$connexion = new ksqllayer ($kietu['mysql_host'], $kietu['mysql_user'], $kietu['mysql_pass'], $kietu['mysql_database']);
$connexion->query('SELECT DATE_FORMAT(date, \''.KLN_AFF_DAT.'\') AS jou, SUM(nb_vis) AS vis, SUM(nb_pag) AS pag FROM '.$kietu['mysql_prefixe'].'heure '.$kietu['filtre_site'].' AND DATE_SUB(NOW(), INTERVAL 1 MONTH) < date GROUP BY jou');
$connexion->close();

$kie['gueststotal']  = 0;
$kie['pagestotal']   = 0;
$kie['guestsrecord'] = 0;
$kie['pagesrecord']  = 0;
while ($data = $connexion->fetch_array())
{
 $kie['gueststotal'] += $data['vis'];
 $kie['pagestotal'] += $data['pag'];
 $kie['temp'][$data['jou']] = array($data['vis'], $data['pag']);
 if ($kie['guestsrecord'] < $data['vis']) $kie['guestsrecord'] = $data['vis'];
 if ($kie['pagesrecord']  < $data['pag']) $kie['pagesrecord']  = $data['pag'];
}

for ($i = 31; $i > -1; $i--)
{
 
 $kie['daytowrite'] = date(strtr(KLN_AFF_DAT, array('%'=>'')), gmmktime(gmdate('H') - $kietu['conf_decal_horaire'], 0, 0, gmdate('n'), gmdate('d')-$i));
 if (!empty($kie['temp'][$kie['daytowrite']]))
 {
  $kie['evolution'][0] = ($kie['lastdatas'][0] == 0) ? '100' : round(($kie['temp'][$kie['daytowrite']][0]-$kie['lastdatas'][0])*100/($kie['lastdatas'][0]));
  $kie['evolution'][1] = ($kie['lastdatas'][1] == 0) ? '100' : round(($kie['temp'][$kie['daytowrite']][1]-$kie['lastdatas'][1])*100/($kie['lastdatas'][1]));
  if ($kie['evolution'][0] >= 0)
  {
   $kie['evolution'][0] = '<em class="green">+'.$kie['evolution'][0].' %</em>';
  }
  else
  {
   $kie['evolution'][0] = '<em class="red">'.$kie['evolution'][0].' %</em>';
  }
  if ($kie['evolution'][1] >= 0)
  {
   $kie['evolution'][1] = '<em class="green">+'.$kie['evolution'][1].' %</em>';
  }
  else
  {
   $kie['evolution'][1] = '<em class="red">'.$kie['evolution'][1].' %</em>';
  }
  $table->add_line($kie['daytowrite'], $kie['temp'][$kie['daytowrite']][0], $kie['evolution'][0], $kie['temp'][$kie['daytowrite']][1], $kie['evolution'][1]);
  $kie['lastdatas'] = array($kie['temp'][$kie['daytowrite']][0], $kie['temp'][$kie['daytowrite']][1]);
 }
 else
 {
  $table->add_line($kie['daytowrite'], '-', '-', '-', '-');
  $kie['lastdatas'] = array(0, 0);
 }
}

echo '<h1>'.KLN_30D_TIT.'</h1>';
echo '<p>'.KLN_30D_INF.'</p>';
echo $table->show();
?>
