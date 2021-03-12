<?php
class ktable
{
var $number_of_columns = 0;
var $number_of_lines   = 0;
var $cell              = array();
var $cell_fusion       = array();
var $title             = array();
var $title_fusion      = array();
var $available_sorting = array();
var $column_class      = array();
var $name              = 'nameofthetable';
var $_table_class      = '';

// ------------------ //
// Class' constructor //
// ------------------ //
function ktable()
{
 $this->number_of_columns = func_num_args();
 for ($j = 0; $j < $this->number_of_columns; $j++)
 {
  $this->title[$j] = func_get_arg($j);
  $this->column_class[$j] = 'center';
  $this->title_fusion[$j] = 1;
  $this->available_sorting[$j] = FALSE;
 }
}

// ---------------------------------------- //
// Function used tio give a name to a table //
// ---------------------------------------- //
function set_name($name)
{
 $this->name = $name;
}

// ------------- // 
// Merging cells //
// ------------- //
function merge_line()
{
 for ($j = 0; $j < func_num_args(); $j++)
 {
  $this->cell_fusion[$this->number_of_lines-1][$j] = func_get_arg($j);
 }
}

// ------------------ //
// Merging title line //
// ------------------ //
function merge_title()
{
 for ($j = 0; $j < $this->number_of_columns; $j++)
 {
  $this->title_fusion[$j] = func_get_arg($j);
 }
}

// -------------- //
// Ordering lines //
// -------------- //
function _order_line($num_colonne, $sens)
{
 if ($sens == 'up')
 {
  for ($i = 0; $i < $this->number_of_lines; $i++)
  {
   $this->_exchange_line($i, $this->_maximum($num_colonne, $i));
  }
 }
 else
 {
  for ($i = 0; $i < $this->number_of_lines; $i++)
  {
   $this->_exchange_line($i, $this->_minimum($num_colonne, $i));
  }
 }
}

// -------------------------- //
// Getting the smallest value //
// -------------------------- //
function _minimum($num_colonne, $debut)
{
 $i = $debut;
 for ($k = $debut+1; $k < $this->number_of_lines; $k++)
 {
  if ($this->cell[$i][$num_colonne] > $this->cell[$k][$num_colonne]) $i = $k;
 }
 return $i;
}

// ------------------------- //
// Getting the biggest value //
// ------------------------- //
function _maximum($num_colonne, $debut)
{
 $i = $debut;
 for ($k = $debut+1; $k < $this->number_of_lines; $k++)
 {
  if ($this->cell[$i][$num_colonne] < $this->cell[$k][$num_colonne]) $i = $k;
 }
 return $i;
}

// ------------------------------- //
// Function used to exchange lines //
// ------------------------------- //
function _exchange_line($num1, $num2)
{
 for ($j = 0; $j < $this->number_of_columns; $j++)
 {
  $temp = $this->cell[$num1][$j];
  $this->cell[$num1][$j] = $this->cell[$num2][$j];
  $this->cell[$num2][$j] = $temp;
  $temp = $this->cell_fusion[$num1][$j];
  $this->cell_fusion[$num1][$j] = $this->cell_fusion[$num2][$j];
  $this->cell_fusion[$num2][$j] = $temp;
 }
}

// ----------------------------- //
// Adding new line with contents //
// ----------------------------- //
function add_line()
{
 for ($j = 0; $j < func_num_args(); $j++)
 {
  $this->cell[$this->number_of_lines][$j] = func_get_arg($j);
  $this->cell_fusion[$this->number_of_lines][$j] = 1;
 }
 $this->number_of_lines += 1;
}

// ---------------- //
// Returns the code //
// ---------------- //
function show()
{
 // sort table before outputting
 if ($_SESSION['kie_tri'] == $this->name)
 {
  $this->_order_line($_SESSION['kie_champ'], $_SESSION['kie_sens']);
 }
 if (empty($this->_table_class))
 {
  $output  = '<table>'."\n";
 }
 else
 {
  $output  = '<table class="'.$this->_table_class.'">'."\n";
 }
 $output .= ' <tr>'."\n";
 // output of the title line
 for ($j = 0; $j < $this->number_of_columns; $j += $this->title_fusion[$j])
 {
  if ($this->title_fusion[$j] == 1)
  {
   $output .= '  <th>'.$this->title[$j].'</th>'."\n";
  }
  elseif ($this->title_fusion[$j] == 0)
  {
   $j += 1;
  }
  else
  {
   $output .= '  <th colspan="'.$this->title_fusion[$j].'">'.$this->title[$j].'</th>'."\n";
  }
 }
 $output .= ' </tr>'."\n";
 if ($this->number_of_lines == 0)
 {
  $output .= ' <tr class="impair">'."\n";
  $output .= '  <td class="'.$this->column_class[0].'" colspan="'.$this->number_of_columns.'">Aucune donnée à afficher</td>'."\n";
  $output .= ' </tr>'."\n";
  $output .= '</table>'."\n";
 }
 else
 {
  $parite = 'pair';
  // output of the different lines
  for ($i = 0; $i < $this->number_of_lines; $i++)
  {
   // alternate lines
   if ($parite == 'impair')
   {
    $parite = 'pair';
   }
   else
   {
    $parite = 'impair';
   }
   $output .= ' <tr class="'.$parite.'">'."\n";
   // output of the different cells of the current line
   for ($j = 0; $j < $this->number_of_columns; $j += $this->cell_fusion[$i][$j])
   {
    if ($this->cell_fusion[$i][$j] == 1)
	{
	 $output .= '  <td class="'.$this->column_class[$j].'">'.$this->cell[$i][$j].'</td>'."\n";
	}
    elseif ($this->cell_fusion[$i][$j] == 0)
	{
	 $j += 1;
	}
    else
	{
	 $output .= '  <td  class="'.$this->column_class[$j].'" colspan="'.$this->cell_fusion[$i][$j].'">'.$this->cell[$i][$j].'</td>'."\n";
	}
   }
   $output .= ' </tr>'."\n";
  }
  $output .= '</table>'."\n";
  // output of the link used to sort the different columns
  $output .= '<p class="tri">'."\n";
  for ($k = 0; $k < $this->number_of_columns; $k++)
  {
   if ($this->available_sorting[$k] == TRUE)
   {
    $output .= KLN_TRI.' « '.$this->title[$k].' » : <a href="?kie_action='.$_SESSION['kie_action'].'&amp;kie_tri='.$this->name.'&amp;kie_champ='.$k.'&amp;kie_sens=up">DESC</a> - <a href="?kie_action='.$_SESSION['kie_action'].'&amp;kie_tri='.$this->name.'&amp;kie_champ='.$k.'&amp;kie_sens=down">ASC</a><br />';
   }
  }
  $output .= '</p>';
 }
 return $output;
}

// ------------------------------------------ //
// Setting the class of the different columns //
// ------------------------------------------ //
function set_class()
{
 for ($j = 0; $j < $this->number_of_columns; $j++)
 {
  $this->column_class[$j] = func_get_arg($j);
 }
}
 
 // ---------------------------------------------- //
 // Setting column by column if sorting is allowed //
 // ---------------------------------------------- //
function set_tri()
{
 for ($j = 0; $j < $this->number_of_columns; $j++)
 {
  $this->available_sorting[$j] = func_get_arg($j);
 }
}

// -------------------------- //
// Setting up the table class //
// -------------------------- //
function set_table_class($class)
{
 $this->_table_class = $class;
}
}
?>
