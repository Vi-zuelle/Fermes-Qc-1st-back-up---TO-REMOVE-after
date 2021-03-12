<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu;

$table = new ktable(KLN_ENG_NAM, KLN_VISIT.kie_img_percent(0,0,0,1,true), KLN_PCENT);
$table->set_class('center', 'center', 'justify');
$table->set_tri(TRUE, TRUE, FALSE);
$table->set_name('engines');

$connexion = new ksqllayer ($kietu['mysql_host'], $kietu['mysql_user'], $kietu['mysql_pass'], $kietu['mysql_database']);
$connexion->query('SELECT engine, SUM(nb) AS total FROM '.$kietu['mysql_prefixe'].'keywords '.$kietu['filtre'].' GROUP BY engine ORDER BY total DESC');

$kie['enginetotal'] = 0;
$kie['enginerecord'] = 0;

while ($data = $connexion->fetch_array())
{
 $kie['enginetotal'] += $data['total'];
 $kie['temp'][] = array($data['engine'], $data['total']);
 if ($kie['enginerecord'] < $data['total']) $kie['enginerecord'] = $data['total'];
}

if (!empty($kie['temp']))
{
 foreach ($kie['temp'] as $key => $value)
 {
  $table->add_line('<a href="?kie_action=engines&amp;kie_operation='.$value[0].'">'.$value[0].'</a>', $value[1], kie_img_percent($value[1], $kie['enginetotal'], $kie['enginerecord'], 1));
 }
}

if (!empty($_GET['kie_operation']))
{
 $table2 = new ktable(KLN_DATE, KLN_VISIT.kie_img_percent(0,0,0,2,true), KLN_PCENT);
 $table2->set_class('center', 'center', 'justify');
 $table2->set_tri(TRUE, TRUE, FALSE);
 $table2->set_name('enginedetail');

 $connexion->query('SELECT DATE_FORMAT(date, \''.KLN_AFF_DAT.'\') AS date2, SUM(nb) AS total FROM '.$kietu['mysql_prefixe'].'keywords '.$kietu['filtre'].'AND engine = \''.$_SESSION['kie_operation'].'\' GROUP BY date ORDER BY date DESC');
 $connexion->close();

 $kie['enginetotal'] = 0;
 $kie['enginerecord'] = 0;

 while ($data = $connexion->fetch_array())
 {
  $kie['enginetotal'] += $data['total'];
  $kie['temp2'][] = array($data['date2'], $data['total']);
  if ($kie['enginerecord'] < $data['total']) $kie['enginerecord'] = $data['total'];
 }

 if (!empty($kie['temp2']))
 {
  foreach ($kie['temp2'] as $key => $value)
  {
   $table2->add_line($value[0], $value[1], kie_img_percent($value[1], $kie['enginetotal'], $kie['enginerecord'], 2));
  }
 }
}

echo '<h1>'.KLN_ENG_TIT.'</h1>';
echo '<p>'.KLN_ENG_INF.'</p>';
echo $table->show();

if (!empty($_GET['kie_operation']))
{
 echo '<h1>'.KLN_ENG_DET.' « '.$_SESSION['kie_operation'].' »</h1>';
 echo $table2->show();
}
?>

