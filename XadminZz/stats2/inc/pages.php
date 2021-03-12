<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu;

$table = new ktable(KLN_PAG_NAM, KLN_PAGES.kie_img_percent(0,0,0,2,true), KLN_PCENT);
$table->set_class('center', 'center', 'justify');
$table->set_tri(TRUE, TRUE, FALSE);
$table->set_name('pages');

$connexion = new ksqllayer ($kietu['mysql_host'], $kietu['mysql_user'], $kietu['mysql_pass'], $kietu['mysql_database']);
$connexion->query('SELECT page, SUM(nb) AS total FROM '.$kietu['mysql_prefixe'].'pages '.$kietu['filtre'].' GROUP BY page ORDER BY total DESC');

$kie['pagestotal'] = 0;
$kie['pagesrecord'] = 0;

while ($data = $connexion->fetch_array())
{
 $kie['pagestotal'] += $data['total'];
 $kie['temp'][] = array($data['page'], $data['total']);
 if ($kie['pagesrecord'] < $data['total']) $kie['pagesrecord'] = $data['total'];
}

if (!empty($kie['temp']))
{
 foreach ($kie['temp'] as $key => $value)
 {
  $table->add_line('<a href="?kie_action=pages&amp;kie_operation='.$value[0].'">'.$value[0].'</a>', $value[1], kie_img_percent($value[1], $kie['pagestotal'], $kie['pagesrecord'], 2));
 }
}

if (!empty($_GET['kie_operation']))
{
 $table2 = new ktable(KLN_DATE, KLN_PAGES.kie_img_percent(0,0,0,1,true), KLN_PCENT);
 $table2->set_class('center', 'center', 'justify');
 $table2->set_tri(TRUE, TRUE, FALSE);
 $table2->set_name('pagedetail');

 $connexion->query('SELECT DATE_FORMAT(date, \''.KLN_AFF_DAT.'\') AS date2, SUM(nb) AS total FROM '.$kietu['mysql_prefixe'].'pages '.$kietu['filtre'].'AND page = \''.$_SESSION['kie_operation'].'\' GROUP BY date ORDER BY date DESC');
 $connexion->close();

 $kie['pagestotal'] = 0;
 $kie['pagesrecord'] = 0;

 while ($data = $connexion->fetch_array())
 {
  $kie['pagestotal'] += $data['total'];
  $kie['temp2'][] = array($data['date2'], $data['total']);
  if ($kie['pagesrecord'] < $data['total']) $kie['pagesrecord'] = $data['total'];
 }

 if (!empty($kie['temp2']))
 {
  foreach ($kie['temp2'] as $key => $value)
  {
   $table2->add_line($value[0], $value[1], kie_img_percent($value[1], $kie['pagestotal'], $kie['pagesrecord'], 1));
  }
 }
}

echo '<h1>'.KLN_PAG_TIT.'</h1>';
echo '<p>'.KLN_PAG_INF.'</p>';
echo $table->show();

if (!empty($_GET['kie_operation']))
{
 echo '<h1>'.KLN_PAG_DET.' « '.$_SESSION['kie_operation'].' »</h1>';
 echo $table2->show();
}
?>

