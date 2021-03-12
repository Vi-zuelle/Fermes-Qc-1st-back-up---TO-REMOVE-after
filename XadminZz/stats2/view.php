<html>
<head>
<link rel="stylesheet" href="resources/style.css">
</head>
<body>
<?
function GetTime($interval)
{
	if ($interval > 3600)
		$time = date("H:i:s", $interval);
	else
		$time = date("00:i:s", $interval);

	return $time;
}
	
if (file_exists("./log/" . $_GET["date"] . ".dlog"))
{
	$fd = fopen ("./log/" . $_GET["date"] . ".dlog", "r");
	$contents = fread($fd, filesize("./log/" . $_GET["date"] . ".dlog"));
	fclose ($fd);

	$contents = explode("\n", $contents);
	for ($i = 0; $i < count($contents); $i++)
	{
		ereg('[0-9]{10}',$contents[$i], $part); 
		if ($_GET["file"] == $part[0])
		{
			$detail = explode("|", $contents[$i]);
			break;
		}
	}	
//	$detail = explode("|", $contents[0]);
	?>
	<img src='resources/images/surfdetail.gif'>
	<table border='0' cellspacing='1' cellpadding='0' width='100%' bgcolor='000000'>
		<tr>
			<td bgcolor='8586A5'><font class='normalblack'>Start time :</font></td>
			<td bgcolor='ffffee' width='80%'><font class='normalblack'>&nbsp;<?= GetTime($detail[0]) ?></font></td>
		</tr>
		<tr>	
			<td bgcolor='8586A5'><font class='normalblack'>IP Adress :</font></td>
			<td bgcolor='ffffee'><font class='normalblack'>&nbsp;<?= $detail[1] ?></font></td>
		</tr>
		<tr>	
			<td bgcolor='8586A5'><font class='normalblack'>HOST Adress :</font></td>
			<td bgcolor='ffffee'><font class='normalblack'>&nbsp;<?= $detail[2] ?></font></td>
		</tr>
		<tr>	
			<td bgcolor='8586A5'><font class='normalblack'>Referer Site :</font></td>
			<td bgcolor='ffffee'><font class='normalblack'>&nbsp;<a href='<?= $detail[3] ?>' target='_blank' class='small'><?= $detail[3] ?></a></font></td>
		</tr>
		<tr>	
			<td bgcolor='8586A5'><font class='normalblack'>Client :</font></td>
			<td bgcolor='ffffee'><font class='normalblack'>&nbsp;<?= $detail[4] ?></font></td>
		</tr>
	</table>
	<br><br>		
	<?

	echo "<table border='0' cellspacing='1' cellpadding='0' bgcolor='000000' width='60%'>";
	echo "<tr class='normalblack' bgcolor='#8586A5'><td>Time</td><td>Pages view</td><td>referer</td></tr>";
	
	$flag = 0;
	for ($i = 0; $i < count($contents); $i++)
	{
		ereg('[0-9]{10}',$contents[$i], $part); 
		if ($_GET["file"] == $part[0] && !empty($contents[$i]))
			$tLog[] = $contents[$i];
	}
	
	for ($i = 0; $i < count($tLog); $i++)
	{
		if ($flag == 1)
		{
			$flag = 0;
			$bgcolor='ffffee';
		}
		else
		{
			$flag = 1;
			$bgcolor='CDCEDC';
		}
		
		$detail = explode("|", $tLog[$i]);
		$detail2 = explode("|", $tLog[$i + 1]);

		if ($detail[0] > (3600*12))
			$start = 0;
		else
			$start = $detail[0];

		$end = $detail2[0];

		if (empty($end))
			$time = 0;
		else				
			$time = ($end - $start);

		if ($contents[$i] != "")
		{
			$cumul += $time; 
			echo "<tr bgcolor='$bgcolor'><td width='5%'><font class='normalblack'>&nbsp;" . GetTime($time) . "</font></td><td width='40%'><font class='normalblack'>&nbsp;$detail[5]</font></td><td width='55%'><font class='normalblack'>&nbsp;<a href='$detail[3]' target='_blank' class='small'>$detail[3]</a></font></td></tr>";			
		}
	}
	echo "<tr bgcolor='ffffff'><td colspan='3'>&nbsp;</td></tr>";
	echo "<tr bgcolor='ffffff'><td colspan='3'><font class='normalblack'>Time of connexion = " . GetTime($cumul) ."</font></td></tr>";
	echo "</table>";
}
?>
</body>
</html>