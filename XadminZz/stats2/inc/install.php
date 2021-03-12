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
 $connexion = new ksqllayer ($cfg->valeur("kietu['mysql_host']"), $cfg->valeur("kietu['mysql_user']"), $cfg->valeur("kietu['mysql_pass']"), $cfg->valeur("kietu['mysql_database']"));
 if ($connexion->link == TRUE)
 {
  $connexion->query("CREATE TABLE ".$cfg->valeur("kietu['mysql_prefixe']")."domai (id_sit tinyint(1) unsigned NOT NULL default '0', date date NOT NULL default '0000-00-00', lang char(2) NOT NULL default '', domain char(4) NOT NULL default '', nb mediumint(3) NOT NULL default '0', KEY id_sit (id_sit), KEY date (date)) TYPE=MyISAM;");
  $connexion->query("CREATE TABLE ".$cfg->valeur("kietu['mysql_prefixe']")."heure (id_sit tinyint(1) unsigned NOT NULL default '0', date date NOT NULL default '0000-00-00', heure tinyint(1) unsigned NOT NULL default '0', nb_pag mediumint(3) unsigned NOT NULL default '0', nb_vis mediumint(3) unsigned NOT NULL default '0', KEY id_sit (id_sit), KEY date (date)) TYPE=MyISAM;");
  $connexion->query("CREATE TABLE ".$cfg->valeur("kietu['mysql_prefixe']")."keywords (id_sit tinyint(1) unsigned NOT NULL default '0', date date NOT NULL default '0000-00-00', engine varchar(20) NOT NULL default '', keywords varchar(50) NOT NULL default '', nb mediumint(3) NOT NULL default '0', KEY id_sit (id_sit), KEY date (date)) TYPE=MyISAM;");
  $connexion->query("CREATE TABLE ".$cfg->valeur("kietu['mysql_prefixe']")."pages (id_sit tinyint(1) unsigned NOT NULL default '0', date date NOT NULL default '0000-00-00', page varchar(50) NOT NULL default '', nb mediumint(3) NOT NULL default '0', KEY id_sit (id_sit), KEY date (date)) TYPE=MyISAM;");
  
  $connexion->query("CREATE TABLE ".$cfg->valeur("kietu['mysql_prefixe']")."recent (id_sit tinyint(1) unsigned NOT NULL default '0', timestamp timestamp(14) NOT NULL, ip char(15) NOT NULL default '', user_agent char(255) NOT NULL default '', KEY id_sit (id_sit)) TYPE=MyISAM;");
  
  $connexion->query("CREATE TABLE ".$cfg->valeur("kietu['mysql_prefixe']")."refer (id_sit tinyint(1) unsigned NOT NULL default '0', date date NOT NULL default '0000-00-00', refer char(80) NOT NULL default '', nb smallint(5) unsigned NOT NULL default '0', KEY id_sit (id_sit), KEY date (date)) TYPE=MyISAM;");
  $connexion->query("CREATE TABLE ".$cfg->valeur("kietu['mysql_prefixe']")."visit (id_sit tinyint(1) unsigned NOT NULL default '0', date date NOT NULL default '0000-00-00', os enum('winME','win98','win2k','win95','winXP','winNT','win','linux','sunos','bsd','aix','qnx','hpux','irix','unix','macosx','macppc','mac','beos','os2','bot','tv','unknown','error') NOT NULL default 'error', nav enum('IE','MZ','NE','bot','unknown','error','AM','AO','AG','BF','BX','DI','FB','FF','GA','HJ','IC','IB','KA','KQ','LI','LY','NM','OW','OP','PX','OO','SA','SO','TV','WG') NOT NULL default 'error', nav_ver char(4) NOT NULL default '0.0', nb_pag mediumint(8) unsigned NOT NULL default '0', nb_vis mediumint(8) unsigned NOT NULL default '0', KEY id_sit (id_sit), KEY date (date)) TYPE=MyISAM;");
 }
 else
 {
  $_SESSION['kie_operation'] = '';
  echo '<p class="error">'.KLN_INS_UNA.' ('.KLN_OPT_HOST.', '.KLN_OPT_USER.', '.KLN_OPT_PASS.' ainsi que '.KLN_OPT_BDD.').</p>';
 }
 if (isset($connexion->rs) && $connexion->rs == TRUE)
 {
  echo '<p class="success">'.KLN_INS_CRE.'</p>';
 }
 else
 {
  $_SESSION['kie_operation'] = '';
  echo '<p class="error">'.KLN_INS_ERR.'</p>';
 }
 $connexion->close();
 if ($cfg->save())
 {
  echo '<p class="success">'.KLN_SAV_OK.'</p>';
 }
 else
 {
  $_SESSION['kie_operation'] = '';
  echo '<p class="error">'.KLN_SAV_NO.'</p>';
 }
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


if ($_SESSION['kie_operation'] == 'step2')
{
 $cfg->change("kietu['installation_step']", 'finished v'.$kietu['version']);
 $cfg->save();
 echo '<h1>Installation - Etape 2/2</h1>';
 echo '<p>'.KLN_INS_SU1.'</p>';
 echo '<p>'.KLN_INS_SU2.'</p>';
}
else
{
 include 'class/kform.class.php';
 $form = new kform('?kie_action=install&amp;kie_operation=step2');

 $form->add_fieldset(KLN_OPT_MYSQL);
 $form->add_field('mysql_host', 'text', KLN_OPT_HOST, $cfg->valeur("kietu['mysql_host']"), 0);
 $form->add_field('mysql_user', 'text', KLN_OPT_USER, $cfg->valeur("kietu['mysql_user']"), 0);
 $form->add_field('mysql_pass', 'password', KLN_OPT_PASS, $cfg->valeur("kietu['mysql_pass']"), 0);
 $form->add_field('mysql_database', 'text', KLN_OPT_BDD, $cfg->valeur("kietu['mysql_database']"), 0);
 $form->add_field('mysql_prefixe', 'text', KLN_OPT_PREF, $cfg->valeur("kietu['mysql_prefixe']"), 0);
 $form->add_fieldset(KLN_OPT_CONF);
 $form->add_field('conf_login', 'text', KLN_OPT_LOG, $cfg->valeur("kietu['conf_login']"), 1);
 $form->add_field('conf_pass', 'password', KLN_OPT_MDP, $cfg->valeur("kietu['conf_pass']"), 1);
 $form->add_field('conf_url_absolue', 'text', KLN_OPT_URL, $cfg->valeur("kietu['conf_url_absolue']"),  1);
 $form->add_field('conf_decal_horaire', 'select', KLN_OPT_DECAL . ' ('.date('H').' h)', array(array('-12'=>'-12', '-11'=>'-11', '-10'=>'-10', '-09'=>'-09', '-08'=>'-08', '-07'=>'-07', '-06'=>'-06', '-05'=>'-05', '-04'=>'-04', '-03'=>'-03', '-02'=>'-02', '-01'=>'-01', '+00'=>'+00', '+01'=>'+01', '+02'=>'+02', '+03'=>'+03', '+04'=>'+04', '+05'=>'+05', '+06'=>'+06', '+07'=>'+07', '+08'=>'+08', '+09'=>'+09', '+10'=>'+10', '+11'=>'+11', '+12'=>'+12'), $cfg->valeur("kietu['conf_decal_horaire']")), 1);
 $form->add_field('conf_tps_limite', 'text', KLN_OPT_TPS, $cfg->valeur("kietu['conf_tps_limite']"), 1);
 $form->add_fieldset(KLN_OPT_GENE);
 $form->add_field('pref_protect', 'radio', KLN_OPT_PRO, array(array(KLN_NO, KLN_YES), $cfg->valeur("kietu['pref_protect']")), 2);
 $form->add_field('pref_pub', 'radio', KLN_OPT_PUB, array(array(KLN_NO, KLN_YES), $cfg->valeur("kietu['pref_pub']")), 2);
 $form->add_field('pref_template', 'select', KLN_OPT_TPL, array($kie['arraytemplates'], $cfg->valeur("kietu['pref_template']")), 2);
 $form->add_field('pref_lang', 'select', KLN_OPT_LNG, array($kie['arraylang'], $cfg->valeur("kietu['pref_lang']")), 2);

 echo '<h1>'.KLN_INS_TI1.'</h1>';
 echo '<p>'.KLN_INS_IN1.'</p>';
 echo '<p>'.KLN_INS_IN2.'</p>';
 echo '<p>'.KLN_INS_IN3.'</p>';
 echo $form->show();
}
?>
