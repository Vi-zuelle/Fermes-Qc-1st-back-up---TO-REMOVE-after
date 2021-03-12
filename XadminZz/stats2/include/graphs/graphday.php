<?
require("../../../stats/include/jpgraph/jpgraph.php"); 
require("../../../stats/include/jpgraph/jpgraph_line.php"); 
require("../../../stats/include/jpgraph/jpgraph_bar.php");

function ReturnDaySer($Year, $Month)
{
	if (file_exists("./../../log/__tday.ser"))
	{
		$fd = fopen ("./../../log/__tday.ser", "r");
		$contents = fread ($fd, filesize("./../../log/__tday.ser"));
		fclose ($fd);
		
		$tdata = unserialize($contents);
		$data["count"] = $tdata;
	}	

	if (file_exists("./../../log/__twithreferer.ser"))
	{
		$fd = fopen ("./../../log/__twithreferer.ser", "r");
		$contents = fread ($fd, filesize("./../../log/__twithreferer.ser"));
		fclose ($fd);
		
		$tdata = unserialize($contents);
		$data["countwithref"] = $tdata;
	}	

	if (file_exists("./../../log/__twithoutreferer.ser"))
	{
		$fd = fopen ("./../../log/__twithoutreferer.ser", "r");
		$contents = fread ($fd, filesize("./../../log/__twithoutreferer.ser"));
		fclose ($fd);
		
		$tdata = unserialize($contents);
		$data["countwithoutref"] = $tdata;
	}	

	return $data;
}

$tres = ReturnDaySer($_GET["Year"], $_GET["Month"]);
//var_dump($tres["countwithref"][20030216]);
$res = array();
for ($i = 1; $i < 32; $i++)
{
	if ($i < 10)
		$i = "0" . $i;
			
	if ($tres["count"][$_GET["Year"].$_GET["Month"].$i] == null)
		$res[] = 0;
	else
		$res[] = $tres["count"][$_GET["Year"].$_GET["Month"].$i];

	if ($tres["countwithref"][$_GET["Year"].$_GET["Month"].$i] == null)
		$res1[] = 0;
	else
		$res1[] = $tres["countwithref"][$_GET["Year"].$_GET["Month"].$i];

	if ($tres["countwithoutref"][$_GET["Year"].$_GET["Month"].$i] == null)
		$res2[] = 0;
	else
		$res2[] = $tres["countwithoutref"][$_GET["Year"].$_GET["Month"].$i];
}

$graph = new Graph(300,200);
$graph->SetFrame(true); // No border around the graph
$graph->SetScale("lin");
$graph->SetShadow();

if (!empty($res))
{
	$dplot[0] = new LinePLot($res);
	$dplot[0]->SetColor('green');
	$graph->Add($dplot[0]);
}

if (!empty($res1))
{
	$dplot[1] = new LinePLot($res1);
	$dplot[1]->SetColor('red');
	$graph->Add($dplot[1]);
}

if (!empty($res2))
{
	$dplot[2] = new LinePLot($res2);
	$dplot[2]->SetColor('blue');
	$graph->Add($dplot[2]);
}

$graph->img->SetAntiAliasing(); 
$graph->Stroke();
?>