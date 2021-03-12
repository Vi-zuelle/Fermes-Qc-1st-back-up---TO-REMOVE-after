<?php
class ksqllayer
{
var $server;
var $user;
var $passwd;
var $dbname;
var $link;
var $nb_requetes;
var $affected = array();
var $debug = FALSE;

// ------------------ //
// Class' constructor //
// ------------------ //
function ksqllayer ($server = '', $user = '', $pass = '', $dbname = '')
{
 $this->server = $server;
 $this->user   = $user;
 $this->passwd = $pass;
 $this->dbname = $dbname;
 $this->connect();
}

// ---------------------------------- //
// Connecting  and selecting database //
// ---------------------------------- //
function connect()
{
 $this->link = @mysql_connect ($this->server, $this->user, $this->passwd);
 @mysql_select_db ($this->dbname, $this->link);
 $this->print_debug('Connexion réussie');
}

// ---------------- //
// Closing database //
// ---------------- //
function close()
{
 return @mysql_close($this->link);	
}

// ------------ //
// Send a query //
// ------------ //
function query($query)
{
 $this->nb_requetes += 1;
 $this->print_debug($this->nb_requetes.' - '.$query);
 $this->rs = mysql_query ($query, $this->link);
 if (!$this->rs)
 {
  echo('Error: Invalid query "'.$query.'"...<br />');
  echo('Error: '.mysql_errno().'<br />');
  die('Error: '.mysql_error().'<br />');
 }
 else
 {
  return $this->rs;
 }
}

// ------------------------ //
// Seek the pointer of $row //
// ------------------------ //
function data_seek($row = '')
{
 if ($row == '') $row = 0;
 mysql_data_seek ($rs, $row);
 return (true);
}

// ------------------------------------- //
// Return result in an associative array //
// ------------------------------------- //
function fetch_array($rs = '')
{
 if ($rs == '') $rs = $this->rs;
 $this->row = mysql_fetch_array ($rs, MYSQL_BOTH);
 return $this->row;
}

// ---------------------------------- //
// Return the number of rows selected //
// ---------------------------------- //
function num_rows($rs = '')
{
 if ($rs == '') $rs = $this->rs;
 return mysql_num_rows($rs);
}

// ---------------------------------- //
// Return the number of rows affected //
// ---------------------------------- //
function affected_rows()
{
 if (!isset($this->affected[$this->nb_requetes]))
 {
  $this->affected[$this->nb_requetes] = mysql_affected_rows();
 }
 return $this->affected[$this->nb_requetes];
}

// --------------- //
// Emptying memory //
// --------------- //
function free_result($rs = '')
{
 if ($rs == '') $rs = $this->rs;
 return mysql_free_result($rs);
}

// ------------------------------- //
// Function used in debugging mode //
// ------------------------------- //
function print_debug($data)
{
 if ($this->debug == TRUE)
 {
  echo $data.'<br />';
 }
}
}
?>
