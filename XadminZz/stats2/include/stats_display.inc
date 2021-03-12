<?
require("../../stats/include/./include/stats_main.inc");

Class Stats_Display extends process
{
	function Stats_Display($Graph = true)
	{
		$this->Process();
	}

	function DisplayAll($Graph = true, $Year, $Month, $Day)
	{
		?>
			<table border='0' width='100%' cellspacing='0' cellpadding='0'>
				<tr>
					<td valign='top'>
						<table border='0' cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td width='70%' valign='top' align='center'>
								<font class='normalblack'><b>Details</b></font><br>
										<?= $this->DisplayDetailDay($Year, $Month, $Day)?>
									<table border='0' cellspacing='0' cellpadding='0' width='100%'>
										<tr>
											<td colspan='5' align='center' valign='top'><font class='normalblack'><b>Top 10</b></font></td>
										</tr>
										<tr>
											<td valign='top'><?= $this->DisplayTopHost($Year,$Month) ?></td>
											<td valign='top'>&nbsp;</td>
											<td valign='top'><?= $this->DisplayTopReferer($Year, $Month) ?><br></td>
											<td valign='top'>&nbsp;</td>
											<td valign='top'><?= $this->DisplayTopPage($Year, $Month) ?></td>
										</tr>
									</table><br>	
									<table border='0' cellspacing='0' cellpadding='0' width='100%'>
										<tr>	
											<td valign='top'><?= $this->DisplayTopCountry($Year, $Month) ?><br></td>
											<td valign='top' width='100%'>&nbsp;</td>
										</tr>
									</table>
								</td>
								<?if ($Graph == "true")
								{
									?>
								<td>&nbsp;</td>
								<td valign='top'>
								<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='000000'>
									<tr bgcolor='ffffff'>
										<td align='center' width='100%'><font class='normalblack'><b>Visit per Day on <b><?= $this->ReturnMonth($Month) ?></b></font></td>
									</tr>
									<tr bgcolor='ffffff'>
										<td align='center'><? echo "<img src='./include/graphs/graphday.php?Year=$Year&Month=$Month&Day=$Day' border=0 align=center width=300 height=200>"; ?></td>
									</tr>
								</table>
								<table border='0' cellspacing='1' cellpadding='0' bgcolor='000000' width='100%'>
									<tr><td bgcolor='green' class='smallwhite'>  </td><td class='smallwhite' width='30%'>:  All</td>
										<td bgcolor='red' class='smallwhite'>  </td><td class='smallwhite' width='30%'>:  With Referer</td>
										<td bgcolor='blue' class='smallwhite'>  </td><td class='smallwhite' width='30%'>:  WithOut Referer</td></tr>
								</table>
								<a href="#" onclick="ToggleDisplay(Daybutton, layerMore)" class='small2'><img src="../../stats/include/./resources/images/iconMoins.gif" id="Daybutton" border="0" align='left'><b>More Graphics</b></b></a>
								<div id='layerMore'>
								<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='000000'>
									<tr bgcolor='ffffff'>
										<td align='center' width='100%'><font class='normalblack'><b>Visit per Hour</b></font></td>
									</tr>
									<tr bgcolor='ffffff'>
										<td align='center'><? echo "<img src='./include/graphs/graphour.php?Year=$Year&Month=$Month&Day=$Day' border=0 align=center width=300 height=200>"; ?></td>
									</tr>
								</table>
								<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='000000'>
									<tr bgcolor='ffffff'>
										<td align='center' width='100%'><font class='normalblack'>Best Browser</b></font></td>
									</tr>
									<tr bgcolor='ffffff'>
										<td align='center'><? echo "<img src='./include/graphs/graphnav.php?Year=$Year&Month=$Month&Day=$Day' border=0 align=center width=300 height=200>"; ?></td>
									</tr>
								</table>
								<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='000000'>
									<tr bgcolor='ffffff'>
										<td align='center' width='100%' colspan='2'><font class='normalblack'>Connexion on <b><?= $Year ?></b></font></td>
									</tr>
									<tr bgcolor='ffffff'>
										<td colspan='2' align='center'><? echo "<img src='./include/graphs/graphyear.php?Year=$Year' border=0 align=center width=300 height=200>"; ?></td>
									</tr>
								</table>
								<table border='0' cellspacing='1' cellpadding='0' bgcolor='000000' width='100%'>
									<tr><td bgcolor='green' class='smallwhite'>  </td><td class='smallwhite' width='30%'>:  All</td>
										<td bgcolor='red' class='smallwhite'>  </td><td class='smallwhite' width='30%'>:  With Referer</td>
										<td bgcolor='blue' class='smallwhite'>  </td><td class='smallwhite' width='30%'>:  WithOut Referer</td></tr>
								</table>
								</div>
								</td>
								<?}?>
							</tr>
						</table>
					</td>
				</tr>		
			</table>
		<?
	}
		
	function DisplayDetailVisit($Graph = true, $Year, $Month, $Day)
	{
		?>
			<table border='0' width='100%' cellspacing='0' cellpadding='0'>
				<tr>
					<td valign='top'>
						<table border='0' cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td width='70%' valign='top' align='center'>
								<font class='normalblack'><b>Details</b></font><br>
										<?= $this->DisplayVisit($Year, $Month, $Day)?>
								</td>
								<?if ($Graph == "true")
								{
									?>
								<td>&nbsp;</td>
								<td valign='top'>
								<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='000000'>
									<tr bgcolor='ffffff'>
										<td align='center' width='100%'><font class='normalblack'><b>Visit per Day on <b><?= $this->ReturnMonth($Month) ?></b></font></td>
									</tr>
									<tr bgcolor='ffffff'>
										<td align='center'><? echo "<img src='./include/graphs/graphday.php?Year=$Year&Month=$Month&Day=$Day' border=0 align=center width=300 height=200>"; ?></td>
									</tr>
								</table>
								<table border='0' cellspacing='1' cellpadding='0' bgcolor='000000' width='100%'>
									<tr><td bgcolor='green' class='smallwhite'>  </td><td class='smallwhite' width='30%'>:  All</td>
										<td bgcolor='red' class='smallwhite'>  </td><td class='smallwhite' width='30%'>:  With Referer</td>
										<td bgcolor='blue' class='smallwhite'>  </td><td class='smallwhite' width='30%'>:  WithOut Referer</td></tr>
								</table>
								<a href="#" onclick="ToggleDisplay(Daybutton, layerMore)" class='small2'><img src="../../stats/include/./resources/images/iconMoins.gif" id="Daybutton" border="0" align='left'><b>More Graphics</b></b></a>
								<div id='layerMore'>
								<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='000000'>
									<tr bgcolor='ffffff'>
										<td align='center' width='100%'><font class='normalblack'><b>Visit per Hour</b></font></td>
									</tr>
									<tr bgcolor='ffffff'>
										<td align='center'><? echo "<img src='./include/graphs/graphour.php?Year=$Year&Month=$Month&Day=$Day' border=0 align=center width=300 height=200>"; ?></td>
									</tr>
								</table>
								<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='000000'>
									<tr bgcolor='ffffff'>
										<td align='center' width='100%'><font class='normalblack'>Best Browser</b></font></td>
									</tr>
									<tr bgcolor='ffffff'>
										<td align='center'><? echo "<img src='./include/graphs/graphnav.php?Year=$Year&Month=$Month&Day=$Day' border=0 align=center width=300 height=200>"; ?></td>
									</tr>
								</table>
								<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='000000'>
									<tr bgcolor='ffffff'>
										<td align='center' width='100%' colspan='2'><font class='normalblack'>Connexion on <b><?= $Year ?></b></font></td>
									</tr>
									<tr bgcolor='ffffff'>
										<td colspan='2' align='center'><? echo "<img src='./include/graphs/graphyear.php?Year=$Year' border=0 align=center width=300 height=200>"; ?></td>
									</tr>
								</table>
								<table border='0' cellspacing='1' cellpadding='0' bgcolor='000000' width='100%'>
									<tr><td bgcolor='green' class='smallwhite'>  </td><td class='smallwhite' width='30%'>:  All</td>
										<td bgcolor='red' class='smallwhite'>  </td><td class='smallwhite' width='30%'>:  With Referer</td>
										<td bgcolor='blue' class='smallwhite'>  </td><td class='smallwhite' width='30%'>:  WithOut Referer</td></tr>
								</table>
								</div>
								</td>
								<?}?>
							</tr>
						</table>
					</td>
				</tr>		
			</table>
		<?
	}

	function DisplayDetailVisitShort($Graph = true, $Year, $Month, $Day)
	{
		?>
			<table border='0' width='100%' cellspacing='0' cellpadding='0'>
				<tr>
					<td valign='top'>
						<table border='0' cellspacing='0' cellpadding='0' width='100%'>
							<tr>
								<td width='70%' valign='top' align='center'>
								<font class='normalblack'><b>Details</b></font><br>
										<?= $this->DisplayVisitShort($Year, $Month, $Day)?>
								</td>
								<?if ($Graph == "true")
								{
									?>
								<td>&nbsp;</td>
								<td valign='top'>
								<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='000000'>
									<tr bgcolor='ffffff'>
										<td align='center' width='100%'><font class='normalblack'><b>Visit per Day on <b><?= $this->ReturnMonth($Month) ?></b></font></td>
									</tr>
									<tr bgcolor='ffffff'>
										<td align='center'><? echo "<img src='./include/graphs/graphday.php?Year=$Year&Month=$Month&Day=$Day' border=0 align=center width=300 height=200>"; ?></td>
									</tr>
								</table>
								<table border='0' cellspacing='1' cellpadding='0' bgcolor='000000' width='100%'>
									<tr><td bgcolor='green' class='smallwhite'>  </td><td class='smallwhite' width='30%'>:  All</td>
										<td bgcolor='red' class='smallwhite'>  </td><td class='smallwhite' width='30%'>:  With Referer</td>
										<td bgcolor='blue' class='smallwhite'>  </td><td class='smallwhite' width='30%'>:  WithOut Referer</td></tr>
								</table>
								<a href="#" onclick="ToggleDisplay(Daybutton, layerMore)" class='small2'><img src="../../stats/include/./resources/images/iconMoins.gif" id="Daybutton" border="0" align='left'><b>More Graphics</b></b></a>
								<div id='layerMore'>
								<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='000000'>
									<tr bgcolor='ffffff'>
										<td align='center' width='100%'><font class='normalblack'><b>Visit per Hour</b></font></td>
									</tr>
									<tr bgcolor='ffffff'>
										<td align='center'><? echo "<img src='./include/graphs/graphour.php?Year=$Year&Month=$Month&Day=$Day' border=0 align=center width=300 height=200>"; ?></td>
									</tr>
								</table>
								<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='000000'>
									<tr bgcolor='ffffff'>
										<td align='center' width='100%'><font class='normalblack'>Best Browser</b></font></td>
									</tr>
									<tr bgcolor='ffffff'>
										<td align='center'><? echo "<img src='./include/graphs/graphnav.php?Year=$Year&Month=$Month&Day=$Day' border=0 align=center width=300 height=200>"; ?></td>
									</tr>
								</table>
								<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='000000'>
									<tr bgcolor='ffffff'>
										<td align='center' width='100%' colspan='2'><font class='normalblack'>Connexion on <b><?= $Year ?></b></font></td>
									</tr>
									<tr bgcolor='ffffff'>
										<td colspan='2' align='center'><? echo "<img src='./include/graphs/graphyear.php?Year=$Year' border=0 align=center width=300 height=200>"; ?></td>
									</tr>
								</table>
								<table border='0' cellspacing='1' cellpadding='0' bgcolor='000000' width='100%'>
									<tr><td bgcolor='green' class='smallwhite'>  </td><td class='smallwhite' width='30%'>:  All</td>
										<td bgcolor='red' class='smallwhite'>  </td><td class='smallwhite' width='30%'>:  With Referer</td>
										<td bgcolor='blue' class='smallwhite'>  </td><td class='smallwhite' width='30%'>:  WithOut Referer</td></tr>
								</table>
								</div>
								</td>
								<?}?>
							</tr>
						</table>
					</td>
				</tr>		
			</table>
		<?
	}
	
	function DisplayCount($Graph = true)
	{
	}
	
	function DisplayDirectory($Graph = true)
	{
	}
	
	function DisplaySelect($dspgraph)
	{
		?>
			<table border='0' cellpadding='0' cellspacing='1' width='100%' bgcolor='B0B1CC'>
				<tr bgcolor='9899BC'>
					<td colspan='3'><font class='smallgrey' align='center'><b>Display Options</b></font></td>
				</tr>
				<tr bgcolor='9899BC'>
					<td colspan='3' class='smallgrey' align='left'>
					<?
						if ($dspgraph == "true")
							echo "<a href='" . $this->WsOverUrl("graph", "false") . "' class='small2'><img src='./resources/images/dsp_nograph.gif' border='0' alt='Hide Graphics'>&nbsp;Graphics Off</a>";
						elseif ($dspgraph == "false")
							echo "<a href='" . $this->WsOverUrl("graph", "true") . "' class='small2'><img src='./resources/images/dsp_graph.gif' border='0' alt='Display Graphics'>&nbsp;Graphics On </a>";
					?>
					<br><br></td>
				</tr>
				<tr bgcolor='9899BC'>
					<td colspan='3'><font class='smallgrey' align='center'><b>Display Mode</b></font></td>
				</tr>
				<tr bgcolor='9899BC'>
					<td colspan='3' class='smallgrey' align='left'>
					<?
					echo "<ul>";
					echo "<li><a href='" . $this->WsOverUrl("detail", "all") . "' class='small2'>Général</a>";
					echo "<li><a href='" . $this->WsOverUrl("detail", "visit") . "' class='small2'>Detail</a>";
					echo "<li><a href='" . $this->WsOverUrl("detail", "pages") . "' class='small2'>Pages</a>";
					echo "<li><a href='$PHP_SELF?detail=pages' class='small2'>Pages</a></ul>";
					?>
					</td>
				</tr>
			</table>
			<br>
		<?
	}
	
	function DisplayHeader()
	{
		?>
			<table border='0' cellspacing='0' cellpadding='0' bgcolor='8686A7' width='100%'>
				<tr>
					<td><a href="<?= $_SERVER['../../stats/include/PHP_SELF'] ?>"><img src='../../stats/include/./resources/images/wa_log.gif' border='0'></a></td>
					<td align='right'><font class='bigwhite'><?= $_SERVER["HTTP_HOST"] ?></font><br><font class='smallwhite'><?= $this->Date; ?></font></td>
				</tr>
			</table>
		<?
	}
	
	function DisplayYearTab()
	{
		$tYear = $this->UnSerializeLog($this->SerFileYear);
		
		if (!empty($tYear))
		{
		?>
			<table border='0' cellpadding='0' cellspacing='1' width='100%' bgcolor='B0B1CC'>
				<tr bgcolor='9899BC'>
					<td width='107' class='smallgrey' bgcolor='9899BC' align='center'><b>Year available</b> </td>
					<?
					foreach ($tYear as $key => $value)
					{
 					   echo "<td width='35'>&nbsp;<a href='" . $_SERVER['PHP_SELF'] . "?Year=$key' class='small2'>" . $key . "</a>&nbsp;</td>";
					}
					?>
					<td>&nbsp;</td>
				</tr>
				<tr bgcolor='9899BC'>
					<td width='107' class='smallwhite' align='center' bgcolor='9899BC'></td>
					<?
					foreach ($tYear as $key => $value)
					{
 					   echo "<td bgcolor='9899BC' class='verysmallgrey' align='center'>&nbsp;" . $value . "&nbsp;</td>";
					}
					?>
					<td>&nbsp;</td>
				</tr>		
			</table>
		<?
		}
	}
	
	function DisplayMonthTab($Year, $Month)
	{
		$this->tMonth = $this->UnSerializeLog($this->SerFileMonth);
		if (!empty($this->tMonth))
		{
		?>
			<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='9899BC'>
				<tr>
					<td width='107' class='smallgrey' bgcolor='9899BC' align='center'><b>Month available</b> </td>
					<?
					for ($i = 1; $i < 13; $i++)
					{
						if ($i < 10)
							$i = "0" . $i;
						
						if (empty($this->tMonth[$Year.$i]))
							$count = "<a href='" . $_SERVER['PHP_SELF'] . "?Year=$Year&Month=$i' class='small2'><font class='verysmallgrey'>" . $this->ReturnMonth($i) . "</a></font>&nbsp";
						else
							$count = "<a href='" . $_SERVER['PHP_SELF'] . "?Year=$Year&Month=$i' class='small2'>" . $this->ReturnMonth($i) . "</a>&nbsp;<font class='verysmallgrey'>[" . $this->tMonth[$Year.$i] . "]</font>&nbsp";
								
						if ($Month == $i)
	 					   echo "<td bgcolor='777894' width='35'>&nbsp;" . $count . "</td>";
	 					else
	 					   echo "<td bgcolor='9899BC' width='35'>&nbsp;" . $count . "</td>";
					}
					?>
					<td bgcolor='9899BC'>&nbsp;</td>
				</tr>
			</table>
		<?
		}
	}
	
	function DisplayDayTab($Year, $Month, $Day)
	{
		$monthListe = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
		$j = $Day;
		$m = $Month;
		$y = $Year;
	
		$mois_bef = mktime(10,0,0,$m - 1 ,1,$y);
		$mois_aft = mktime(10,0,0,$m + 1 ,1,$y);
		$selDate_bef = date('Y', $mois_bef) . '-' . date('m', $mois_bef) . '-';
		$selDate_aft = date('Y', $mois_aft) . '-' . date('m', $mois_aft) . '-';
	
		$selDate = "Year=$y&Month=$m&Day=";
		$debutmois = mktime(10,0,0,$m,1,$y);
		$finmois = mktime(10,0,0,$m + 1,0,$y);
		$odate = (date('w', $debutmois) + 6) % 7;
		$ndate = (int)date('j', $finmois);
		?>
		<script>
			displayCalendarJS('<?= PAL_COLOR_DARK ?>', "<?=$PHP_SELF.'?###' ?>", '<?= $selDate_bef . '99' ?>', '<?= $selDate_aft . '99' ?>', '<?= $selDate . '99' ?>', '<?= $monthListe[$m - 1] ?>', '<?= $y ?>', '<?= $selDate ?>', '<?= $odate ?>', '<?= $ndate ?>', '<?= $j ?>');
		</script>
		<?
	}

	function DisplayTotalDetails($Year,$Month,$Day)
	{
		$this->tDay = $this->UnSerializeLog($this->SerFileDay);
		$this->tHits = $this->UnSerializeLog($this->SerFileTotalHits);
		$this->tTime = $this->UnSerializeLog($this->SerFileTotalTime);
		
		if (empty($this->tHits))
			return false;
			
		if($this->tTime[$Year.$Month] > 0 && $this->tHits[$Year.$Month] > 0)
			$moyenne = $this->tTime[$Year.$Month] / $this->tHits[$Year.$Month];
		else
			$Moyenne = 0;
		?>
			<br>
			<table border='0' cellpadding='0' cellspacing='1' width='100%' bgcolor='B0B1CC'>
				<tr bgcolor='9899BC'>
					<td>
						<font class='smallgrey' align='center'><b>Today</b></font>
					</td>
				</tr>
				<tr bgcolor='9899BC'>
					<td>
						<font class='verysmallgrey'>Visits today :</font>
						<div align='right'><font class='smallgrey'><?= $this->tDay[$Year.$Month.$Day] ?>  </font></div>
					</td>
				</tr>		
				<tr bgcolor='9899BC'>
					<td>
						<font class='smallgrey' align='center'><b>This Month</b></font>
					</td>
				</tr>
				<tr bgcolor='9899BC'>
					<td>
						<font class='verysmallgrey'>Hits :</font>
						<div align='right'><font class='smallgrey'><?= $this->tHits[$Year.$Month] ?>  </font></div>
						<font class='verysmallgrey'>Time of connection :</font>
						<div align='right'><font class='smallgrey'><?= $this->GetTime($this->tTime[$Year.$Month]) ?>  </font></div>
						<font class='verysmallgrey'>Average :</font>
						<div align='right'><font class='smallgrey'><?= $this->GetTime($moyenne) ?>  </font></div>
					</td>
				</tr>
			</table>
		<?
	}
	
	function DisplayDetailDay($Year, $Month, $Day)
	{
		$Detail = $this->RetunrDetailDay($Year, $Month, $Day);

		if (empty($Detail))
		{
			echo "<font class='smallblack'>No Entry</font>";
			return false;
		}

		?>
		<DIV style="DISPLAY: block; OVERFLOW: auto; WIDTH: 100%; POSITION: relative; HEIGHT: 216px">
		<table border='0' cellpadding='0' cellspacing='1' width='100%' bgcolor='4C4E72'>
			<tr bgcolor='8686A7'>
				<td align='center' width='15%'><font class='smallgrey'>Time</font></td>
				<td align='center' width='70%'><font class='smallgrey'>Host</font></td>
				<td align='center' width='5%'><font class='smallgrey'>Client</font></td>
				<td align='center' width='5%'><font class='smallgrey'>Ref.</font></td>
				<td align='center' width='5%'><font class='smallgrey'>Detail</font></td>
			</tr>
		<?
		$flag = 1;
		for ($i = 0; $i < count($Detail); $i++)
		{
			if (is_numeric($Detail[$i]["Host"]))
				$Cnty = "ukn";
			else
			{
				preg_match("/[^\.\/]+\.[^\.\/]+$/",$Detail[$i]["Host"],$matches);
				$host = $matches[0];
				$Tnat = explode(".", $host);
				$Cnty = $Tnat[1];
			}

			if ($flag == 1)
			{
				$flag = 0;
				$bgcolor='9899BC';
			}
			else
			{
				$flag = 1;
				$bgcolor='B3B4AA';
			}
			
			if ($Detail[$i]["Detail"] == 1)
				$ImgDetail = "<a href='#' onclick=\"MM_openBrWindow('./view.php?date=" . $Year.$Month.$Day . "&file=" . $Detail[$i]["Date"] . "','Details','scrollbars=yes,width=600,height=400')\"'><img src='./resources/images/system2.gif' border='0'></a>";
			else
				$ImgDetail = "";
			
			if (!empty($Detail[$i]["Referer"]))
				$ImgRef = "<a href='" . $Detail[$i]["Referer"] . "' target='_blank'><img src='./resources/images/icon_becar.jpg' border='0' alt='" . $Detail[$i]["Referer"] . "'></a>";
			else
				$ImgRef = "";
			
				
			echo "<tr bgcolor='$bgcolor'>";
			echo "<td bgcolor='$bgcolor'><font class='smallblack'>" . date("H:i:s", $Detail[$i]["Date"]) . "</td>";
			echo "<td bgcolor='$bgcolor'><font class='smallblack'><img src='./resources/images/flag/" . $this->ReturnFlag($Cnty) . "' alt='$Tnat[1]' align='left'>" . $Detail[$i]["Host"] . "</td>";
			echo "<td bgcolor='ffffff' align='center'>" . $this->ReturnImgBrower($Detail[$i]["Client"]) . "</td>";
			echo "<td bgcolor='ffffff' align='center'>" . $ImgRef . "</td>";
			echo "<td bgcolor='ffffff' align='center'>" . $ImgDetail . "</td>";
			echo "</tr>";
		}
		echo "</table></div>";
	}

	function DisplayDetailDayFull($Year, $Month, $Day)
	{
		$Detail = $this->RetunrDetailDay($Year, $Month, $Day);

		if (empty($Detail))
		{
			echo "<font class='smallblack'>No Entry</font>";
			return false;
		}

		?>
		<table border='0' cellpadding='0' cellspacing='1' width='100%' bgcolor='4C4E72'>
			<tr bgcolor='8686A7'>
				<td align='center' width='15%'><font class='smallgrey'>Time</font></td>
				<td align='center' width='70%'><font class='smallgrey'>Host</font></td>
				<td align='center' width='5%'><font class='smallgrey'>Client</font></td>
				<td align='center' width='5%'><font class='smallgrey'>Ref.</font></td>
				<td align='center' width='5%'><font class='smallgrey'>Detail</font></td>
			</tr>
		<?
		$flag = 1;
		for ($i = 0; $i < count($Detail); $i++)
		{
			if (is_numeric($Detail[$i]["Host"]))
				$Cnty = "ukn";
			else
			{
				preg_match("/[^\.\/]+\.[^\.\/]+$/",$Detail[$i]["Host"],$matches);
				$host = $matches[0];
				$Tnat = explode(".", $host);
				$Cnty = $Tnat[1];
			}

			if ($flag == 1)
			{
				$flag = 0;
				$bgcolor='9899BC';
			}
			else
			{
				$flag = 1;
				$bgcolor='B3B4AA';
			}
			
			if ($Detail[$i]["Detail"] == 1)
				$ImgDetail = "<a href='#' onclick=\"MM_openBrWindow('./view.php?date=" . $Year.$Month.$Day . "&file=" . $Detail[$i]["Date"] . "','Details','scrollbars=yes,width=600,height=400')\"'><img src='./resources/images/system2.gif' border='0'></a>";
			else
				$ImgDetail = "";
			
			if (!empty($Detail[$i]["Referer"]))
				$ImgRef = "<a href='" . $Detail[$i]["Referer"] . "' target='_blank'><img src='./resources/images/icon_becar.jpg' border='0' alt='" . $Detail[$i]["Referer"] . "'></a>";
			else
				$ImgRef = "";
			
				
			echo "<tr bgcolor='$bgcolor'>";
			echo "<td bgcolor='$bgcolor'><font class='smallblack'>" . date("H:i:s", $Detail[$i]["Date"]) . "</td>";
			echo "<td bgcolor='$bgcolor'><font class='smallblack'><img src='./resources/images/flag/" . $this->ReturnFlag($Cnty) . "' alt='$Tnat[1]' align='left'>" . $Detail[$i]["Host"] . "</td>";
			echo "<td bgcolor='ffffff' align='center'>" . $this->ReturnImgBrower($Detail[$i]["Client"]) . "</td>";
			echo "<td bgcolor='ffffff' align='center'>" . $ImgRef . "</td>";
			echo "<td bgcolor='ffffff' align='center'>" . $ImgDetail . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}

	function DisplayVisit($Year, $Month, $Day)
	{
		$Detail = $this->RetunrDetailDay($Year, $Month, $Day);

		if (empty($Detail))
		{
			echo "<font class='smallblack'>No Entry</font>";
			return false;
		}

		?>
		<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='4C4E72'>
		<?
		$flag = 1;
		echo "<tr bgcolor='ffffff'>
				<td colspan='5'>";
		for ($i = 0; $i < count($Detail); $i++)
		{
			if ($flag == 1)
			{
				$flag = 0;
				$bgcolor='E1E1F3';
			}
			else
			{
				$flag = 1;
				$bgcolor='F3EDE1';
			}

			$dtl = $this->RetunrDetailDayPerVisit($Detail[$i]["Date"], $Year, $Month, $Day);

			if (is_numeric($Detail[$i]["Host"]))
				$Cnty = "ukn";
			else
			{
				preg_match("/[^\.\/]+\.[^\.\/]+$/",$Detail[$i]["Host"],$matches);
				$host = $matches[0];
				$Tnat = explode(".", $host);
				$Cnty = $Tnat[1];
			}
				
			echo "<table cellspacing='1' cellpading='0' bgcolor='000000' width='99%'><tr bgcolor='ffffff'>";
			echo "<td bgcolor='$bgcolor' width='20%' valign='top'><font class='normalblack'><b>Heure d'arrivé :</b> " . date("H:i:s", $Detail[$i]["Date"]);
			echo "<br><b>Nb pages # vues : </b>" . $dtl["cumul"]["NbPage"];
			echo "<br><b>Nb de hits : </b>" . $dtl["cumul"]["Hits"] . "</td>";
			echo "<td valign='top'><font class='normalblack'><img src='./resources/images/flag/" . $this->ReturnFlag($Cnty) . "' alt='$Tnat[1]' align='left'>" . $Detail[$i]["Host"];
			echo "<br><ul><b>Referer : </b>" . $Detail[$i]["Referer"];
			echo "<br><b>Browser : </b>" . $Detail[$i]["Client"];
			if (!empty($dtl))
			{
				echo "<br><br><b>Time of connexion per pages : </b><br>";
				$cumul = 0;
				for ($j = 0; $j < count($dtl["all"]); $j++)
				{
					if ($dtl["all"][$j]["TimeStart"] > (3600*12))
						$start = 0;
					else
						$start = $dtl["all"][$j]["TimeStart"];
			
					$end = $dtl["all"][$j]["TimeEnd"];
			
					if (empty($end) || $end > (3600*12))
						$time = 0;
					else				
						$time = ($end - $start);
					$cumul += $time;
					echo "<font class='smallorange'>" . $this->GetTime($time) . " -&nbsp;&nbsp;</font><a href='".$PHP_SELF.$dtl["all"][$j]["Uri"]."' target='_blank' class='small2'>" . $dtl["all"][$j]["Uri"] . "</a><br>";
				}
				echo "<br><center><font class='normalblack'><b>Time of connexion (estimation) :</b> </font><font class='smallorange'>". $this->GetTime($cumul) ."</font></center>";
			}
			
			echo "</td></tr></table><br>";
		}
		echo "</td></tr>";
		echo "</table>";
	}

	function DisplayVisitShort($Year, $Month, $Day)
	{
		$Detail = $this->RetunrDetailDay($Year, $Month, $Day);

		if (empty($Detail))
		{
			echo "<font class='smallblack'>No Entry</font>";
			return false;
		}

		?>
		<table border='0' cellpadding='0' cellspacing='0' width='100%' bgcolor='4C4E72'>
			<tr>
				<td class='smallwhite'>Date</td>
				<td class='smallwhite'>Host</td>
				<td class='smallwhite'>Nb Pages</td>
				<td class='smallwhite'>Nb Hits</td>
			</tr>	
		<?
		$flag = 1;
		echo "<tr bgcolor='ffffff'>
				<td colspan='5'>";
		for ($i = 0; $i < count($Detail); $i++)
		{
			if ($flag == 1)
			{
				$flag = 0;
				$bgcolor='E1E1F3';
			}
			else
			{
				$flag = 1;
				$bgcolor='F3EDE1';
			}

			$dtl = $this->RetunrDetailDayPerVisit($Detail[$i]["Date"], $Year, $Month, $Day);

			if (is_numeric($Detail[$i]["Host"]))
				$Cnty = "ukn";
			else
			{
				preg_match("/[^\.\/]+\.[^\.\/]+$/",$Detail[$i]["Host"],$matches);
				$host = $matches[0];
				$Tnat = explode(".", $host);
				$Cnty = $Tnat[1];
			}

			echo "<tr bgcolor='ffffff'>";
			echo "<td bgcolor='$bgcolor' width='20%' valign='top'><font class='normalblack'>" . date("H:i:s", $Detail[$i]["Date"]) . "</td>";
			echo "<td bgcolor='$bgcolor'><font class='normalblack'><img src='./resources/images/flag/" . $this->ReturnFlag($Cnty) . "' alt='$Tnat[1]' align='left'>" . $Detail[$i]["Host"] . "</td>";
			echo "<td bgcolor='$bgcolor'>" . $dtl["cumul"]["NbPage"] . "</td>";
			echo "<td bgcolor='$bgcolor'>" . $dtl["cumul"]["Hits"] . "</td>";			
			echo "</tr>";
		}
		echo "</table>";
	}
		
	function DisplayTopHost($Year,$Month)
	{
		$this->tMonth = $this->UnSerializeLog($this->SerFileMonth);
		$this->tHost = $this->UnSerializeLog($this->SerFileHost);

		if (empty($this->tHost) || $this->tMonth[$Year.$Month] == 0)
			return false;

		?>
			<table border='0' cellpadding='0' cellspacing='1' width='100%' bgcolor='4C4E72'>
				<tr bgcolor='8686A7'>
					<td width='20'><font class='smallgrey'>  cnx</font></td>
					<td width='90'><font class='smallgrey'>  host</font></td>
					<td width='40'><font class='smallgrey'>  %</font></td>
				</tr>
					<?
					$flag = 0;
					array_multisort ($this->tHost, SORT_DESC, array_keys ($this->tHost));
					foreach ($this->tHost as $key => $value)
					{
						if ($flag < 10)
						{
							if ($value > 0)
								$Moyenne = ($value * 100) / $this->tMonth[$Year.$Month];
							else
								$Moyenne = (1 * 100) / $this->tMonth[$Year.$Month];
							
							echo "<tr bgcolor='9899BC'>";
	 					  	echo "<td align='center'><font class='verysmallgrey'>" . $value ."</font></td>";					
							echo "<td align='center'><font class='smallgrey'>" . $key . "</font></td>";
							echo "<td align='center' bgcolor='" . $this->ReturnColorCell($Moyenne) . "'><font class='smallblack'>" . round($Moyenne,2) . "%</font></td>";
							echo "</tr>";
						}
						$flag += 1;
					}	
					?>
			</table>
		<?
	}		

	function DisplayTopReferer($Year, $Month)
	{
		$this->tReferer = $this->UnSerializeLog($this->SerFileReferer);
		if (empty($this->tReferer)|| $this->tMonth[$Year.$Month] == 0)
			return false;

		foreach ($this->tReferer as $key => $value)
			$ttal += $value;
		?>
			<table border='0' cellpadding='0' cellspacing='1' width='100%' bgcolor='4C4E72'>
				<tr bgcolor='8686A7'>
					<td width='20'><font class='smallgrey'>  cnx</font></td>
					<td width='90'><font class='smallgrey'>  referer</font></td>
					<td width='40'><font class='smallgrey'>  %</font></td>
				</tr>
					<?
					$flag = 0;
					array_multisort ($this->tReferer, SORT_DESC, array_keys ($this->tReferer));
					foreach ($this->tReferer as $key => $value)
					{
						if ($flag < 10)
						{
							if ($value > 0)
								$Moyenne = ($value * 100) / $ttal;
							else
								$Moyenne = (1 * 100) / $ttal;
							
							echo "<tr bgcolor='9899BC'>";
	 					  	echo "<td align='center'><font class='verysmallgrey'>" . $value ."</font></td>";					
							echo "<td align='center'><a href='$key' target='_blank' class='small2'>" . $key . "</font></td>";
							echo "<td align='center' bgcolor='" . $this->ReturnColorCell($Moyenne) . "'><font class='smallblack'>" . round($Moyenne,2) . "%</font></td>";
							echo "</tr>";
						}
						$flag += 1;
					}	
					?>
			</table>
		<?
	}		

	function DisplayTopPage($Year, $Month)
	{
		$this->tHits = $this->UnSerializeLog($this->SerFileTotalHits);
		$this->tPages = $this->UnSerializeLog($this->SerFilePages);
		if (empty($this->tPages)|| $this->tMonth[$Year.$Month] == 0)
			return false;
		?>
			<table border='0' cellpadding='0' cellspacing='1' width='100%' bgcolor='4C4E72'>
				<tr bgcolor='8686A7'>
					<td width='90'><font class='smallgrey'>  pages</font></td>
					<td width='40'><font class='smallgrey'>  %</font></td>
				</tr>
					<?
					$flag = 0;
					array_multisort ($this->tPages, SORT_DESC, array_keys ($this->tPages));
					foreach ($this->tPages as $key => $value)
					{
						if ($flag < 10)
						{
							if ($value > 0)
								$Moyenne = ($value * 100) / $this->tHits[$Year.$Month];
							else
								$Moyenne = (1 * 100) / $this->tHits[$Year.$Month];
							
							echo "<tr bgcolor='9899BC'>";
							echo "<td align='center'><font class='smallgrey'>" . $key . "</font></td>";
							echo "<td align='center' bgcolor='" . $this->ReturnColorCell($Moyenne) . "'><font class='smallblack'>" . round($Moyenne,2) . "%</font></td>";
							echo "</tr>";
						}
						$flag += 1;
					}	
					?>
			</table>
		<?
	}	

	function DisplayTopCountry($Year, $Month)
	{
		$this->tCountry = $this->UnSerializeLog($this->SerFileCountry);
		if (empty($this->tCountry) || $this->tMonth[$Year.$Month] == 0)
			return false;
		?>
			<table border='0' cellpadding='0' cellspacing='1' width='100%' bgcolor='4C4E72'>
				<tr bgcolor='ffffff'>
					<?
					$flag = 0;
					array_multisort ($this->tCountry, SORT_DESC, array_keys ($this->tCountry));
					foreach ($this->tCountry as $key => $value)
					{
						if ($flag < 10)
						{
							if ($value > 0)
								$Moyenne = ($value * 100) / $this->tMonth[$Year.$Month];
							else
								$Moyenne = (1 * 100) / $this->tMonth[$Year.$Month];
								
							
							echo "<td bgcolor='" . $this->ReturnColorCell($Moyenne) . "'><font class='smallblack'>" . round($Moyenne) . "%</font></td>";
							echo "<td><img src='./resources/images/flag/" . $this->ReturnFlag($key) . "' alt='$key'></td>";
							echo "<td class='smallblack'>&nbsp;</td>";
						}
						$flag += 1;
					}	
					?>
				</tr>
			</table>
		<?
	}	
}
?>