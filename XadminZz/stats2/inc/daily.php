<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu;

$table = new ktable(KLN_NUMMER, KLN_JOURS, KLN_VISIT.kie_img_percent(0,0,0,1,true), KLN_PAGES.kie_img_percent(0,0,0,2,true), KLN_PCENT);
$table->set_class('center', 'center', 'center', 'center', 'justify');
$table->set_tri(TRUE, FALSE, TRUE, TRUE, FALSE);
$table->set_name('dailyofweek');

$connexion = new ksqllayer ($kietu['mysql_host'], $kietu['mysql_user'], $kietu['mysql_pass'], $kietu['mysql_database']);
$connexion->query('SELECT DATE_FORMAT(date, \'%w\') AS jou_sem, DATE_FORMAT(date, \'%e\') AS jou_moi, SUM(nb_vis) AS vis, SUM(nb_pag) AS pag FROM '.$kietu['mysql_prefixe'].'heure '.$kietu['filtre'].' GROUP BY jou_moi');
$connexion->close();

$kie['gueststotal']        = 0;
$kie['pagestotal']         = 0;
$kie['guestsrecordofday']  = 0;
$kie['pagesrecordofday']   = 0;
$kie['guestsrecordofweek'] = 0;
$kie['pagesrecordofweek']  = 0;
while ($data = $connexion->fetch_array())
{
 if ($data['jou_sem'] == 0) {$data['jou_sem'] = 7;}
 $kie['gueststotal'] += $data['vis'];
 $kie['pagestotal']  += $data['pag'];
 if (isset($kie['temp'][$data['jou_sem']]))
 {
  $kie['temp'][$data['jou_sem']] = array($data['vis'] + $kie['temp'][$data['jou_sem']][0], $data['pag'] + $kie['temp'][$data['jou_sem']][1]);
 }
 else
 {
  $kie['temp'][$data['jou_sem']] = array($data['vis'], $data['pag']);
 }
 if ($kie['guestsrecordofweek'] < $kie['temp'][$data['jou_sem']][0]) $kie['guestsrecordofweek'] = $kie['temp'][$data['jou_sem']][0];
 if ($kie['pagesrecordofweek']  < $kie['temp'][$data['jou_sem']][1]) $kie['pagesrecordofweek']  = $kie['temp'][$data['jou_sem']][1];
 $kie['temp2'][$data['jou_moi']] = array($data['vis'], $data['pag']);
 if ($kie['guestsrecordofday'] < $data['vis']) $kie['guestsrecordofday'] = $data['vis'];
 if ($kie['pagesrecordofday']  < $data['pag']) $kie['pagesrecordofday']  = $data['pag'];
}

for ($i = 1; $i < 8; $i++)
{
 if (!empty($kie['temp'][$i]))
 {
  $table->add_line($i, $kietu['KLN']['jour'][$i-1], $kie['temp'][$i][0], $kie['temp'][$i][1], kie_img_percent($kie['temp'][$i][0], $kie['gueststotal'], $kie['guestsrecordofweek'], 1) . '<br />' . kie_img_percent($kie['temp'][$i][1], $kie['pagestotal'], $kie['pagesrecordofweek'], 2));
 }
 else
 {
  $table->add_line($i, $kietu['KLN']['jour'][$i-1], '-', '-', kie_img_percent(0, $kie['gueststotal'], $kie['guestsrecordofweek'], 1) . '<br />' . kie_img_percent(0, $kie['pagestotal'], $kie['pagesrecordofweek'], 2));
 }
}

$table2 = new ktable(KLN_JOURS, KLN_VISIT.kie_img_percent(0,0,0,1,true), KLN_PAGES.kie_img_percent(0,0,0,2,true), KLN_PCENT);
$table2->set_class('center', 'center', 'center', 'justify');
$table2->set_tri(TRUE, TRUE, TRUE, FALSE);
$table2->set_name('dailyofmonth');

for ($i = 1; $i < 32; $i++)
{
 if (strlen($i) < 2) {$j = '0'.$i;} else {$j = $i;}
 if (!empty($kie['temp2'][$i]))
 {
  $table2->add_line($j, $kie['temp2'][$i][0], $kie['temp2'][$i][1], kie_img_percent($kie['temp2'][$i][0], $kie['gueststotal'], $kie['guestsrecordofweek'], 1) . '<br />' . kie_img_percent($kie['temp2'][$i][1], $kie['pagestotal'], $kie['pagesrecordofweek'], 2));
 }
 else
 {
  $table2->add_line($j, '-', '-', kie_img_percent(0, $kie['gueststotal'], $kie['guestsrecordofweek'], 1) . '<br />' . kie_img_percent(0, $kie['pagestotal'], $kie['pagesrecordofweek'], 2));
 }
}

echo '<h1>'.KLN_JOU_TIT.'</h1>';
echo '<p>'.KLN_JOU_IN1.'</p>';
echo $table->show();
echo '<h1>'.KLN_JOU_TIT.'</h1>';
echo '<p>'.KLN_JOU_IN2.'</p>';
echo $table2->show();
?>
