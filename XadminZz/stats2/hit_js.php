<?php
include 'inc/config.php';
?>
function kietu_tag(website)
{
 var url_referer1=top.document.referrer;
 var url_referer2=url_referer1.split("&");
 var url_referer3=url_referer2.join("*");
 var url_referer4=url_referer3.split("?");
 var url_referer_final=url_referer4.join("**");
 document.write('<a href="http://www.kietu.net"><img border="0" src="<?php echo $kietu['conf_url_absolue']; ?>hit.php?kie_appel=img&amp;kie_website='+website+'&amp;kie_referimg='+url_referer_final+'" /></a>');
}
