<?php
class kmaps
{
var $_urloriginalimage = '';
var $_urlfinalimage    = '';
var $_image            = null;
var $_width            = 0;
var $_height           = 0;
// transparency of small flage
var $_transparency     = 80;
var $_activemap        = FALSE;
var $_area             = array();
var $_href             = '';

// ------------------ //
// Class' constructor //
// ------------------ // 
function kmaps($originalimage, $finalimage = '')
{
 if (!empty($finalimage))
 {
  $this->_image = imagecreatefrompng($originalimage);
  $this->_urlfinalimage = $finalimage;
 }
 else
 {
  $this->_urlfinalimage = $this->_urloriginalimage;
 }
 $this->_urloriginalimage = $originalimage;
 $size = getimagesize($originalimage);
 $this->_width  = $size[0];
 $this->_height = $size[1];
}

// -------------------------------- //
// saving image into _urlfinalimage //
// -------------------------------- //
function _create_image()
{
 imagepng($this->_image, $this->_urlfinalimage);
}

// -------------------- //
// Return the HTML code //
// -------------------- //
function show_html()
{
 if ($this->_urlfinalimage <> $this->_urloriginalimage)
 {
  $this->_create_image();
 }
 $output = '<p>';
 if ($this->_activemap == TRUE)
 {
  $output .= '<map id="maptouse" name="maptouse">'."\n";
  foreach ($this->_area AS $value)
  {
   $output .= '<area shape="'.$value[0].'" coords="'.$value[1].'" href="'.$value[2].'" alt="'.$value[3].'" />'."\n";
  }
  $output .= '</map>'."\n";
 }
 if (!empty($this->_href))
 {
  $output .= '<a href="'.$this->_href.'">';
 }
 $output .= '<img src="'.$this->_urlfinalimage.'"';
 if ($this->_activemap == TRUE)
 {
  $output .= ' usemap="#maptouse"';
 }
 $output .= ' />';
 if (!empty($this->_href))
 {
  $output .= '</a>';
 }
 $output .= '</p>';
 return $output;
}

// -------------------------- //
// Color areas ant add a flag //
// -------------------------- //
function colorfromarray($arraytocolor, $percentage, $ip = '')
{
 if (is_array($arraytocolor))
 {
  $color = $this->_get_color($percentage);
  if (is_array($arraytocolor[0]))
  {
   foreach ($arraytocolor AS $value)
   {
    imagefill($this->_image, $value[0], $value[1], $color);
   }
   if (is_file('media/flags/'.$ip.'.png'))
   {
    imagecopymerge($this->_image, imagecreatefrompng('media/flags/'.$ip.'.png'), $arraytocolor[0][0]-7, $arraytocolor[0][1]-7, 0, 0, 14, 14, $this->_transparency);
   }
  }
  else
  {
   imagefill($this->_image, $arraytocolor[0], $arraytocolor[1], $color);
   if (is_file('media/flags/'.$ip.'.png'))
   {
    imagecopymerge($this->_image, imagecreatefrompng('media/flags/'.$ip.'.png'), $arraytocolor[0]-7, $arraytocolor[1]-7, 0, 0, 14, 14, $this->_transparency);
   }
  }
 }
}

// -------------------------------------------- //
// Return the color according to the percentage //
// -------------------------------------------- //
function _get_color($percentage)
{
 $red   = 255;
 if ($percentage <= 10)
 {
  $green = 255;
  $blue = round(-165/30*($percentage-30));
 }
 else if ($percentage >= 30)
 {
  $green = round(255/99*(100-$percentage));
  $blue = 0;
 }
 else
 {
  $green = round(255/99*(100-$percentage));
  $blue = round(-165/30*($percentage-30));
 }
 return imagecolorallocate($this->_image, $red, $green, $blue);
}

// ------------------------------------ //
// Activate the HTML map and add coords //
// ------------------------------------ //
function add_area($shape, $coords, $href, $alt)
{
 $this->_activemap = TRUE;
 $this->_area[]    = array($shape, $coords, $href, $alt);
}

// ---------- //
// Add a link //
// ---------- //
function modify_a($href)
{
 $this->_href = $href;
}
}
?>
