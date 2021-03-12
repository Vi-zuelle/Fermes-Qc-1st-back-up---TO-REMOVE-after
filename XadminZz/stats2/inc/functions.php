<?php
function kie_annual_value($i, $j, $type)
{
 global $kie;
 if ($i > 1)
 {
  $ilastday = $i-1;
  $jlastday = $j;
 }
 else
 {
  if ($j == 0)
  {
   $ilastday = $i;
   $jlastday = $j;
  }
  else
  {
   $ilastday = date('d', mktime(0, 0, 0, $j+$kie['startmonth'], $i-1, $kie['startyear']));
   $jlastday = $j-1;
  }
 }
 if (strlen($ilastday) < 2) { $ilastday = 0 . $ilastday; }
 if ($kie['temp2'][$j][$i][$type] < $kie['temp2'][$jlastday][$ilastday][$type])
 {
  return '<em class="red">'.$kie['temp2'][$j][$i][$type].'</em>';
 }
 else if ($kie['temp2'][$j][$i][$type] < $kie['temp2'][$jlastday][$ilastday][$type])
 {
  return $kie['temp2'][$j][$i][$type];
 }
 else
 {
  return '<em class="green">'.$kie['temp2'][$j][$i][$type].'</em>';
 }
}


function kie_image($rep, $nom, $extension)
{
 if (file_exists('media/'.$rep.'/'.$nom.'.'.$extension))
 {
  return '<img src="media/'.$rep.'/'.$nom.'.'.$extension.'" />';
 }
 else
 {
  return '&nbsp;';
 }
}
/*
function kie_hexcolor_pcent($valeur = 0, $minimum, $maximum)
{
 if ($valeur <= 0.9 * $minimum + 0.1 * $maximum)
 {
  $rouge = '00';
  $vert = 'ff';
 }
 else if ($valeur >= 0.1 * $minimum + 0.9 * $maximum)
 {
  $rouge = 'ff';
  $vert = '00';
 }
 else if ($valeur <= 0.5 * ($maximum + $minimum))
 {
  $rouge = dechex(round(255 / (0.4*$minimum - 0.4*$maximum) * (-$valeur + 0.9*$minimum + 0.1*$maximum)));
  $vert = 'ff';
 }
 else
 {
  $rouge = 'ff';
  $vert = dechex(round(255 / (0.4*$maximum - 0.4*$minimum) * (-$valeur + 0.1*$minimum + 0.9*$maximum)));
 }
 if (strlen($rouge) < 2) $rouge = '0'.$rouge;
 if (strlen($vert) < 2) $vert = '0'.$vert;
 return $rouge.$vert.'00';
}*/

function kie_img_percent($nombre, $total, $max, $style = 1, $carre_menu = false)
{
 $longueur = 200;
 if ($carre_menu == true)
 {
  return ' <img src="media/bar.gif" class="bar'.$style.'" height="7" width="7">';
 }
 else
 {
  if ($total == 0)
  {
   $percent = 0;
   $width = 1;
  }
  else
  {
   $percent = round($nombre / $total * 100, 1);
   $width = 1 + round($nombre * $longueur / $max, 0);
  }
  return '<img src="media/bar.gif" class="bar'.$style.'" height="7" width="'.$width.'">&nbsp;'.$percent.' %';
 }
}

function PMA_formatByteDown($value, $limes = 3, $comma = 1)
{
 $byteUnits = array('Octets', 'Ko', 'Mo', 'Go');
 $dh           = pow(10, $comma);
 $li           = pow(10, $limes);
 $return_value = $value;
 $unit         = $byteUnits[0];

 if ($value >= $li*1000000)
 {
  $value = round($value/(1073741824/$dh))/$dh;
  $unit  = $byteUnits[3];
 }
 else if ($value >= $li*1000)
 {
  $value = round($value/(1048576/$dh))/$dh;
  $unit  = $byteUnits[2];
 }
 else if ($value >= $li)
 {
  $value = round($value/(1024/$dh))/$dh;
  $unit  = $byteUnits[1];
 }
 if ($unit != $byteUnits[0])
 {
  $return_value = number_format($value, $comma, ',', ' ');
 }
 else
 {
  $return_value = number_format($value, 0, ',', ' ');
 }

 return $return_value.' '.$unit;
}

function get_time()
{
 $mtime=microtime();
 $mtime=explode(" ",$mtime);
 $mtime=$mtime[1]+$mtime[0];
 return($mtime);
}
?>
