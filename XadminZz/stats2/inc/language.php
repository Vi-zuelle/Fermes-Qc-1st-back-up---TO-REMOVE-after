<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu;

$table = new ktable(KLN_DOM_FLA, KLN_DOM_LNG, KLN_NUMBER.kie_img_percent(0, 0, 0, 2, true), KLN_PCENT);
$table->set_class('center', 'center', 'center', 'justify');
$table->set_tri(FALSE, TRUE, TRUE, FALSE);
$table->set_name('lang');

$connexion = new ksqllayer ($kietu['mysql_host'], $kietu['mysql_user'], $kietu['mysql_pass'], $kietu['mysql_database']);
$connexion->query('SELECT lang, SUM(nb) AS total FROM '.$kietu['mysql_prefixe'].'domai '.$kietu['filtre'].' GROUP BY lang ORDER BY total DESC');
$connexion->close();

$kie['max'] = 0;
$kie['tot'] = 0;
while ($data = $connexion->fetch_array())
{
 $kie['tot'] += $data['total'];
 if ($kie['max'] < $data['total']) $kie['max'] = $data['total'];
 $kie['temp'][$data['lang']] = $data['total'];
}

if (!empty($kie['temp']))
{
 foreach ($kie['temp'] as $key => $value)
 {
  $table->add_line(kie_image('flags', $key, 'png'), $key, $value, kie_img_percent($value, $kie['tot'], $kie['max'], 2));
 }
}

echo '<h1>'.KLN_LNG_TIT.'</h1>';
echo '<p>'.KLN_LNG_INF.'</p>';
echo $table->show();
?>
