<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu;

$table = new ktable(KLN_NAV, KLN_NAV, KLN_VISIT.kie_img_percent(0,0,0,1,true), KLN_PAGES.kie_img_percent(0,0,0,2,true), KLN_PCENT);
$table->set_class('center', 'center', 'center', 'center', 'justify');
$table->merge_title(2, 0, 1, 1, 1);
$table->set_tri(FALSE, TRUE, TRUE, TRUE, FALSE);
$table->set_name('browser');

$connexion = new ksqllayer ($kietu['mysql_host'], $kietu['mysql_user'], $kietu['mysql_pass'], $kietu['mysql_database']);
$connexion->query('SELECT nav, nav_ver, SUM(nb_vis) AS vis, SUM(nb_pag) AS pag FROM '.$kietu['mysql_prefixe'].'visit '.$kietu['filtre'].' GROUP BY CONCAT(nav, nav_ver) ORDER BY vis DESC');
$connexion->close();

$kie['gueststotal']  = 0;
$kie['pagestotal']   = 0;
$kie['guestsrecord'] = 0;
$kie['pagesrecord']  = 0;
while ($data = $connexion->fetch_array())
{
 $kie['gueststotal'] += $data['vis'];
 $kie['pagestotal']  += $data['pag'];
 $kie['temp'][] = array($data['vis'], $data['pag'], $data['nav'], $data['nav_ver']);
 if ($kie['guestsrecord'] < $data['vis']) $kie['guestsrecord'] = $data['vis'];
 if ($kie['pagesrecord']  < $data['pag']) $kie['pagesrecord'] = $data['pag'];
}

if (!empty($kie['temp']))
{
 foreach ($kie['temp'] as $key => $value)
 {
  $table->add_line(kie_image('nav', $value[2], 'png'), $kietu['KLN']['nav'][$value[2]].' '.(($value[3] <> '0.0') ? $value[3] : ''), $value[0], $value[1], kie_img_percent($value[0], $kie['gueststotal'], $kie['guestsrecord'], 1) . '<br />' . kie_img_percent($value[1], $kie['pagestotal'], $kie['pagesrecord'], 2));
 }
}

echo '<h1>'.KLN_NAV_TIT.'</h1>';
echo '<p>'.KLN_NAV_INF.'</p>';
echo $table->show();
?>
