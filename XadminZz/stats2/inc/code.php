<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu;

include 'class/kconfig.class.php';
include 'class/kform.class.php';

$cfg = new kconfigfile('inc/configsites.php');

if ($_SESSION['kie_operation'] == 'update')
{
 if (!empty($_POST['k_cha_name'])) {$cfg->change('kietu[\'liste_sites\']['.$_SESSION['kie_id'].'][0]', $_POST['k_cha_name']);}
 if (!empty($_POST['k_cha_display'])) {$cfg->change('kietu[\'liste_sites\']['.$_SESSION['kie_id'].'][1]', $_POST['k_cha_display']);}
 if (!empty($_POST['k_cha_url']))
 {
  $kie['temp'] = explode(' ', trim($_POST['k_cha_url']));
  $i = 2;
  foreach ($kie['temp'] AS $value)
  {
   $cfg->change('kietu[\'liste_sites\']['.$_SESSION['kie_id'].']['.$i.']', $value);
   $i++;
  }
  while ($cfg->valeur('kietu[\'liste_sites\']['.$_SESSION['kie_id'].']['.$i.']') == true)
  {
   $cfg->delete('kietu[\'liste_sites\']['.$_SESSION['kie_id'].']['.$i.']');
   $i++;
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
 $_SESSION['kie_operation'] = 'modify';
}
else if ($_SESSION['kie_operation'] == 'new')
{
 $cfg->change('kietu[\'last_id\']', $kietu['last_id']+1);
 if (!empty($_POST['k_new_name']))
 {
  $cfg->change('kietu[\'liste_sites\']['.($kietu['last_id']+1).'][0]', $_POST['k_new_name']);
 }
 else
 {
  $cfg->change('kietu[\'liste_sites\']['.($kietu['last_id']+1).'][0]', 'Website number '.($kietu['last_id']+1));
 }
 if (!empty($_POST['k_new_display']))
 {
  $cfg->change('kietu[\'liste_sites\']['.($kietu['last_id']+1).'][1]', $_POST['k_new_display']);
 }
 else
 {
  $cfg->change('kietu[\'liste_sites\']['.($kietu['last_id']+1).'][1]', 'img');
 }
 if (!empty($_POST['k_new_url']))
 {
  $kie['temp'] = explode(' ', trim($_POST['k_new_url']));
  $i = 2;
  foreach ($kie['temp'] AS $value)
  {
   $cfg->change('kietu[\'liste_sites\']['.($kietu['last_id']+1).']['.$i.']', $value);
   $i++;
  }
 }
 else
 {
  $cfg->change('kietu[\'liste_sites\']['.($kietu['last_id']+1).'][2]', 'http://www.yourwebsite.com');
 }
 if ($cfg->save())
 {
  echo '<p class="success">'.KLN_SAV_OK.'</p>';
  $_SESSION['kie_id'] = $kietu['last_id']+1;
 }
 else
 {
  echo '<p class="error">'.KLN_SAV_NO.'</p>';
 }
 $_SESSION['kie_operation'] = 'modify';
}

echo '<h1>'.KLN_COD_TIT.'</h1>';
echo '<p>'.KLN_COD_INF.'</p>';
echo '<h1>'.KLN_SITDISP.'</h1>';

include 'inc/configsites.php';
if (!empty($kietu['liste_sites']))
{
 $table = new ktable(KLN_NUMMER, KLN_NAME, KLN_COD_MOD, KLN_COD_RET, KLN_COD_DEL);
 foreach ($kietu['liste_sites'] as $key => $value)
 {
  $table->add_line($key, $value[0], '<a href="?kie_action=code&amp;kie_operation=modify&amp;kie_id='.$key.'">'.KLN_COD_MOD.'</a>', '<a href="?kie_action=code&amp;kie_operation=recover&amp;kie_id='.$key.'">'.KLN_COD_RET.'</a>', '<a href="?kie_action=delete&amp;kie_id='.$key.'">'.KLN_COD_DEL.'</a>');
 }
 echo $table->show();
}
else
{
 echo '<p>'.KLN_COD_NOS.'</p>';
}

if ($_SESSION['kie_operation'] == 'modify')
{
 echo '<h1>Modifier le site n° '.$_SESSION['kie_id'].'</h1>'."\n";
 $i = 2;
 while ($url = $cfg->valeur('kietu[\'liste_sites\']['.$_SESSION['kie_id'].']['.$i.']'))
 {
  if ($i == 2)
  {
   $chaine_url = $url;
  }
  else
  {
   $chaine_url .= ' '.$url;
  }
  $i += 1;
 }
 $form = new kform('?kie_action=code&amp;kie_operation=update&amp;kie_id='.$_SESSION['kie_id']);
 $form->add_fieldset(KLN_COD_MOT);
 $form->add_field('k_cha_name', 'text', KLN_COD_CHN, $cfg->valeur('kietu[\'liste_sites\']['.$_SESSION['kie_id'].'][0]'), 0);
 $form->add_field('k_cha_display', 'select', KLN_COD_CHD.' (80x15) <img src="media/logo.png" />', array(array('img'=>KLN_COD_LOG, 'txt'=>KLN_COD_TXT, 'no'=>KLN_COD_SEC), $cfg->valeur('kietu[\'liste_sites\']['.$_SESSION['kie_id'].'][1]')), 0);
 $form->add_field('k_cha_url', 'textarea', KLN_COD_URL, $chaine_url, 0);
 echo $form->show();
 /**/
}
else if ($_SESSION['kie_operation'] == 'recover')
{
 echo '<h1>'.KLN_COD_COD.'</h1>';
 echo '<p>'.str_replace('%numsite%', $_SESSION['kie_id'], str_replace('%namesite%', $kietu['liste_sites'][$_SESSION['kie_id']][0], KLN_COD_INS)).'</p>';
 $form = new kform();
 $form->add_fieldset('Codes');
 $form->add_field('cod_php', 'textarea', 'Tag PHP', '<?php'."\n".'$website = '.$_SESSION['kie_id'].';'."\n".'$url_hit = \'kietu/\';'."\n".'include ($url_hit.\'hit.php\'); '."\n".'?>', 0);
 $form->add_field('cod_java', 'textarea', 'Tag JAVASCRIPT', '<script type="text/javascript" language="javascript" src="'.$kietu['conf_url_absolue'].'hit_js.php"></script>'."\n".'<script type="text/javascript" language="javascript">kietu_tag('.$_SESSION['kie_id'].');</script>', 0);
 $form->add_field('cod_img', 'textarea', 'Tag IMG', '<img border="0" src="'.$kietu['conf_url_absolue'].'hit.php?website='.$_SESSION['kie_id'].'&amp;appel=img" />', 0);
 echo $form->show();
}

echo '<h1>'.KLN_COD_CRE.'</h1>';
echo '<p>'.KLN_COD_CR1.'</p>';

$form = new kform('?kie_action=code&amp;kie_operation=new');
$form->add_fieldset(KLN_COD_NEW);
$form->add_field('k_new_name', 'text', KLN_COD_CHN, '', 0);
$form->add_field('k_new_display', 'select', KLN_COD_CHD.' (80x15) <img src="media/logo.png" />', array(array('img'=>KLN_COD_LOG, 'txt'=>KLN_COD_TXT, 'no'=>KLN_COD_SEC), 'txt'), 0);
$form->add_field('k_new_url', 'textarea', KLN_COD_URL, 'http://www.yourwebsite.com', 0);
echo $form->show();
?>
