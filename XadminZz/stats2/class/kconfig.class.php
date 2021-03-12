<?php
## :bug: is_bool ne fonctionne pas correctement dans $this->_array2PHP()
/*
function write_data()
	{
		if (!$this->_check_file())
		{
			$this->error('Couldnot open file '.$this->filename.' for writing.');
			return FALSE;
		}
		
		$store = serialize($this->data);
		$this->fp = fopen($this->filename, 'w');
		fwrite($this->fp, $store);
		fclose($this->fp);
	} 
    
    	function _check_file()
	{
		if (!file_exists($this->filename))
				if(!$this->fp = fopen($this->filename, 'w'))
						return FALSE;
				else
						fclose($this->fp);
		return TRUE;
	}
*/
class kconfigfile
{
 var $fichier;
 var $nb_ligne;
 var $lignes = array();
 var $infos  = array(); // $this->infos[$key] = $valeur
 var $fp;
 
 function kconfigfile($fichier)
 {
  $this->fichier = $fichier;
  return $this->_init();
 }
 
 function _init()
 {
  if (!$this->_check_file())
  {
   return false;
  }
  $this->lignes = file($this->fichier);
  $this->nb_ligne = count($this->lignes);
  for ($i = 0; $i < $this->nb_ligne; $i++)
  {
   if (ereg('^[$].+;', $this->lignes[$i]))
   {
    $equal_pos = strpos($this->lignes[$i], '=');
    $semicolon_pos = strrpos($this->lignes[$i], ';');
    $value = trim(substr($this->lignes[$i], $equal_pos+1, $semicolon_pos - $equal_pos - 1));
    if (strpos($value, '"') === 0 || strpos($value, '\'') === 0)
    {
     $value = substr($value, 1, strlen($value)-2);
    }
    $key = trim(substr($this->lignes[$i], 1, $equal_pos-1));
    $this->change($key, $value);
   }
  }
  return true;
 }

 function _check_file()
 {
  if (!file_exists($this->fichier))
  {
   if(!$this->fp = fopen($this->fichier, 'w'))
   {
    return false;
   }
   else
   {
    fclose($this->fp);
   }
  }
  return true;
 }

 function change($key, $value)
 {
  $this->infos[$key] = $value;
 }

 // inspirée de Nicolas Bigot - phpinfo.net
 function _array2PHP($myarray, $tabcount = 1)
 {
  if (is_array($myarray))
  {
   while ($ptr = each ($myarray))
   {
    if (strlen($res)) $res .= ",\n"; 
    for ($i = 0; $i < $tabcount; $i++) $res .= "\t";
    $res .= "'".addslashes($ptr[0])."' => ";
    if (is_array($ptr[1])) $res .= $this->_array2PHP($ptr[1], $tabcount + 1);
    elseif (is_bool($ptr[1])) $res .= $ptr[1];
    elseif (is_string($ptr[1])) $res .= "'".addslashes($ptr[1])."'";
    elseif (is_numeric($ptr[1])) $res .= $ptr[1];
    elseif (is_null($ptr[1])) $res .= 'NULL';
    else $res .= "#UnknowType"; 
   }
   return "array(\n".$res.")";
  }
  else
  {
   if (is_bool($myarray)) return $myarray;
   elseif (is_string($myarray)) return "'".addslashes($myarray)."'";
   elseif (is_numeric($myarray)) return $myarray;
   elseif (is_null($myarray)) return 'NULL';
   else return "#UnknowType";
  } 
 }


 function valeur($key)
 {
  if (isset($this->infos[$key]))
  {
   return $this->infos[$key];
  }
  else
  {
   return false;
  }
 }
 
 function delete($key)
 {
  unset($this->infos[$key]);
  return true;
 }
 
 function save()
 {
  if (!$this->_check_file())
  {
   return false;
  }
  $this->fp = fopen($this->fichier, 'w');
  $contenu = '<?php'."\n";
  foreach ($this->infos as $key => $value)
  {
   $contenu .= '$'.$key.' = '.$this->_array2PHP($value).';'."\n";
  }
  $contenu .= '?>';
  fwrite($this->fp, $contenu);
  fclose($this->fp);
  return true;
 }
}
?>
