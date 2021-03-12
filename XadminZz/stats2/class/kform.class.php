<?php
class kform
{
 var $_method = '';
 var $_action = '';
 var $_fieldset = array(); //contient le nom & les champs associés à chaque fieldset
 var $_numberoffieldset = 0; //nombre de fieldset
 var $_numberoffield = 0; // nombre de champ
 var $_field  = array(); // tableau contenant id, type, label & contenu
 
 function kform($action = '', $method = 'post')
 {
  $this->_action = $action;
  $this->_method = $method;
 }
 
 function add_field($id, $type, $label, $contents, $fieldset)
 {
  $this->_numberoffield += 1;
  $this->_fieldset[$fieldset][] = $this->_numberoffield;
  $this->_field[$this->_numberoffield] = array($id, $type, $label, $contents);
 }
 
 function add_fieldset($name)
 {
  $this->_fieldset[$this->_numberoffieldset][0] = $name;
  $this->_numberoffieldset += 1;
 }
 
 function _returnfield($array)
 {
  $output2 = '<label for="'.$array[0].'">'.$array[2].' :</label>'."\n";
  if ($array[1] == 'text')
  {
   $output2 .=  '<input type="text" id="'.$array[0].'" name="'.$array[0].'" value="'.$array[3].'" /><br />'."\n";
  }
  elseif ($array[1] == 'password')
  {
   $output2 .=  '<input type="password" id="'.$array[0].'" name="'.$array[0].'" value="'.$array[3].'" /><br />'."\n";
  }
  elseif ($array[1] == 'radio')
  {
   foreach ($array[3][0] as $key2 => $value2)
   {
    $output2 .= ' <input type="radio" ';
    $output2 .= ($array[3][1] == $key2) ? 'checked="checked" ' : '';
    $output2 .= 'name="'.$array[0].'"  id="'.$array[0].'" value="'.$key2.'" />'.$value2.' '."\n";
   }
   $output2 .= '<br />'."\n";
  }
  elseif ($array[1] == 'select')
  {
   $output2 .= ' <select id="'.$array[0].'" name="'.$array[0].'" >'."\n";
   foreach ($array[3][0] as $key2 => $value2)
   {
    $output2 .= '  <option value="'.$key2.'"';
    $output2 .= ($array[3][1] == $key2) ? ' selected="selected"' : '';
    $output2 .= '>'.$value2.'</option>'."\n";
   }
   $output2 .= ' </select><br />'."\n";
  }
  elseif ($array[1] == 'textarea')
  {
   $output2 .= ' <textarea id="'.$array[0].'" name="'.$array[0].'">'.$array[3].'</textarea><br />'."\n";
  }
  return $output2;
 }

 function show()
 {
  $output = '';
  if (!empty($this->_action))
  {
   $output = '<form method="'.$this->_method.'" action="'.$this->_action.'">'."\n";
  }
  foreach ($this->_fieldset as $key => $value)
  {
   $output .= "<fieldset>\n";
   if (!empty($value[0])) $output .= '<legend>'.$value[0].'</legend>'."\n";
   for ($i = 1; $i < count($value); $i++)
   {
    $output .= $this->_returnfield($this->_field[$value[$i]]);
   }
   $output .= "</fieldset>\n";
  }
  if (!empty($this->_action))
  {
   $output .= ' <button type="reset">'.KLN_UNDO.'</button> <button type="submit">'.KLN_OK.'</button>'."\n";
   $output .= '</form>';
  }
  return $output;
 }
}
?>
