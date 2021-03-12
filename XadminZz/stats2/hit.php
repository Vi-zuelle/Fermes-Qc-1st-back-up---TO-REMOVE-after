<?php
include_once $url_hit.'class/kdetect.class.php';
if ($_GET['kie_appel'] == 'img')
{
 $kie['stats'] = new kdetect('img', '', $_GET['kie_website']);
}
else
{
 $kie['stats'] = new kdetect('php', $url_hit, $website);
}
?>
