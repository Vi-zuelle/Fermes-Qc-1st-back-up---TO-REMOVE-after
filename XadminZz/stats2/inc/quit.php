<?php
if (!defined('INCLUDED_IN_KIETU'))
{
 echo 'This file must be included into index.php';
 exit();
}

$_SESSION['kie_login'] = '';
$_SESSION['kie_pass'] = '';

echo '<h1>'.KLN_END_TIT.'</h1>';
echo '<p>'.KLN_END_INF.'</p>';