<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

if ($_SESSION['kie_operation'] == 'setup')
{
 setcookie('kie_cookie_exclusion', 1, time()+3600*24*365*5, '/');
}
elseif ($_SESSION['kie_operation'] == 'delete')
{
 setcookie('kie_cookie_exclusion', 1, time()-3600, '/');
}

if ($_SESSION['kie_operation'] == 'setup' or $_SESSION['kie_operation'] == 'delete')
{
 $_SESSION['kie_operation'] = '';
 echo '<p class="success">'.KLN_EXC_OK.'</p>';
}

echo '<h1>'.KLN_EXC_TIT.'</h1>';
echo '<p>'.KLN_EXC_IN1.'</p>';
echo '<p>'.KLN_EXC_IN2.'</p>';

if (!empty($_COOKIE['kie_cookie_exclusion']))
{
 echo '<p>'.KLN_EXC_COK.'</p>';
 echo '<form method="post" action="?kie_action=exclude&amp;kie_operation=delete">';
 echo '<button type="submit">'.KLN_EXC_DEL.'</button>';
 echo '</form>';
}
else
{
 echo '<p>'.KLN_EXC_CNO.'</p>';
 echo '<form method="post" action="?kie_action=exclude&amp;kie_operation=setup">';
 echo '<button type="submit">'.KLN_EXC_INS.'</button>';
 echo '</form>';
}
?>
