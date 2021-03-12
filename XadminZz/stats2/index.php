<?php
// ---------------- //
// Starting session //
// ---------------- //
session_start();

// ------------------- //
// Initializing arrays //
// ------------------- //
$kietu = array();
$kie  = array();
$kietu['version'] = '4.0.0 beta';

// ------------------------------------ //
// Changing configuration of the server //
// ------------------------------------ //
@ini_set('magic_quotes_gpc', TRUE);

// ---------------- //
// Development mode //
// ---------------- //
error_reporting(E_ALL);

// ------------------------- //
// Inclusion of needed files //
// ------------------------- //
include_once 'class/tbs.class.php';
include_once 'class/ktable.class.php';
include_once 'class/ksqllayer.class.php';
include_once 'inc/config.php';
include_once 'inc/configsites.php';
include_once 'inc/functions.php';

// ---------- //
// Begin time //
// ---------- //
$kie['temps_debut'] = get_time();

// ---------------- //
// Recovering datas //
// ---------------- //
if (!empty($_GET['kie_action']))    { $_SESSION['kie_action']    = $_GET['kie_action'];    } elseif (empty($_SESSION['kie_action']))    { $_SESSION['kie_action']    = ''; }
if (!empty($_GET['kie_operation'])) { $_SESSION['kie_operation'] = $_GET['kie_operation']; } elseif (empty($_SESSION['kie_operation'])) { $_SESSION['kie_operation'] = ''; }
if (!empty($_POST['kie_id_sit']))   { $_SESSION['kie_id_sit']    = $_POST['kie_id_sit'];   } elseif (empty($_SESSION['kie_id_sit']))    { $_SESSION['kie_id_sit']  = '*'; }
if (!empty($_GET['kie_id']))        { $_SESSION['kie_id']        = $_GET['kie_id'];        } elseif (empty($_SESSION['kie_id']))        { $_SESSION['kie_id'] = '*'; }
if (!empty($_GET['kie_tri']))       { $_SESSION['kie_tri']       = $_GET['kie_tri'];       } elseif (empty($_SESSION['kie_tri']))       { $_SESSION['kie_tri'] = '*'; }
if (isset($_GET['kie_champ']))      { $_SESSION['kie_champ']     = $_GET['kie_champ'];     } elseif (!isset($_SESSION['kie_champ']))    { $_SESSION['kie_champ'] = 0; }
if (!empty($_GET['kie_sens']))      { $_SESSION['kie_sens']      = $_GET['kie_sens'];      } elseif (empty($_SESSION['kie_sens']))      { $_SESSION['kie_sens'] = '*'; }
if (!empty($_GET['kie_ad']))        { $_SESSION['kie_ad']        = TRUE;                   } elseif (empty($_SESSION['kie_ad']))        { $_SESSION['kie_ad'] = FALSE; }
if (!empty($_POST['kie_login']))    { $_SESSION['kie_login']     = $_POST['kie_login'];    } elseif (empty($_SESSION['kie_login']))     { $_SESSION['kie_login'] = ''; }
if (!empty($_POST['kie_pass']))     { $_SESSION['kie_pass']      = md5($_POST['kie_pass']);} elseif (empty($_SESSION['kie_pass']))      { $_SESSION['kie_pass'] = ''; }
if (!empty($_POST['kie_lang']))     { setcookie('kie_lang', $_POST['kie_lang'], time() + 3600*24*365, '/'); } elseif (empty($_COOKIE['kie_lang'])) { setcookie('kie_lang', $kietu['pref_lang'], time() + 60*60*24*365, '/'); }
if (!empty($_POST['kie_template'])) { setcookie('kie_template', $_POST['kie_template'], time() + 3600*24*365, '/'); } elseif (empty($_COOKIE['kie_template'])) { setcookie('kie_template', $kietu['pref_template'], time() + 60*60*24*365, '/'); }
if (!empty($_POST['kie_jou_deb']))  { $_SESSION['kie_jou_deb'] = $_POST['kie_jou_deb']; } elseif (empty($_SESSION['kie_jou_deb'])) { $_SESSION['kie_jou_deb'] = '31'; }
if (!empty($_POST['kie_jou_fin']))  { $_SESSION['kie_jou_fin'] = $_POST['kie_jou_fin']; } elseif (empty($_SESSION['kie_jou_fin'])) { $_SESSION['kie_jou_fin'] = '31'; }
if (!empty($_POST['kie_moi_deb']))  { $_SESSION['kie_moi_deb'] = $_POST['kie_moi_deb']; } elseif (empty($_SESSION['kie_moi_deb'])) { $_SESSION['kie_moi_deb'] = '1'; }
if (!empty($_POST['kie_moi_fin']))  { $_SESSION['kie_moi_fin'] = $_POST['kie_moi_fin']; } elseif (empty($_SESSION['kie_moi_fin'])) { $_SESSION['kie_moi_fin'] = '12'; }
if (!empty($_POST['kie_ann_deb']))  { $_SESSION['kie_ann_deb'] = $_POST['kie_ann_deb']; } elseif (empty($_SESSION['kie_ann_deb'])) { $_SESSION['kie_ann_deb'] = '2011'; }
if (!empty($_POST['kie_ann_fin']))  { $_SESSION['kie_ann_fin'] = $_POST['kie_ann_fin']; } elseif (empty($_SESSION['kie_ann_fin'])) { $_SESSION['kie_ann_fin'] = '2016'; }

// ----------------------- //
// Language file inclusion //
// ----------------------- //
if (!empty($_POST['kie_lang']) && file_exists('lang/'.$_POST['kie_lang'].'.lang.php'))
{
 // a change has just occur
 include_once 'lang/'.$_POST['kie_lang'].'.lang.php';
 $kietu['active_lang'] = $_POST['kie_lang'];
}
else if (!empty($_COOKIE['kie_lang']) && file_exists('lang/'.$_COOKIE['kie_lang'].'.lang.php'))
{
 // a cookie is set
 include_once 'lang/'.$_COOKIE['kie_lang'].'.lang.php';
 $kietu['active_lang'] = $_COOKIE['kie_lang'];
}
else
{
 // otherweise
 include_once 'lang/'.$kietu['pref_lang'].'.lang.php';
 $kietu['active_lang'] = $kietu['pref_lang'];
}

// ------------------ //
// Authorizing access //
// ------------------ //
if ($kietu['pref_protect'] == 1 || in_array($_SESSION['kie_action'], array('install', 'options', 'exclude', 'bdd', 'code', 'lastguests')))
{
 if (empty($_SESSION['kie_login']) || empty($_SESSION['kie_pass']) || $_SESSION['kie_login'] != $kietu['conf_login'] || $_SESSION['kie_pass'] != md5($kietu['conf_pass']))
 {
  $_SESSION['kie_action'] = 'login';
 }
}

// ------------------------ //
// Template file definition //
// ------------------------ //
if (!empty($_POST['kie_template']) && file_exists('templates/'.$_POST['kie_template'].'.tpl.html'))
{
 // a change has just occur
 $kie_template = 'templates/'.$_POST['kie_template'].'.tpl.html';
 $kietu['active_template'] = $_POST['kie_template'];
}
else if (!empty($_COOKIE['kie_template']) && file_exists('templates/'.$_COOKIE['kie_template'].'.tpl.html'))
{
 // a cookie is set
 $kie_template = 'templates/'.$_COOKIE['kie_template'].'.tpl.html';
 $kietu['active_template'] = $_COOKIE['kie_template'];
}
else
{
 // otherweise
 $kie_template = 'templates/'.$kietu['pref_template'].'.tpl.html';
 $kietu['active_template'] = $kietu['pref_template'];
}

// -------------------------------------- //
// Generating the filter for all requests //
// -------------------------------------- //




$kietu['filtre'] = 'WHERE date >= \''.$_SESSION['kie_ann_deb'].'-'.$_SESSION['kie_moi_deb'].'-'.$_SESSION['kie_jou_deb'].'\' AND date <= \''.$_SESSION['kie_ann_fin'].'-'.$_SESSION['kie_moi_fin'].'-'.$_SESSION['kie_jou_fin'].'\'';


/*
if (is_numeric($_SESSION['kie_id_sit']))
{
 $kietu['filtre'] .= 'AND id_sit = '.$_SESSION['kie_id_sit'].' ';
 $kietu['filtre_site'] = 'WHERE id_sit = '.$_SESSION['kie_id_sit'].' ';
}
else
{
 $kietu['filtre_site'] = 'WHERE 1 = 1 ';
}
*/

 $kietu['filtre_site'] = 'WHERE id_sit = 1 ';


// ----------------------------------- //
// Loading template with TinyButStrong //
// ----------------------------------- //
$TBS = new clsTinyButStrong('{}') ;
$TBS->LoadTemplate($kie_template);

// Filling in the menus
/*

$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['administration'], 'texte'=>$kietu['KLN']['menu']['options'], 'lien'=>'?kie_action=options');
$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['administration'], 'texte'=>$kietu['KLN']['menu']['exclude'], 'lien'=>'?kie_action=exclude');
$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['administration'], 'texte'=>$kietu['KLN']['menu']['bdd'], 'lien'=>'?kie_action=bdd');
$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['administration'], 'texte'=>$kietu['KLN']['menu']['code'], 'lien'=>'?kie_action=code');
$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['administration'], 'texte'=>$kietu['KLN']['menu']['lastguests'], 'lien'=>'?kie_action=lastguests');

if (!empty($_SESSION['kie_login']))
{
 $menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['administration'], 'texte'=>$kietu['KLN']['menu']['quit'], 'lien'=>'?kie_action=quit');
}
*/

$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['access'], 'texte'=>$kietu['KLN']['menu']['summary'], 'lien'=>'?kie_action=summary');
$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['access'], 'texte'=>$kietu['KLN']['menu']['hourly'], 'lien'=>'?kie_action=hourly');
$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['access'], 'texte'=>$kietu['KLN']['menu']['daily'], 'lien'=>'?kie_action=daily');
$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['access'], 'texte'=>$kietu['KLN']['menu']['monthly'], 'lien'=>'?kie_action=monthly');
$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['access'], 'texte'=>$kietu['KLN']['menu']['annual'], 'lien'=>'?kie_action=annual');
$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['access'], 'texte'=>$kietu['KLN']['menu']['last30'], 'lien'=>'?kie_action=last30');
$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['guests'], 'texte'=>$kietu['KLN']['menu']['domain'], 'lien'=>'?kie_action=domain&kie_operation=world');
$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['guests'], 'texte'=>$kietu['KLN']['menu']['language'], 'lien'=>'?kie_action=language');
$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['guests'], 'texte'=>$kietu['KLN']['menu']['os'], 'lien'=>'?kie_action=os');
$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['guests'], 'texte'=>$kietu['KLN']['menu']['browser'], 'lien'=>'?kie_action=browser');
$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['navigation'], 'texte'=>$kietu['KLN']['menu']['pages'], 'lien'=>'?kie_action=pages');
$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['navigation'], 'texte'=>$kietu['KLN']['menu']['referents'], 'lien'=>'?kie_action=referents');
$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['navigation'], 'texte'=>$kietu['KLN']['menu']['engines'], 'lien'=>'?kie_action=engines');
$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['navigation'], 'texte'=>$kietu['KLN']['menu']['engineswithkeywords'], 'lien'=>'?kie_action=engineswithkeywords');
$menu_gauche[] = array('titre'=>$kietu['KLN']['menu']['navigation'], 'texte'=>$kietu['KLN']['menu']['keywords'], 'lien'=>'?kie_action=keywords');
$TBS->MergeBlock('blk_menu_gauche', $menu_gauche);

// Filling in the forms
for ($i = 1; $i <= 31; $i++)
{
 $liste_jour[] = array('value'=>$i, 'name'=>$i);
}
for ($i = 1; $i <= 12; $i++)
{
 $liste_mois[] = array('value'=>$i, 'name'=>$kietu['KLN']['mois'][$i-1]);
}
for ($i = 2016; $i <= 2018; $i++)
{
 $liste_annee[] = array('value'=>$i, 'name'=>$i);
}
$liste_sites[] = array('value'=>'*', 'name'=>'TOUS');
if (!empty($kietu['liste_sites']))
{
 foreach ($kietu['liste_sites'] AS $key=>$value)
 {
  $liste_sites[] = array('value'=>$key, 'name'=>$value[0]);
 }
}
$TBS->MergeBlock('blk_jou_deb', $liste_jour);
$TBS->MergeBlock('blk_jou_fin', $liste_jour);
$TBS->MergeBlock('blk_moi_deb', $liste_mois);
$TBS->MergeBlock('blk_moi_fin', $liste_mois);
$TBS->MergeBlock('blk_ann_deb', $liste_annee);
$TBS->MergeBlock('blk_ann_fin', $liste_annee);
$TBS->MergeBlock('blk_id_sit',  $liste_sites);

// Filling in the language selection
if ($handle = @opendir('lang/'))
{
 while (false !== ($file = readdir($handle)))
 {
  if (substr($file,-9) == '.lang.php')
  {
   $kie['arraylang'][] = array('value'=>substr($file,0,strpos($file,'.')), 'name'=>substr($file,0,strpos($file,'.')));
  }
 }
 closedir($handle);
}
$TBS->MergeBlock('blk_langue', $kie['arraylang']);

// Filling in the template selection
if ($handle = @opendir('templates/'))
{
 while (false !== ($file = readdir($handle)))
 {
  if (substr($file,-9) == '.tpl.html')
  {
   $kie['arraytemplates'][] = array('value'=>substr($file,0,strpos($file,'.')), 'name'=>substr($file,0,strpos($file,'.')));
  }
 }
 closedir($handle);
}
$TBS->MergeBlock('blk_template', $kie['arraytemplates']);

// Filling in the advertissement
if ($kietu['pref_pub'] == 1 || $_SESSION['kie_ad'] == TRUE)
{
 // Advertissement is activated
 $kietu['codepub'] = '<SCRIPT LANGUAGE="javascript" SRC="http://www.kietu.net/bandeauv4.php?version='.$kietu['version'].'&amp;action='.$_SESSION['kie_action'].'&amp;lng='.$kietu['active_lang'].'" type="text/javascript"></SCRIPT>';
}
else
{
 // No advert
 $kietu['codepub'] = '<a href="?kie_action='.$_SESSION['kie_action'].'&amp;kie_operation='.$_SESSION['kie_operation'].'&amp;kie_ad=1">'.KLN_ADVERT.'</a>';
}
// -------------- //
// File inclusion //
// -------------- //
define('INCLUDED_IN_KIETU', TRUE);
if ($kietu['installation_step'] == 'todo')
{
 $kietu_a_inclure = 'inc/install.php';
}
else if ($_SESSION['kie_action'] == '' or !file_exists('inc/'.$_SESSION['kie_action'].'.php'))
{
 $kietu_a_inclure = 'inc/summary.php';
}
else
{
 $kietu_a_inclure = 'inc/'.$_SESSION['kie_action'].'.php';
}

// -------- //
// End time //
// -------- //
$kietu['temps_generation'] = KLN_TPS_GEN.round(get_time() - $kie['temps_debut'], 3).' s';

// ------------ //
// Showing page //
// ------------ //
$TBS->Show();
?>
