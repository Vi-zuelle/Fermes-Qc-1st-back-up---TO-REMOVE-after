<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu;

$table = new ktable(KLN_LAS_TSP, KLN_LAS_IP, KLN_LAS_UAG);
$table->set_class('center', 'center','center');
$table->set_tri(FALSE, FALSE, FALSE);
$table->set_name('lastguests');

$connexion = new ksqllayer ($kietu['mysql_host'], $kietu['mysql_user'], $kietu['mysql_pass'], $kietu['mysql_database']);
$connexion->query('SELECT ip, user_agent, timestamp FROM '.$kietu['mysql_prefixe'].'recent '.$kietu['filtre_site']);
$connexion->close();

while ($data = $connexion->fetch_array())
{
 $table->add_line($data['timestamp'], $data['ip'], $data['user_agent']);
}

echo '<h1>'.KLN_LAS_TIT.'</h1>';
echo '<p>'.KLN_LAS_INF.'</p>';
echo $table->show();
?>
