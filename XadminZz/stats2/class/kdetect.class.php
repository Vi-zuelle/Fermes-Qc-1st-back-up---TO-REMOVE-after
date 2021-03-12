<?php
class kdetect
{
var $info = array();
var $path = '';
// Debugging mode
var $debug = FALSE;
// Short referent without the name of the page
var $short_referent = FALSE;

// ------------------ //
// Class' constructor //
// ------------------ //
function kdetect($mode = 'php', $path = '', $website = 0)
{
 // Files' inclusion and data storage
 $this->info['mode'] = $mode;
 if (is_numeric($website))
 {
  $this->info['id_sit'] = $website;
 }
 else
 {
  $this->info['id_sit'] = 0;
 }
 $this->path = $path;
 include $this->path.'inc/config.php';
 include $this->path.'inc/configsites.php';
 
 // Date & time
 $temp                    = mktime(date('H') + $kietu['conf_decal_horaire']);
 $this->info['timestamp'] = date('YmdHis', $temp);
 $this->info['date']      = date('Y-m-d', $temp);
 $this->info['hour']      = date('H', $temp);

 // Trying to retrieve the exclusion's cookie
 if (empty($_COOKIE['kie_cookie_exclusion']))
 {
  $this->print_debug('Cookie not detected');
  $this->load_datas();
  if ($this->debug == TRUE)
  {
   echo '<pre>';
   print_r($this->info);
   echo '</pre>';
  }
  $this->save_datas();
 }
 else
 {
  $this->print_debug('Cookie detected');
 }

 // Printing the datas according to the choice of the webmaster
 if ($this->info['id_sit'] == 0)
 {
  $this->print_debug('Website number not valid');
  if ($this->info['mode'] == 'php')
  {
   echo '<a href="http://www.kietu.net"><img src="'.$this->path.'media/logo.png" border="0" /></a>';
  }
  else
  {
   header ('Location: media/logo.png');
  }
 }
 else
 {
  if ($this->info['mode'] == 'php')
  {
   if ($kietu['liste_sites'][$this->info['id_sit']][1] == 'img')
   {
    echo '<a href="http://www.kietu.net"><img src="'.$this->path.'media/logo.png" border="0" /></a>';
   }
   else if ($kietu['liste_sites'][$this->info['id_sit']][1] == 'txt')
   {
    echo '<a href="http://www.kietu.net">Stats by Kietu?</a>';
   }
  }
  else
  {
   if ($kietu['liste_sites'][$this->info['id_sit']][1] == 'img')
   {
    header ('Location: media/logo.png');
   }
   else
   {
    header ('Location: media/empty.png');
   }
  }
 }
}

// ----------------------------------- //
// Function used to retrieve all datas //
// ----------------------------------- //
function load_datas()
{
 $this->print_debug('Chargement des variables'); 
 $this->info['ip']     = $this->get_ip();
 $this->info['domain'] = $this->get_domain();
 $this->info['lang']   = $this->get_lang();
 $this->get_ua_infos();
 $this->info['page'] = $this->get_page();
 $this->info['referent'] = $this->get_referent();
 $this->info['keywords'] = $this->get_keywords();
}

// --------------------------------------------------------------- //
// Function used to retrieve the IP, trying to go through firewall //
// --------------------------------------------------------------- //
function get_ip()
{
 // 1st case : proxy && HTTP_X_FORWARDED_FOR is defined
 if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
 {
  $b = ereg ("^([0-9]{1,3}\.){3,3}[0-9]{1,3}", $_SERVER['HTTP_X_FORWARDED_FOR'], $array);
  if ($b && (count($array) >= 1))
  {
   return $array[0];
  }
 }
 // 2nd case : proxy && HTTP_X_FORWARDED is defined
 if (!empty($_SERVER['HTTP_X_FORWARDED']))
 {
  $b = ereg('^([0-9]{1,3}\.){3,3}[0-9]{1,3}', $_SERVER['HTTP_X_FORWARDED'], $array);
  if ($b && (count($array) >= 1))
  {
   return $array[0];
  }
 }
 // 3rd case : proxy && HTTP_FORWARDED_FOR is defined
 if (!empty($_SERVER['HTTP_FORWARDED_FOR']))
 {
  $b = ereg ('^([0-9]{1,3}\.){3,3}[0-9]{1,3}', $_SERVER['HTTP_FORWARDED_FOR'], $array);
  if ($b && (count($array) >= 1))
  {
   return $array[0];
  }
 }
 // 4th case : proxy && HTTP_FORWARDED is defined
 if (!empty($_SERVER['HTTP_FORWARDED']))
 {
  $b = ereg ('^([0-9]{1,3}\.){3,3}[0-9]{1,3}', $_SERVER['HTTP_FORWARDED'], $array);
  if ($b && (count($array) >= 1))
  {
   return $array[0];
  }
 }
 // 5th case : proxy && HTTP_VIA is defined
 if (!empty($_SERVER['HTTP_VIA']))
 {
  return $_SERVER['HTTP_X_COMING_FROM'];
 }
 // 6th case : proxy && HTTP_X_COMING_FROM
 if (!empty($_SERVER['HTTP_X_COMING_FROM']))
 {
  if ($_SERVER['REMOTE_ADDR'] != $_SERVER['HTTP_X_COMING_FROM'])
  {
   return $_SERVER['REMOTE_ADDR'];
  }
  else
  {
   return $_SERVER['HTTP_X_COMING_FROM'];
  }
 }
 // 7th case : proxy && HTTP_COMING_FROM is defined
 if (!empty($_SERVER['HTTP_COMING_FROM']))
 {
  if (empty($_SERVER['REMOTE_ADDR']))
  {
   return $_SERVER['HTTP_COMING_FROM'];
  }
  elseif  ($_SERVER['REMOTE_ADDR'] != $_SERVER['HTTP_COMING_FROM'])
  {
   return $_SERVER['REMOTE_ADDR'];
  }
  else
  {
   return $_SERVER['HTTP_COMING_FROM'];
  }
 }
 // 8th case : only REMOTE_ADDR is defined
 return $_SERVER['REMOTE_ADDR'];
}

// -------------------------------------------- //
// Function used to get the domain of the guest //
// -------------------------------------------- //
function get_domain()
{
 // domain name of the guest
 $temp = gethostbyaddr($this->info['ip']);
 if ($temp == $this->info['ip'])
 {
  return 'IP';
 }
 elseif ($temp == 'localhost')
 {
  return 'HOST';
 }
 else
 {
  // only the 4 first characters after the last dot are returned
  return substr(strtolower(strrchr($temp, '.')), 1, 4);
 }
}

// ---------------------------------------- //
// Function used to retrieved the language  //
// developped from get_accepted_languages() //
// Written by Matt - www.php-help.net       //
// ---------------------------------------- //
function get_lang()
{
 $a = explode(';', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
 if (count($a) < 2)
 {
  if (!empty($a[0])) { return substr($a[0], 0, 2); }
 }
 $p = explode(',', $a[0]);
 if (count($p) < 2)
 {
  if (!ereg('q=', $p[0]) && !empty($p[0])) { return substr($p[0], 0, 2); }
 }
 else
 {
  foreach ($p as $l)
  {
   if (!ereg('q=', $l) && !empty($l)) { return substr($l, 0, 2); }
  }
 }
 // no language has been found
 return 'xx';
}

// ---------------------------------------------- //
// Function used to retrieve the user agent datas //
// ---------------------------------------------- //
function get_ua_infos()
{
 $this->info['user_agent']     = substr(trim($_SERVER['HTTP_USER_AGENT']), 0, 255);
 $this->info['os']             = $this->get_os($_SERVER['HTTP_USER_AGENT']);
 $temp                         = $this->get_browser($_SERVER['HTTP_USER_AGENT']);
 $this->info['browser']        = $temp['nav'];
 $this->info['browserversion'] = rtrim(substr($temp['ver'], 0, 4), ' .');
}

// ---------------------------- //
// Function used to find the OS //
// ---------------------------- //
function get_os($agent)
{
 if (eregi('(win|windows) ?(9x ?4\.90|Me)', $agent)) return 'winME';
 if (eregi('(win|windows) ?(98)', $agent)) return 'win98';
 if (eregi('(win|windows) ?(2000)', $agent)) return 'win2k';
 if (eregi('(win|windows) ?(95)', $agent)) return 'win95';
 if (eregi('(win|windows) ?(NT)', $agent))
 {
  if (eregi('(win|windows) ?NT ?(5\.1|6(\.0)?)', $agent)) return 'winXP';
  if (eregi('(win|windows) ?NT ?(5(\.0)?)', $agent)) return 'win2k'; return 'winNT';
 }
 if (eregi('(win|windows) ?XP', $agent)) return 'winXP';
 if (eregi('(win|windows)', $agent)) return 'win';
 if (eregi('(linux)', $agent)) return 'linux';
 if (eregi('sunos', $agent)) return 'sunos';
 if (eregi('(freebsd|openbsd|netbsd)', $agent)) return 'bsd';
 if (eregi('aix', $agent)) return 'aix';
 if (eregi('qnx', $agent)) return 'qnx';
 if (eregi('hp-ux', $agent)) return 'hpux';
 if (eregi('irix', $agent)) return 'irix';
 if (eregi('(unix|x11)', $agent)) return 'unix';
 if (eregi('mac os x', $agent)) return 'macosx';
 if (eregi('(ppc|mac_powerpc)', $agent)) return 'macppc';
 if (eregi('mac', $agent)) return 'mac';
 if (eregi('beos', $agent)) return 'beos';
 if (eregi('os/2', $agent)) return 'os2';
 if (eregi('(googlebot|msnbot|slurp|altavista|arachnoidea|architextspider|ask jeeves|bot|b-l-i-t-z-bot|crawler|extractorpro|fdse robot|fido|geckobot|gigabot|girafabot|grub-client|gulliver|ia_archiver|infoseek|kit-fireball|leia|lycos_spider|muscatferret|polybot|pompos|scooter|spider|turnitinbot|violabot|webbandit|www.almaden.ibm.com/cs/crawler|zyborg)', $agent)) return 'bot';
 if (eregi('tv', $agent)) return 'tv';
 // no browser has been found
 return 'unknown';
}

// ------------------- //
// Getting the browser //
// ------------------- //
function get_browser($agent)
{
 // particular browsers
 $kie_liste_navigateurs = array('amaya' => 'AM', 'aol' => 'AO', 'avantgo' => 'AG', 'bluefish' => 'BF', 'browsex' => 'BX',  'dillo' => 'DI', 'firebird' => 'FB', 'firefox' => 'FF', 'galeon' => 'GA', 'hotjava' => 'HJ', 'icab' => 'IC', 'icebrowser' => 'IB', 'kanari' => 'KA', 'konqueror' => 'KQ', 'links' => 'LI', 'lynx' => 'LY', 'ncsa mosaic' => 'NM', 'omniweb' => 'OW', 'opera' => 'OP', 'phoenix' => 'PX', 'oregano' => 'OO', 'safari' => 'SA', 'staroffice' => 'SO', 'webtv' => 'TV', 'wget' => 'WG');
 foreach ($kie_liste_navigateurs as $key => $value)
 {
  if (eregi($key.'[ \/]([0-9\.]+)', $agent, $kie_version))
  {
   return array('nav' => $value, 'ver' => $kie_version[1]);
  }
 }
 // "standard" browser
 if (eregi('MSIE[ \/]([0-9\.]+)', $agent, $kie_version))
 {
  return array('nav' => 'IE', 'ver' => $kie_version[1]);
 }
 if (eregi('Mozilla/([0-9.]+)', $agent, $kie_version) && !eregi('compatible', $agent))
 {
  if (eregi('netscape[[:alnum:]]*[/\ ]([0-9.]+)', $agent, $kie_version))
  {
   return array('nav' => 'NE', 'ver' => $kie_version[1]);
  }
  if (eregi('rv:([0-9.]+)', $agent, $kie_version) || eregi('[^[]]m([0-9.]+)',$agent, $kie_version))
  {
   return array('nav' => 'MZ', 'ver' => $kie_version[1]);
  }
  return array('nav' => 'MZ', 'ver' => $kie_version[1]);
 }
 // search engines
 if (eregi('(googlebot|msnbot|slurp|altavista|arachnoidea|architextspider|ask jeeves|bot|b-l-i-t-z-bot|crawler|extractorpro|fdse robot|fido|geckobot|gigabot|girafabot|grub-client|gulliver|ia_archiver|infoseek|kit-fireball|leia|lycos_spider|muscatferret|polybot|pompos|scooter|spider|turnitinbot|violabot|webbandit|www.almaden.ibm.com/cs/crawler|zyborg)', $agent))
 {
  return array('nav' => 'bot', 'ver' => 0);
 }
 // nothing has been found
 return array('nav' => 'unknown', 'ver' => 0);
}

// ---------------- //
// Finding the page //
// ---------------- //
function get_page()
{
 // js or img mode
 if ($this->info['mode'] == 'img')
 {
  $temp = parse_url($_SERVER['HTTP_REFERER']);
  $return = $this->_unhtmlentities($temp['path']);
 }
 // php mode
 else
 {
  $return = $this->_unhtmlentities($_SERVER['REQUEST_URI']);
 }
 if (eregi('(.*)(\?phpsessid=)(.*)', $return, $regs)) { $return = $regs[1]; }
 if (eregi('(.*)(&phpsessid=)(.*)',  $return, $regs)) { $return = $regs[1]; }
 return substr($return, 0, 50);
}

// --------------------------------- //
// Function used to get the referent //
// --------------------------------- //
function get_referent()
{
 // if mode is set to img, then we have to decode the referer which come from javascript
 if ($this->info['mode'] == 'img')
 {
  $this->info['complete_referer'] = utf8_decode(str_replace('*', '&', str_replace('**', '?', $this->_unhtmlentities($_GET['kie_referimg']))));
 }
 // php mode
 else
 {
  $this->info['complete_referer'] = utf8_decode($this->_unhtmlentities($_SERVER['HTTP_REFERER']));
 }
 $temp = parse_url($this->info['complete_referer']);
 $return = $temp['host'].$temp['path'];
 // if short referent is set to TRUE, cutting the referent
 if ($this->short_referent == TRUE)
 {
  $return = dirname($return);
 }
 if ($this->info['mode'] == 'img' && empty($return))
 {
  return 'inconnu';
 }
 else if (empty($return))
 {
  return 'lien direct';
 }
 include $this->path.'inc/configsites.php';
 $maximum = count($kietu['liste_sites'][$this->info['id_sit']]);
 for ($i = 2; $i <= ($maximum-1); $i++)
 {
  $temp2 = parse_url($kietu['liste_sites'][$this->info['id_sit']][$i]);
  if ($temp['host'] == $temp2['host'])
  {
   $this->print_debug('Referent will be ignored because it is part of the excluded referent');
   return 'exclu';
  }
 }
 return substr($return, 0, 80);
}

// ----------------------------------------- //
// Function used to get engines and keywords //
// ----------------------------------------- //
function get_keywords()
{
 // checking if there is a referer
 if (empty($this->info['complete_referer']))
 {
  $this->print_debug('There is no referer => no keywords can be found');
 }
 elseif ($this->info['referent'] == 'inconnu' || $this->info['referent'] == 'lien direct' || $this->info['referent'] == 'unavailable')
 {
  $this->print_debug('Search engine won\'t be searched for');
 }
 else
 {
  // initializing
  $keywords = '';
  // exploding the potential keywords
  $temp = parse_url($this->info['complete_referer']);
  parse_str($temp['query'], $temp2);
  // including the definition page
  include $this->path.'define/engines.php';
  foreach ($kie['engines'] AS $key => $value)
  {
   if (eregi($key, $temp['host']))
   {
    // Potential engine
	if (is_array($value[1]))
    {
     while (list($key2,$value2) = each($value[1]))
     {
      if (isset($temp2[$value2]))
      {
	   $engine    = $value[0];
       $keywords .= $temp2[$value2].' ';
      }
     }
    }
    else
    {
     if (isset($temp2[$value[1]]))
     {
	  $engine   = $value[0];
      $keywords = $temp2[$value[1]];
     }
    }
   }
   // stopping if one or more keywords has been found
   if (!empty($keywords))
   {
    return array($engine, $keywords);
   }
  }
 }
 return FALSE;
}

// ------------------------------ //
// Saving datas into the database //
// ------------------------------ //
function save_datas()
{
 $this->print_debug('Sauvegarde des données');
 // including files
 include $this->path.'class/ksqllayer.class.php';
 include $this->path.'inc/config.php';
 // connexion to the database
 $connexion = new ksqllayer ($kietu['mysql_host'], $kietu['mysql_user'], $kietu['mysql_pass'], $kietu['mysql_database']);

 // checking if it is a new guest
 $connexion->query('UPDATE '.$kietu['mysql_prefixe'].'recent SET timestamp = '.$this->info['timestamp'].' WHERE id_sit = '.$this->info['id_sit'].' AND user_agent = \''.$this->info['user_agent'].'\' AND timestamp >= '.($this->info['timestamp']-$kietu['conf_tps_limite']*60).' AND ip = \''.$this->info['ip'].'\' LIMIT 1');
 if ($connexion->affected_rows() > 0)
 {
  // it is not a new guest
  $this->print_debug('Guest already known');

  // updating _visit
  $connexion->query('UPDATE '.$kietu['mysql_prefixe'].'visit SET nb_pag = nb_pag + 1 WHERE id_sit = '.$this->info['id_sit'].' AND date = \''.$this->info['date'].'\' AND os = \''.$this->info['os'].'\' AND nav = \''.$this->info['browser'].'\' AND nav_ver = \''.$this->info['browserversion'].'\' LIMIT 1');
  if ($connexion->affected_rows() == 0)
  {
   // this should never be executed according to the database structure and previous update
   $connexion->query('INSERT INTO '.$kietu['mysql_prefixe'].'visit (id_sit, date, os, nav, nav_ver, nb_pag, nb_vis) VALUES ('.$this->info['id_sit'].', \''.$this->info['date'].'\', \''.$this->info['os'].'\', \''.$this->info['browser'].'\', \''.$this->info['browserversion'].'\', 1, 1)');
  }

  // updating prefixe_heure
  $connexion->query('UPDATE '.$kietu['mysql_prefixe'].'heure SET nb_pag = nb_pag + 1 WHERE id_sit = '.$this->info['id_sit'].' AND date = \''.$this->info['date'].'\' AND heure = '.$this->info['hour'].' LIMIT 1');
  if ($connexion->affected_rows() == 0)
  {
   // this happens when the guess is browsing through 2 different hours
   $connexion->query('INSERT INTO '.$kietu['mysql_prefixe'].'heure (id_sit, date, heure, nb_pag, nb_vis) VALUES ('.$this->info['id_sit'].', \''.$this->info['date'].'\', '.$this->info['hour'].', 1, 0)');
  }

  // updating _pages
  $connexion->query('UPDATE '.$kietu['mysql_prefixe'].'pages SET nb = nb + 1 WHERE id_sit = '.$this->info['id_sit'].' AND date = \''.$this->info['date'].'\' AND page = \''.$this->info['page'].'\' LIMIT 1');
  if ($connexion->affected_rows() == 0)
  {
   $connexion->query('INSERT INTO '.$kietu['mysql_prefixe'].'pages (id_sit, date, page, nb) VALUES ('.$this->info['id_sit'].', \''.$this->info['date'].'\', \''.$this->info['page'].'\', 1)');
  }
 }
 else
 {
  // it is a new guest
  $this->print_debug('New guest');

  // inserting _recent for future visit
  $connexion->query('INSERT INTO '.$kietu['mysql_prefixe'].'recent (id_sit, timestamp, ip, user_agent) VALUES ('.$this->info['id_sit'].', '.$this->info['timestamp'].', \''.$this->info['ip'].'\', \''.$this->info['user_agent'].'\')');

  // updating _visit
  $connexion->query('UPDATE '.$kietu['mysql_prefixe'].'visit SET nb_pag = nb_pag + 1, nb_vis = nb_vis + 1 WHERE id_sit = '.$this->info['id_sit'].' AND date = \''.$this->info['date'].'\' AND os = \''.$this->info['os'].'\' AND nav = \''.$this->info['browser'].'\' AND nav_ver = \''.$this->info['browserversion'].'\' LIMIT 1');
  if ($connexion->affected_rows() == 0)
  {
   $connexion->query('INSERT INTO '.$kietu['mysql_prefixe'].'visit (id_sit, date, os, nav, nav_ver, nb_pag, nb_vis) VALUES ('.$this->info['id_sit'].', \''.$this->info['date'].'\', \''.$this->info['os'].'\', \''.$this->info['browser'].'\', \''.$this->info['browserversion'].'\', 1, 1)');
  }
 
  // updating _domai
  $connexion->query('UPDATE '.$kietu['mysql_prefixe'].'domai SET nb = nb + 1 WHERE id_sit = '.$this->info['id_sit'].' AND date = \''.$this->info['date'].'\' AND domain = \''.$this->info['domain'].'\' AND lang = \''.$this->info['lang'].'\' LIMIT 1');
  if ($connexion->affected_rows() == 0)
  {
   $connexion->query('INSERT INTO '.$kietu['mysql_prefixe'].'domai (id_sit, date, lang, domain, nb) VALUES ('.$this->info['id_sit'].', \''.$this->info['date'].'\', \''.$this->info['lang'].'\', \''.$this->info['domain'].'\', 1)');
  }
 
  // updating _heure
  $connexion->query('UPDATE '.$kietu['mysql_prefixe'].'heure SET nb_pag = nb_pag + 1, nb_vis = nb_vis +1 WHERE id_sit = '.$this->info['id_sit'].' AND date = \''.$this->info['date'].'\' AND heure = '.$this->info['hour'].' LIMIT 1');
  if ($connexion->affected_rows() <= 0)
  {
   $connexion->query('INSERT INTO '.$kietu['mysql_prefixe'].'heure (id_sit, date, heure, nb_pag, nb_vis) VALUES ('.$this->info['id_sit'].', \''.$this->info['date'].'\', '.$this->info['hour'].', 1, 1)');
  }

  // updating _pages
  $connexion->query('UPDATE '.$kietu['mysql_prefixe'].'pages SET nb = nb + 1 WHERE id_sit = '.$this->info['id_sit'].' AND date = \''.$this->info['date'].'\' AND page = \''.$this->info['page'].'\' LIMIT 1');
  if ($connexion->affected_rows() == 0)
  {
   $connexion->query('INSERT INTO '.$kietu['mysql_prefixe'].'pages (id_sit, date, page, nb) VALUES ('.$this->info['id_sit'].', \''.$this->info['date'].'\', \''.$this->info['page'].'\', 1)');
  }

  // updating _refer
  $connexion->query('UPDATE '.$kietu['mysql_prefixe'].'refer SET nb = nb + 1 WHERE id_sit = '.$this->info['id_sit'].' AND date = \''.$this->info['date'].'\' AND refer = \''.$this->info['referent'].'\' LIMIT 1');
  if ($connexion->affected_rows() == 0)
  {
   $connexion->query('INSERT INTO '.$kietu['mysql_prefixe'].'refer (id_sit, date, refer, nb) VALUES ('.$this->info['id_sit'].', \''.$this->info['date'].'\', \''.$this->info['referent'].'\', 1)');
  }

  // updating _keywords
  if ($this->info['keywords'])
  {
   $connexion->query('UPDATE '.$kietu['mysql_prefixe'].'keywords SET nb = nb + 1 WHERE id_sit = '.$this->info['id_sit'].' AND date = \''.$this->info['date'].'\' AND engine = \''.$this->info['keywords'][0].'\' AND keywords = \''.$this->info['keywords'][1].'\'LIMIT 1');
   if ($connexion->affected_rows() == 0)
   {
    $connexion->query('INSERT INTO '.$kietu['mysql_prefixe'].'keywords (id_sit, date, engine, keywords, nb) VALUES ('.$this->info['id_sit'].', \''.$this->info['date'].'\', \''.$this->info['keywords'][0].'\', \''.$this->info['keywords'][1].'\', 1)');
   }
  }
 }

 // emptying table _recent (it is not very important so this query is not launched at each guest)
 if (rand(0, 10) == 1)
 {
  $connexion->query('DELETE FROM '.$kietu['mysql_prefixe'].'recent WHERE timestamp <= '.($this->info['timestamp']-$kietu['conf_tps_limite']*60-86400));
 }

 // shutting down the connexion
 $connexion->close();
}

// ------------------------------------------------------------- //
// Function used to "wash" URLs, useful when PHP version < 4.3.0 //
// ------------------------------------------------------------- //
function _unhtmlentities($string)
{
 $trans_tbl = get_html_translation_table (HTML_ENTITIES);
 $trans_tbl = array_flip ($trans_tbl);
 return strtr ($string, $trans_tbl);
}

// ------------------------------------------------- //
// Function used to print datas when a problem occur //
// ------------------------------------------------- //
function print_debug($data)
{
 if ($this->debug == TRUE)
 {
  echo $data.'<br />';
 }
}
}
?>
