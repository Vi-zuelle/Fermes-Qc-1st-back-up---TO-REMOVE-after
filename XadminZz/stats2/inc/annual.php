<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu, $kie;

if (date('m') == 12)
{
 $kie['startyear']  = date('Y');
 $kie['startmonth'] = 1;
}
else
{
 $kie['startyear']  = date('Y')-1;
 $kie['startmonth'] = date('m')+1;
}

for ($j = 0; $j < 12; $j++)
{
 $kie['currentmonth'] = $kie['startmonth'] + $j;
 if ($kie['currentmonth'] > 12)
 {
  $kie['currentmonth'] -= 12;
  $kie['currentyear']   = $kie['startyear'] + 1;
 }
 else
 {
  $kie['currentyear'] = $kie['startyear'];
 }
 $kie['title'][$j] = substr($kietu['KLN']['mois'][$kie['currentmonth'] - 1], 0, 3).' '.substr($kie['currentyear'], -2);
}

if (strlen($kie['startmonth']) < 2) {$kie['startmonth'] = '0'.$kie['startmonth'];}

$table = new ktable(KLN_JOURS, $kie['title'][0], $kie['title'][1], $kie['title'][2], $kie['title'][3], $kie['title'][4], $kie['title'][5], $kie['title'][6], $kie['title'][7], $kie['title'][8], $kie['title'][9], $kie['title'][10], $kie['title'][11]);
$table->set_name('annualvis');
$table->set_table_class('fixed');
$table2 = new ktable(KLN_JOURS, $kie['title'][0], $kie['title'][1], $kie['title'][2], $kie['title'][3], $kie['title'][4], $kie['title'][5], $kie['title'][6], $kie['title'][7], $kie['title'][8], $kie['title'][9], $kie['title'][10], $kie['title'][11]);
$table2->set_name('annualpag');
$table2->set_table_class('fixed');

$connexion = new ksqllayer ($kietu['mysql_host'], $kietu['mysql_user'], $kietu['mysql_pass'], $kietu['mysql_database']);
$connexion->query('SELECT DATE_FORMAT(date, \'%d%m%Y\') AS jjmmyyyy, SUM(nb_vis) AS vis, SUM(nb_pag) AS pag FROM '.$kietu['mysql_prefixe'].'heure '.$kietu['filtre_site'].'AND date >= \''.$kie['startyear'].$kie['startmonth'].'01\' GROUP BY jjmmyyyy');
$connexion->close();

$kie['gueststotal']  = 0;
$kie['pagestotal']   = 0;
$kie['guestsrecord'] = 0;
$kie['pagesrecord']  = 0;
while ($data = $connexion->fetch_array())
{
 $kie['gueststotal'] += $data['vis'];
 $kie['pagestotal'] += $data['pag'];
 $kie['temp'][$data['jjmmyyyy']] = array($data['vis'], $data['pag']);
 if ($kie['guestsrecord'] < $data['vis']) $kie['guestsrecord'] = $data['vis'];
 if ($kie['pagesrecord'] < $data['pag'])  $kie['pagesrecord'] = $data['pag'];
}

for ($j = 0; $j < 12; $j++)
{
 $kie['currentmonth'] = $kie['startmonth'] + $j;
 if ($kie['currentmonth'] > 12)
 {
  $kie['currentmonth'] -= 12;
  $kie['currentyear']   = $kie['startyear'] + 1;
 }
 else
 {
  $kie['currentyear'] = $kie['startyear'];
 }
 if (strlen($kie['currentmonth']) < 2) {$kie['currentmonth'] = '0'.$kie['currentmonth'];}
 for ($i = 1; $i <= 31; $i++)
 {
  if (strlen($i) < 2) {$i = '0'.$i;}
  if (checkdate($kie['currentmonth'], $i, $kie['currentyear']))
  {
   if (isset($kie['temp'][$i.$kie['currentmonth'].$kie['currentyear']]))
   {
    $kie['temp2'][$j][$i] = $kie['temp'][$i.$kie['currentmonth'].$kie['currentyear']];
   }
   else
   {
    $kie['temp2'][$j][$i] = array('-', '-');
   }
  }
  else
  {
   $kie['temp2'][$j][$i] = array('&nbsp;', '&nbsp;');
  }
 }
}

for ($i = 1; $i <= 31; $i++)
{
 if (strlen($i) < 2) {$i = '0'.$i;}
 $table->add_line($i, kie_annual_value($i, 0, 0), kie_annual_value($i, 1, 0), kie_annual_value($i, 2, 0), kie_annual_value($i, 3, 0), kie_annual_value($i, 4, 0), kie_annual_value($i, 5, 0), kie_annual_value($i, 6, 0), kie_annual_value($i, 7, 0), kie_annual_value($i, 8, 0), kie_annual_value($i, 9, 0), kie_annual_value($i, 10, 0), kie_annual_value($i, 11, 0));
 $table2->add_line($i, kie_annual_value($i, 0, 1), kie_annual_value($i, 1, 1), kie_annual_value($i, 2, 1), kie_annual_value($i, 3, 1), kie_annual_value($i, 4, 1), kie_annual_value($i, 5, 1), kie_annual_value($i, 6, 1), kie_annual_value($i, 7, 1), kie_annual_value($i, 8, 1), kie_annual_value($i, 9, 1), kie_annual_value($i, 10, 1), kie_annual_value($i, 11, 1));
}

echo '<h1>'.KLN_ANN_TIT.'</h1>';
echo '<p>'.KLN_ANN_VIS.'</p>';
echo $table->show();
echo '<p>'.KLN_ANN_PAG.'</p>';
echo $table2->show();
?>
