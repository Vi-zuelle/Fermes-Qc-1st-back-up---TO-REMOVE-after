<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu;

$kie['today']           = date('Ymd', gmmktime(gmdate('H') - $kietu['conf_decal_horaire']));
$kie['yesterday']       = date('Ymd', gmmktime(gmdate('H') - $kietu['conf_decal_horaire'], 0, 0, gmdate('n'), gmdate('j')-1));
$kie['month']           = date('m', gmmktime(gmdate('H') - $kietu['conf_decal_horaire']));
$kie['year']            = date('Y', gmmktime(gmdate('H') - $kietu['conf_decal_horaire']));;
$kie['lastmonth']       = date('m', gmmktime(gmdate('H') - $kietu['conf_decal_horaire'], 0, 0, gmdate('n')-1));
$kie['yearoflastmonth'] = date('Y', gmmktime(gmdate('H') - $kietu['conf_decal_horaire'], 0, 0, gmdate('n')-1));;

// Global stats
$connexion = new ksqllayer ($kietu['mysql_host'], $kietu['mysql_user'], $kietu['mysql_pass'], $kietu['mysql_database']);
$connexion->query('SELECT DATE_FORMAT(MIN(date), \''.KLN_AFF_DAT.'\') AS deb, DATE_FORMAT(MAX(date), \''.KLN_AFF_DAT.'\') AS fin, SUM(nb_vis) AS vis, SUM(nb_pag) AS pag FROM '.$kietu['mysql_prefixe'].'heure '.$kietu['filtre_site']);
$data = $connexion->fetch_array();
$kie['startdate']   = is_null($data['deb']) ? '-' : $data['deb'];
$kie['enddate']     = is_null($data['fin']) ? '-' : $data['fin'];
$kie['pagestotal']  = is_null($data['pag']) ? '-' : $data['pag'];
$kie['gueststotal'] = is_null($data['vis']) ? '-' : $data['vis'];

// Stats of today
$connexion->query('SELECT SUM(nb_vis) AS vis, SUM(nb_pag) AS pag FROM '.$kietu['mysql_prefixe'].'heure '.$kietu['filtre_site'].' AND date = \''.$kie['today'].'\'');
$data = $connexion->fetch_array();
$kie['guestsoftoday'] = is_null($data['vis']) ? '-' : $data['vis'];
$kie['pagesoftoday']  = is_null($data['pag']) ? '-' : $data['pag'];

// Yesterday's stats
$connexion->query('SELECT SUM(nb_vis) AS vis, SUM(nb_pag) AS pag FROM '.$kietu['mysql_prefixe'].'heure '.$kietu['filtre_site'].' AND date = \''.$kie['yesterday'].'\'');
$data = $connexion->fetch_array();
$kie['guestsyesterday'] = is_null($data['vis']) ? '-' : $data['vis'];
$kie['pagesyesterday']  = is_null($data['pag']) ? '-' : $data['pag'];

// Stats of the month
$connexion->query('SELECT SUM(nb_vis) AS vis, SUM(nb_pag) AS pag FROM '.$kietu['mysql_prefixe'].'heure '.$kietu['filtre_site'].' AND MONTH(date) = \''.$kie['month'].'\' AND YEAR(date) = \''.$kie['year'].'\'');
$data = $connexion->fetch_array();
$kie['guestsmonth'] = is_null($data['vis']) ? '-' : $data['vis'];
$kie['pagesmonth']  = is_null($data['pag']) ? '-' : $data['pag'];

// Stats of last month
$connexion->query('SELECT SUM(nb_vis) AS vis, SUM(nb_pag) AS pag FROM '.$kietu['mysql_prefixe'].'heure '.$kietu['filtre_site'].' AND MONTH(date) = \''.$kie['lastmonth'].'\' AND YEAR(date) = \''.$kie['yearoflastmonth'].'\'');
$data = $connexion->fetch_array();
$kie['guestslastmonth'] = is_null($data['vis']) ? '-' : $data['vis'];
$kie['pageslastmonth']  = is_null($data['pag']) ? '-' : $data['pag'];

// Guests' record
$connexion->query('SELECT SUM(nb_vis) AS vis, DATE_FORMAT(date, \''.KLN_AFF_DAT.'\') AS dat FROM '.$kietu['mysql_prefixe'].'heure '.$kietu['filtre'].' GROUP BY date ORDER BY vis DESC LIMIT 1');
$data = $connexion->fetch_array();
$kie['guestsrecord'] = is_null($data['vis']) ? '-' : $data['vis'].KLN_LE.$data['dat'];

// record pages
$connexion->query('SELECT SUM(nb_pag) AS pag, DATE_FORMAT(date, \''.KLN_AFF_DAT.'\') AS dat FROM '.$kietu['mysql_prefixe'].'heure '.$kietu['filtre'].' GROUP BY date ORDER BY pag DESC LIMIT 1');
$data = $connexion->fetch_array();
$kie['pagesrecord'] = is_null($data['pag']) ? '-' : $data['pag'].KLN_LE.$data['dat'];

// Average
$connexion->query('SELECT SUM(nb_pag) AS pag, SUM(nb_vis) AS vis FROM '.$kietu['mysql_prefixe'].'heure '.$kietu['filtre'].' LIMIT 1');
$data = $connexion->fetch_array();
$kie['guestsofperiod']       = is_null($data['vis']) ? '-' : $data['vis'];
$kie['pagesofperiod']        = is_null($data['pag']) ? '-' : $data['pag'];
$kie['daysdifference']       = 1 + ( mktime(0, 0, 0, $_SESSION['kie_moi_fin'], $_SESSION['kie_jou_fin'], $_SESSION['kie_ann_fin']) - mktime(0, 0, 0, $_SESSION['kie_moi_deb'], $_SESSION['kie_jou_deb'], $_SESSION['kie_ann_deb']) )/ 86400; 
$kie['pagesperguestaverage'] = is_null($data['vis']) ? '-' : round($data['pag']/$data['vis'], 2);

$table = new ktable(KLN_DATA, KLN_NUMBER);
$table->set_class('justify', 'center');
$table->set_name('summary');

$table->add_line(KLN_DEB_DAT, $kie['startdate']);
$table->add_line(KLN_FIN_DAT, $kie['enddate']);
$table->add_line(KLN_TOT_PAG, $kie['pagestotal']);
$table->add_line(KLN_TOT_VIS, $kie['gueststotal']);
$table->add_line(KLN_PAG_AUJ, $kie['pagesoftoday']);
$table->add_line(KLN_VIS_AUJ, $kie['guestsoftoday']);
$table->add_line(KLN_PAG_HIE, $kie['pagesyesterday']);
$table->add_line(KLN_VIS_HIE, $kie['guestsyesterday']);
$table->add_line(KLN_PAG_MOI, $kie['pagesmonth']);
$table->add_line(KLN_VIS_MOI, $kie['guestsmonth']);
$table->add_line(KLN_PAG_MOD, $kie['pageslastmonth']);
$table->add_line(KLN_VIS_MOD, $kie['guestslastmonth']);
$table->add_line(KLN_PAG_PER, $kie['pagesofperiod']);
$table->add_line(KLN_VIS_PER, $kie['guestsofperiod']);
$table->add_line(KLN_PPV_MOY, $kie['pagesperguestaverage']);
$table->add_line(KLN_PAG_REC, $kie['pagesrecord']);
$table->add_line(KLN_VIS_REC, $kie['guestsrecord']);

$table3 = new ktable(KLN_INF_SYS, '');
$table3->merge_title(2,0);
$table3->set_class('justify', 'center');
$table3->set_name('infosystem');

$table3->add_line(KLN_SYS_EXP, php_uname());
$table3->add_line(KLN_WEB_SER, $_SERVER['SERVER_SOFTWARE']);
$table3->add_line(KLN_PHP_VER, phpversion());
$table3->add_line(KLN_SQL_VER, mysql_get_server_info());

$connexion->close();

echo '<h1>'.KLN_RES_TIT.'</h1>';
echo '<p>'.KLN_RES_INF.'</p>';
echo $table->show();
echo '<br />';
echo $table3->show();
?>
