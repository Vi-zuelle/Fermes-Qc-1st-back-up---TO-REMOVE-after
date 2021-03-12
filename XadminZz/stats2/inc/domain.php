<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu;
include 'define/countries.php';
include 'class/kmaps.class.php';

$table = new ktable(KLN_DOM_FLA, KLN_DOM_SUF, KLN_DOM_COU, KLN_NUMBER.kie_img_percent(0, 0, 0, 1, true), KLN_PCENT);
$table->set_class('center', 'center', 'center', 'center', 'justify');
$table->set_tri(FALSE, TRUE, TRUE, TRUE, FALSE);
$table->set_name('domain');

if (in_array($_SESSION['kie_operation'], array('afr', 'ame', 'asi', 'eur', 'oce')))
{
 $image = new kmaps('media/maps/'.$_SESSION['kie_operation'].'.png', 'media/maps/'.$_SESSION['kie_operation'].'.temp.png');
 $image->modify_a('?kie_action=domain&amp;kie_operation=world');
}
else
{
 $image = new kmaps('media/maps/world.png', 'media/maps/world.temp.png');
}

$connexion = new ksqllayer ($kietu['mysql_host'], $kietu['mysql_user'], $kietu['mysql_pass'], $kietu['mysql_database']);
$connexion->query('SELECT domain, SUM(nb) AS total FROM '.$kietu['mysql_prefixe'].'domai '.$kietu['filtre'].' GROUP BY domain ORDER BY total DESC');
$connexion->close();

$kie['max'] = 0;
$kie['tot'] = 0;
$kie['maxcontinent'] = array('afr'=>0, 'unk'=>0, 'ame'=>0, 'asi'=>0, 'eur'=>0, 'oce'=>0);
// Filling in arrays with datas
while ($data = $connexion->fetch_array())
{
 // Defining total
 $kie['tot'] += $data['total'];
 // Defining maximum for plotting
 if ($kie['max'] < $data['total']) { $kie['max'] = $data['total']; }
 // Defining maximum for each continent
 if (isset($kietu['arraycountries'][$data['domain']]) && $kie['maxcontinent'][$kietu['arraycountries'][$data['domain']][0]] < $data['total']) { $kie['maxcontinent'][$kietu['arraycountries'][$data['domain']][0]] = $data['total']; }
 // Setting the number for the country
 $kie['temp'][$data['domain']] = $data['total'];
 // Sum for each continent
 if (isset($kietu['arraycountries'][$data['domain']]))
 {
  if (isset($kie['sumcontinent'][$kietu['arraycountries'][$data['domain']][0]]))
  {
   $kie['sumcontinent'][$kietu['arraycountries'][$data['domain']][0]] += $data['total'];
  }
  else
  {
   $kie['sumcontinent'][$kietu['arraycountries'][$data['domain']][0]] = $data['total'];
  }
 }
}

// Filling in the tab and coloring maps
if (!empty($kie['temp']))
{
 foreach ($kie['temp'] as $key => $value)
 {
  if (isset($kietu['KLN']['countries'][$key]))
  {
   $output = $kietu['KLN']['countries'][$key];
  }
  else
  {
   $output = '-';
  }
  if (isset($kietu['arraycountries'][$key]) && $_SESSION['kie_operation'] == $kietu['arraycountries'][$key][0])
  {
   $image->colorfromarray($kietu['arraycountries'][$key][1], $value * 100 / $kie['sumcontinent'][$_SESSION['kie_operation']], $key);
   $table->add_line(kie_image('flags', $key, 'png'), $key, $output, $value, kie_img_percent($value, $kie['sumcontinent'][$kietu['arraycountries'][$key][0]], $kie['maxcontinent'][$kietu['arraycountries'][$key][0]], 1));
  }
  else if (empty($_SESSION['kie_operation']) || $_SESSION['kie_operation'] == 'world')
  {
   $table->add_line(kie_image('flags', $key, 'png'), $key, $output, $value, kie_img_percent($value, $kie['tot'], $kie['max'], 1));
  }
 }
}

if (!in_array($_SESSION['kie_operation'], array('afr', 'ame', 'asi', 'eur', 'oce')) && !empty($kie['sumcontinent']))
{
 foreach ($kie['sumcontinent'] as $key => $value)
 {
  if ($key <> 'unk')
  {
   $image->colorfromarray($kietu['arraycontinent'][$key], 100 * $value / $kie['tot']);
   $image->add_area('poly', $kietu['arraycontinentarea'][$key], '?kie_action=domain&amp;kie_operation='.$key, $kietu['KLN']['continent'][$key]);
  }
 }
}

echo '<h1>'.KLN_DOM_TIT.'</h1>';
echo '<p>'.KLN_DOM_INF.'</p>';
echo $image->show_html();
echo $table->show();
?>
