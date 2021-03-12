<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu;

$table = new ktable(KLN_REF_SIT, KLN_REF_VIS.kie_img_percent(0,0,0,2,true), KLN_PCENT);
$table->set_class('center', 'center', 'justify');
$table->set_tri(TRUE, TRUE, FALSE);
$table->set_name('refer');

$connexion = new ksqllayer ($kietu['mysql_host'], $kietu['mysql_user'], $kietu['mysql_pass'], $kietu['mysql_database']);
$connexion->query('SELECT refer, SUM(nb) AS total FROM '.$kietu['mysql_prefixe'].'refer '.$kietu['filtre'].' AND refer <> \'ignored\' GROUP BY refer ORDER BY total DESC');

$kie['gueststotal']  = 0;
$kie['guestsrecord'] = 0;

while ($data = $connexion->fetch_array())
{
 $kie['gueststotal'] += $data['total'];
 $kie['temp'][] = array($data['refer'], $data['total']);
 if ($kie['guestsrecord'] < $data['total']) $kie['guestsrecord'] = $data['total'];
}

if (!empty($kie['temp']))
{
 foreach ($kie['temp'] as $key => $value)
 {
  $table->add_line('<a href="?kie_action=referents&amp;kie_operation='.$value[0].'">'.$value[0].'</a>', $value[1], kie_img_percent($value[1], $kie['gueststotal'], $kie['guestsrecord'], 2));
 }
}

if (!empty($_GET['kie_operation']))
{
 $table2 = new ktable(KLN_DATE, KLN_REF_VIS.kie_img_percent(0,0,0,1,true), KLN_PCENT);
 $table2->set_class('center', 'center', 'justify');
 $table2->set_tri(TRUE, TRUE, FALSE);
 $table2->set_name('referdetail');

 $connexion->query('SELECT DATE_FORMAT(date, \''.KLN_AFF_DAT.'\') AS date2, SUM(nb) AS total FROM '.$kietu['mysql_prefixe'].'refer '.$kietu['filtre'].'AND refer = \''.$_SESSION['kie_operation'].'\' GROUP BY date ORDER BY date DESC');
 $connexion->close();

 $kie['gueststotal'] = 0;
 $kie['guestsrecord'] = 0;

 while ($data = $connexion->fetch_array())
 {
  $kie['gueststotal'] += $data['total'];
  $kie['temp2'][] = array($data['date2'], $data['total']);
  if ($kie['guestsrecord'] < $data['total']) $kie['guestsrecord'] = $data['total'];
 }

 if (!empty($kie['temp2']))
 {
  foreach ($kie['temp2'] as $key => $value)
  {
   $table2->add_line($value[0], $value[1], kie_img_percent($value[1], $kie['gueststotal'], $kie['guestsrecord'], 1));
  }
 }
}

echo '<h1>'.KLN_REF_TIT.'</h1>';
echo '<p>'.KLN_REF_INF.'</p>';
echo $table->show();

if (!empty($_GET['kie_operation']))
{
 echo '<h1>'.KLN_REF_DET.'</h1> <i><b>« '.$_SESSION['kie_operation'].' »</b></i>';
 echo $table2->show();
}
?>

