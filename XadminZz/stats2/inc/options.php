<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu;

include 'class/kconfig.class.php';
$cfg = new kconfigfile('inc/config.php');

if ($_SESSION['kie_operation'] == 'step2')
{
 foreach ($cfg->infos as $key => $value)
 {
  if (isset($_POST[substr($key, 7, -2)]) && $_POST[substr($key, 7, -2)] <> $value)
  {
   $cfg->change($key, $_POST[substr($key, 7, -2)]);
  }
 }
 if ($cfg->save())
 {
  echo '<p class="success">'.KLN_SAV_OK.'</p>';
 }
 else
 {
  echo '<p class="error">'.KLN_SAV_NO.'</p>';
 }
 $_SESSION['kie_operation'] = '';
}

if ($handle = @opendir('templates/'))
{
 while (false !== ($file = readdir($handle)))
 {
  if (substr($file,-9) == '.tpl.html')
  {
   $kie['arraytemplates'][substr($file,0,strpos($file,'.'))] = substr($file,0,strpos($file,'.'));
  }
 }
 closedir($handle);
}

if ($handle = @opendir('lang/'))
{
 while (false !== ($file = readdir($handle)))
 {
  if (substr($file,-9) == '.lang.php')
  {
   $kie['arraylang'][substr($file,0,strpos($file,'.'))] = substr($file,0,strpos($file,'.'));
  }
 }
 closedir($handle);
}

include 'class/kform.class.php';
$form = new kform('?kie_action=options&amp;kie_operation=update');

$form->add_fieldset(KLN_OPT_MYSQL);
$form->add_field('mysql_host', 'text', KLN_OPT_HOST, $cfg->valeur("kietu['mysql_host']"), 0);
$form->add_field('mysql_user', 'text', KLN_OPT_USER, $cfg->valeur("kietu['mysql_user']"), 0);
$form->add_field('mysql_pass', 'password', KLN_OPT_PASS, $cfg->valeur("kietu['mysql_pass']"), 0);
$form->add_field('mysql_database', 'text', KLN_OPT_BDD, $cfg->valeur("kietu['mysql_database']"), 0);
$form->add_field('mysql_prefixe', 'text', KLN_OPT_PREF, $cfg->valeur("kietu['mysql_prefixe']"), 0);
$form->add_fieldset(KLN_OPT_CONF);
$form->add_field('conf_login', 'text', KLN_OPT_LOG, $cfg->valeur("kietu['conf_login']"), 1);
$form->add_field('conf_pass', 'password', KLN_OPT_MDP, $cfg->valeur("kietu['conf_pass']"), 1);
$form->add_field('conf_url_absolue', 'text', KLN_OPT_URL, $cfg->valeur("kietu['conf_url_absolue']"), 1);
$form->add_field('conf_decal_horaire', 'select', KLN_OPT_DECAL . ' ('.date('H').' h)', array(array('-12'=>'-12', '-11'=>'-11', '-10'=>'-10', '-09'=>'-09', '-08'=>'-08', '-07'=>'-07', '-06'=>'-06', '-05'=>'-05', '-04'=>'-04', '-03'=>'-03', '-02'=>'-02', '-01'=>'-01', '+00'=>'+00', '+01'=>'+01', '+02'=>'+02', '+03'=>'+03', '+04'=>'+04', '+05'=>'+05', '+06'=>'+06', '+07'=>'+07', '+08'=>'+08', '+09'=>'+09', '+10'=>'+10', '+11'=>'+11', '+12'=>'+12'), $cfg->valeur("kietu['conf_decal_horaire']")), 1);
$form->add_field('conf_tps_limite', 'text', KLN_OPT_TPS, $cfg->valeur("kietu['conf_tps_limite']"), 1);
$form->add_fieldset(KLN_OPT_GENE);
$form->add_field('pref_protect', 'radio', KLN_OPT_PRO, array(array(KLN_NO, KLN_YES), $cfg->valeur("kietu['pref_protect']")), 2);
$form->add_field('pref_pub', 'radio', KLN_OPT_PUB, array(array(KLN_NO, KLN_YES), $cfg->valeur("kietu['pref_pub']")), 2);
$form->add_field('pref_template', 'select', KLN_OPT_TPL, array($kie['arraytemplates'], $cfg->valeur("kietu['pref_template']")), 2);
$form->add_field('pref_lang', 'select', KLN_OPT_LNG, array($kie['arraylang'], $cfg->valeur("kietu['pref_lang']")), 2);

echo '<h1>'.KLN_OPT_TIT.'</h1>';
echo '<p>'.KLN_OPT_INF.'</p>';
echo $form->show();
echo '<p>'.KLN_OPT_EXPL.'</p>';
?>
