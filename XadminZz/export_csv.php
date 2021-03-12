<?php
include("../connexion.php");

	
/***** EDIT BELOW LINES *****/
$DB_TBLName = "concour"; // MySQL Table Name
$xls_filename = 'export_'.date('Y-m-d').'.csv'; // Define Excel (.xls) file name
 
/***** DO NOT EDIT BELOW LINES *****/
// Create MySQL connection
$sql = "Select * from $DB_TBLName";
// Select database
// Execute query
$result = mysql_query($sql) or die("Failed to execute query:<br />" . mysql_error(). "<br />" . mysql_errno());
 
// Header info settings
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$xls_filename");
header("Pragma: no-cache");
header("Expires: 0");
 
/***** Start of Formatting for Excel *****/
// Define separator (defines columns in excel &amp; tabs in word)
$sep = ";"; // tabbed character
 
// Start of printing column names as names of MySQL fields
//for ($i = 0; $i<mysql_num_fields($result); $i++) {
//  echo mysql_field_name($result, $i) . "\t";
//}
//print("\n");
// End of printing column names
 
// Start while loop to get data
while($row = mysql_fetch_row($result))
{
  $schema_insert = "";
  for($j=0; $j<mysql_num_fields($result); $j++)
  {
    if(!isset($row[$j])) {
      $schema_insert .= "".$sep;
    }
    elseif ($row[$j] != "") {
      $schema_insert .= $row[$j]."".$sep;
    }
    else {
      $schema_insert .= "".$sep;
    }
  }
  $schema_insert = str_replace($sep."$", "", $schema_insert);
  $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", "", $schema_insert);
  $schema_insert .= "\t";
  print(trim($schema_insert));
  print "\n";
}
?>