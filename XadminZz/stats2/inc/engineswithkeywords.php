<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu;

$table = new ktable(KLN_ENG_NAM, KLN_KEY_NAM, KLN_VISIT.kie_img_percent(0,0,0,1,true), KLN_PCENT);
$table->set_class('center', 'center', 'center', 'justify');
$table->set_tri(TRUE, TRUE, TRUE, FALSE);
$table->set_name('engineswithkeywords');

$connexion = new ksqllayer ($kietu['mysql_host'], $kietu['mysql_user'], $kietu['mysql_pass'], $kietu['mysql_database']);
$connexion->query('SELECT engine, keywords, SUM(nb) AS total FROM '.$kietu['mysql_prefixe'].'keywords '.$kietu['filtre'].' GROUP BY engine, keywords ORDER BY total DESC');

$kie['enginetotal'] = 0;
$kie['enginerecord'] = 0;

while ($data = $connexion->fetch_array())
{
 $kie['enginetotal'] += $data['total'];
 $kie['temp'][] = array($data['engine'], $data['keywords'], $data['total']);
 if ($kie['enginerecord'] < $data['total']) $kie['enginerecord'] = $data['total'];
}

if (!empty($kie['temp']))
{
 foreach ($kie['temp'] as $key => $value)
 {
  $table->add_line('<a href="?kie_action=engines&amp;kie_operation='.$value[0].'">'.$value[0].'</a>', '<a href="?kie_action=keywords&amp;kie_operation='.$value[1].'">'.$value[1].'</a>', $value[2], kie_img_percent($value[2], $kie['enginetotal'], $kie['enginerecord'], 1));
 }
}

echo '<h1>'.KLN_ENK_TIT.'</h1>';
echo '<p>'.KLN_ENK_INF.'</p>';
echo $table->show();
?>

