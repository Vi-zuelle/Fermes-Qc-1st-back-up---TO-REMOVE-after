<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

global $kietu;

include 'class/kform.class.php';
$form = new kform('?kie_action=login');
$form->add_fieldset('Connexion');
$form->add_field('kie_login', 'text', KLN_OPT_LOG, '', 0);
$form->add_field('kie_pass', 'password', KLN_OPT_MDP, '', 0);

echo '<h1>'.KLN_LOG_TIT.'</h1>';
echo '<p>'.KLN_LOG_INF.'</p>';
echo $form->show();

if ($_SESSION['kie_login'] == $kietu['conf_login'] && $_SESSION['kie_pass'] == md5($kietu['conf_pass']))
{
 echo '<p class="success">'.KLN_LOG_OK.'</p>';
}
?>
