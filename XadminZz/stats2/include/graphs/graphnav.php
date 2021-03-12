<?php
include ("../../../stats/include/jpgraph/jpgraph.php");
include ("../../../stats/include/jpgraph/jpgraph_pie.php");
include ("../../../stats/include/jpgraph/jpgraph_pie3d.php");

function ReturnBrowserSer($Year, $Month)
{
	$File = "./../../log/__tbrowser.ser";
	if (file_exists($File))
	{
		$fd = fopen ($File, "r");
		$contents = fread ($fd, filesize($File));
		fclose ($fd);
		
		$tdata = unserialize($contents);
		$data = $tdata;
		return $data;
	}	
}

$tres = ReturnBrowserSer($_GET["Year"], $_GET["Month"]);
foreach($tres as $key => $value)
{
	if (preg_match ("/opera/i", $key)) 
		$td["Opera"] += $value;
	elseif (preg_match ("/Mac/i", $key)) 
		$td["IE Mac"] += $value;
	elseif (preg_match ("/MSIE/i", $key)) 
		$td["MSIE"] += $value;
	elseif (preg_match ("/Mozilla/i", $key)) 
		$td["Mozilla"] += $value;
}

foreach($td as $key => $value)
{
	$tnb[] = $value;
	$name[] = $key; 
}

// Some data
$data = array(5,27,45,75,90, 12, 14);

// Create the Pie Graph.
$graph = new PieGraph(350,200,"auto");
$graph->SetShadow();

// Create pie plot
$p1 = new PiePlot3d($tnb);
$p1->SetTheme("sand");
$p1->SetCenter(0.4);
$p1->SetAngle(30);
$p1->SetLegends($name);

$graph->Add($p1);
$graph->img->SetAntiAliasing(); 
$graph->Stroke();

?>


