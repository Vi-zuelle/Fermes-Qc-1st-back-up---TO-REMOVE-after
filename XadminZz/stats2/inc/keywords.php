<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu;

$table = new ktable(KLN_KEY_NAM, KLN_VISIT.kie_img_percent(0,0,0,1,true), KLN_PCENT);
$table->set_class('center', 'center', 'justify');
$table->set_tri(TRUE, TRUE, FALSE);
$table->set_name('keywords');

$connexion = new ksqllayer ($kietu['mysql_host'], $kietu['mysql_user'], $kietu['mysql_pass'], $kietu['mysql_database']);
$connexion->query('SELECT keywords, SUM(nb) AS total FROM '.$kietu['mysql_prefixe'].'keywords '.$kietu['filtre'].' GROUP BY keywords ORDER BY total DESC');

$kie['keywordstotal'] = 0;
$kie['keywordsrecord'] = 0;

while ($data = $connexion->fetch_array())
{
 $kie['keywordstotal'] += $data['total'];
 $kie['temp'][] = array($data['keywords'], $data['total']);
 if ($kie['keywordsrecord'] < $data['total']) $kie['keywordsrecord'] = $data['total'];
}

if (!empty($kie['temp']))
{
 foreach ($kie['temp'] as $key => $value)
 {
  $table->add_line('<a href="?kie_action=keywords&amp;kie_operation='.$value[0].'">'.$value[0].'</a>', $value[1], kie_img_percent($value[1], $kie['keywordstotal'], $kie['keywordsrecord'], 1));
 }
}

if (!empty($_GET['kie_operation']))
{
 $table2 = new ktable(KLN_DATE, KLN_VISIT.kie_img_percent(0,0,0,2,true), KLN_PCENT);
 $table2->set_class('center', 'center', 'justify');
 $table2->set_tri(TRUE, TRUE, FALSE);
 $table2->set_name('keywordsdetail');

 $connexion->query('SELECT DATE_FORMAT(date, \''.KLN_AFF_DAT.'\') AS date2, SUM(nb) AS total FROM '.$kietu['mysql_prefixe'].'keywords '.$kietu['filtre'].'AND keywords = \''.$_SESSION['kie_operation'].'\' GROUP BY date ORDER BY date DESC');
 $connexion->close();

 $kie['keywordstotal'] = 0;
 $kie['keywordsrecord'] = 0;

 while ($data = $connexion->fetch_array())
 {
  $kie['keywordstotal'] += $data['total'];
  $kie['temp2'][] = array($data['date2'], $data['total']);
  if ($kie['keywordsrecord'] < $data['total']) $kie['keywordsrecord'] = $data['total'];
 }

 if (!empty($kie['temp2']))
 {
  foreach ($kie['temp2'] as $key => $value)
  {
   $table2->add_line($value[0], $value[1], kie_img_percent($value[1], $kie['keywordstotal'], $kie['keywordsrecord'], 2));
  }
 }
}

echo '<h1>'.KLN_KEY_TIT.'</h1>';
echo '<p>'.KLN_KEY_INF.'</p>';
echo $table->show();

if (!empty($_GET['kie_operation']))
{
 echo '<h1>'.KLN_KEY_DET.' « '.$_SESSION['kie_operation'].' »</h1>';
 echo $table2->show();
}
?>

