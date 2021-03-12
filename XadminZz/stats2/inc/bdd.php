<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

include_once 'inc/functions.php';

global $kietu;

$table = new ktable(KLN_TABLE, KLN_RECORDS, KLN_INDEX, KLN_DATAS, KLN_TOTAL);
$table->set_name('bdd');

$connexion = new ksqllayer ($kietu['mysql_host'], $kietu['mysql_user'], $kietu['mysql_pass'], $kietu['mysql_database']);
$connexion->query('SHOW TABLE STATUS LIKE \''.$kietu['mysql_prefixe'].'%\'');
$kie['liste_tables'] = array($kietu['mysql_prefixe'].'domai', $kietu['mysql_prefixe'].'heure', $kietu['mysql_prefixe'].'pages', $kietu['mysql_prefixe'].'recent', $kietu['mysql_prefixe'].'refer', $kietu['mysql_prefixe'].'visit', $kietu['mysql_prefixe'].'keywords');
$kie['totalsize'] = 0;
while ($data=$connexion->fetch_array())
{
 if (in_array($data['Name'], $kie['liste_tables']))
 { 
 $kie['totalsize'] += $data['Index_length']+$data['Data_length'];
 $table->add_line($data['Name'], $data['Rows'], PMA_formatByteDown($data['Index_length']), PMA_formatByteDown($data['Data_length']), PMA_formatByteDown($data['Index_length']+$data['Data_length']));
 }
}

$table->add_line(KLN_TOTAL, '', '', '', PMA_formatByteDown($kie['totalsize']));
$table->merge_line(4, 0, 0, 0, 1);

if ($_SESSION['kie_operation']=='optimize')
{
 foreach ($kie['liste_tables'] as $value)
 {
  $connexion->query('OPTIMIZE TABLE '.$value);
 }
 $_SESSION['kie_operation'] = '';
 echo '<p class="success">'.KLN_BDD_OK.'</p>';
}

$connexion->close();

echo '<h1>'.KLN_BDD_TIT.'</h1>';
echo '<p>'.KLN_BDD_INF.'</p>';
echo $table->show();
echo '<h1>'.KLN_BDD_TI2.'</h1>';
echo '<p>'.KLN_BDD_IN2.'</p>';
echo '<form method="post" action="?kie_action=bdd&amp;kie_operation=optimize">';
echo '<button type="submit">'.KLN_BDD_OPT.'</button>';
echo '</form>';
?>
