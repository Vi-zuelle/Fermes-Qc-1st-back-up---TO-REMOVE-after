<?php

Class Init
{
	var $CookiesTime;												// Temps de validité du cookie
	
	var $Ip;															// Retourne l'IP
	var $Host;															// Retourne le Host
	var $Referer;														// Retourne le Referer
	var $Client;														// Retourne la version du navigateur
	var $Date;			 												// Date du jour
	var $DateAccess;													// Timestamp de l'acces

	var $AccessPath = '/log/';
	var $active;

	function Init($activ = true, $Path)
	{
		$this->AccessPath = $Path;
		$this->Active = $activ;
		
		$this->Ip = $_SERVER["REMOTE_ADDR"];								// Retourne l'IP
		$this->Host = gethostbyaddr($this->Ip);								// Retourne le Host
		$this->Referer = $_SERVER["HTTP_REFERER"];							// Retourne le Referer
		$this->Date = date("F j, Y, g:i:s");								// Date du jour
		$this->FileDate = date("Ymd");									// Date du fichier de log.. . 1/jour
		$this->DateAccess = time($this->Date); 		
		$this->Client = $_SERVER["HTTP_USER_AGENT"];
		$this->CookiesTime = 0;

		$browser_search = array("MSIE 6.0", "MSIE 5.5", "MSIE 5.0", "MSIE 4.0","Opera","Konqueror","Mozilla/5", "Mozilla/4", "Mozilla");

		while(list($key, $value) = each ($browser_search))
		{
			$pos = strpos ($this->Client, $value);

			if($pos !== false)
			{
				$IBROWSER = true;
				break 1;
			}
		}

		if ($this->Active == true && $IBROWSER == true )										// Si log bien active
		{
			if (!empty($_COOKIE))
				$this->AddEvents($_COOKIE["time"]);
			else														// Sinon creation d'un nx fichier de log
			{
				$time = time();
				$cook = setcookie ("Webstats", $this->DateAccess,time()+3600);
				$this->CreateLogFile();
			}
		}
	}

	function CreateLogFile()
	{
		$file = $this->FileDate . ".log";
		if (is_dir($this->AccessPath . "log/"))
		{
			$fd = fopen ($this->AccessPath . "log/$file", "a+");
			fputs ($fd, $this->DateAccess . "|" . $this->Ip . "|" . $this->Host . "|" . $this->Referer . "|" . $this->Client . "|" . $_SERVER["REQUEST_URI"] . "|" . $this->DateAccess . "\n");			
			fclose ($fd);
		}
	}
	
	function AddEvents($time)
	{
		$timeaccess = $this->DateAccess - $time;
		$file = $this->FileDate . ".log";
		if (is_dir($this->AccessPath . "log/"))
		{
			$fd = fopen ($this->AccessPath . "log/$file", "a+");
			fputs ($fd, $timeaccess . "|" . $this->Ip . "|" . $this->Host . "|" . $this->Referer . "|" . $this->Client . "|" . $_SERVER["REQUEST_URI"] . "|" . $time .  "|" . 1 . "\n");			
			fclose ($fd);
		}
	}
}

Class Process
{
	var $Date;			 												// Date du jour
	var $SerFileYear;
	var $IPath;
	
	function Process()
	{
		$this->Date = date("j F, Y");							// Date du jour
		$this->Path = "./log/";
		$this->IPath = "./log/";
	
		$this->SerFileYear 	= "./log/__tyear.ser";
		$this->SerFileMonth = "./log/__tmonth.ser";
		$this->SerFileDay 	= "./log/__tday.ser";

		$this->SerFileHost 		= "./log/__thost.ser";
		$this->SerFileReferer 	= "./log/__treferer.ser";
		$this->SerFileWithReferer 	= "./log/__twithreferer.ser";
		$this->SerFileWithOutReferer 	= "./log/__twithoutreferer.ser";
		$this->SerFileBrowers 	= "./log/__tbrowser.ser";
		$this->SerFilePages 	= "./log/__tpages.ser";
		$this->SerFileCountry 	= "./log/__tcountry.ser";
		$this->SerFileTotalHits	= "./log/__ttotalhhit.ser";
		$this->SerFileTotalTime	= "./log/__ttotaltime.ser";
		$this->SerFileTotalHour	= "./log/__ttotalhour.ser";
	}

	function LogUsage($crypt = false)
	{
	// insert into logs nanobody stats.
		$rnd = rand(0, 1);
		if ($rnd == 1)
		{ // log the site who use WebActivity
			 if ($crypt)
			    $sn = md5($_SERVER['SERVER_NAME']); // domain name is crypted Nanobody do not store any information about your web site
			 else
			    $sn = $_SERVER['SERVER_NAME']; // Nanobody will store your domain name but will not use it except for statistiques purpose.
			 
				 $errno = '';
				 $errstr = '';
				 $fp = fsockopen ("www.nanobody.net", 80, $errno, $errstr, 5);
	
				 if ($fp)
				 {
				 	$date = time();
				    fputs ($fp, "GET /trace_webanalyse.php?Web=$sn&time=$date HTTP/1.0\r\nHost: www.nanobody.net\r\n\r\n");
				    while (!feof($fp))
				       fgets ($fp,128);
				    fclose ($fp);
				 }
		}
	}

	function SerializeLog($file, $tdata)
	{
		if(file_exists($file))
		{
			$fd = fopen ($file, "r+");
			$contents = fread ($fd, filesize($file));
			fclose ($fd);

			$data = unserialize($contents);	
			$Nentre = array_keys($tdata);

			for ($i = 0; $i < count($Nentre); $i++)
			{ 
				$v = $tdata[$Nentre[$i]];
				
				if (array_key_exists("$Nentre[$i]", $data))
					$data["$Nentre[$i]"] += $v;
				else
					$data["$Nentre[$i]"] = $v;
			}
			$fd = fopen($file, "w+");
			$data = serialize($data);
			fputs ($fd, $data);			
			fclose($fd);
		}
		else
		{
			$data = serialize($tdata);
			$fd = fopen($file, "w+");
			fputs ($fd, $data);			
			fclose($fd);
		}	
	}
	
	function UnSerializeLog($file)
	{
		if (file_exists($file))
		{
			$fd = fopen ($file, "r");
			$contents = fread ($fd, filesize($file));
			if ($file == $this->SerFileHost)
			fclose ($fd);
		
			$data = unserialize($contents);	
			
			return $data;
		}
	}	

	function MakeLogFile($date, $tdata)
	{
		$file = $this->IPath . $date . ".dlog";
		if (file_exists($file))
		{
			$fd = fopen ($file, "a+");
			for ($i = 0; $i < count($tdata); $i++)
				fputs($fd, $tdata[$i]."\n");
			fclose ($fd);
		}
		else
		{
			$fd = fopen ($file, "w+");
			for ($i = 0; $i < count($tdata); $i++)
				fputs($fd, $tdata[$i]."\n");
			fclose ($fd);
		}
	}

	function TLogByDay()
	{
		$Logfile = "./log/" . $Year . $Month . $Day .".log";
		if ($handle = opendir($this->IPath))
		{
		    while ($file = readdir($handle))
		    {
				$ext = strrchr($file,'.');
		    	if ($file != "." && $file != ".." && $ext == ".log")
		    	{
		    		$file2 = $this->IPath . $file;
					$fd = fopen ($file2, "r");
					$contents = fread ($fd, filesize($file2));
					fclose ($fd);
					$Log = explode("\n", $contents);

					// Creation d'un fichier pour le detail
					$s = filectime($file2);
					$DDate = date("Ymd", $s);
					$this->MakeLogFile($DDate, $Log);
					unlink ($file2);
														
					for ($i = 0; $i < count($Log) && !empty($Log); $i++)
					{	
						$Part = explode("|", $Log[$i]);
						$Part2 = explode("|", $Log[$i+1]);
						
						if ($Part[0] > 43200)
						{
			    			$tLogCountY[date("Y", $Part[0])] += 1;
			    			$tLogCountM[date("Y", $Part[0]).date("m", $Part[0])] += 1;
				    		$tLogCountD[date("Y", $Part[0]).date("m", $Part[0]).date("d", $Part[0])] += 1;

							$tLogCountHour[date("Y", $Part[0]).date("m", $Part[0]).date("G", $Part[0])] += 1;

							// -- HOST -- \\
							if (!empty($Part[2]))
							{
								preg_match("/[^\.\/]+\.[^\.\/]+$/",$Part[2],$matches);
								if (is_numeric($matches[0]))
									$host = $Part[2];
								else
								{
									$host = $matches[0];

									//-- COUNTRY --\\
									$Tnat = explode(".", $host);
									$tLogCountCountry[$Tnat[1]] += 1;
								}
								$tLogCountHost[$host] += 1;
							}
							
							// -- REFERER -- \\
							if (!empty($Part[3]))
							{
								preg_match("/^(http:\/\/)?([^\/]+)/i", $Part[3], $matches);
								
								$YDom = $_SERVER["HTTP_HOST"];
								if(!preg_match ("/$YDom/i", $Part[3]))
									$tLogCountReferer[$matches[0]] += 1;
								
								$tLogCountWithRef[date("Y", $Part[0]).date("m", $Part[0]).date("d", $Part[0])] += 1;
							}
							else
								$tLogCountWithOutRef[date("Y", $Part[0]).date("m", $Part[0]).date("d", $Part[0])] += 1;

							//-- BROWSER --\\
							if (!empty($Part[4]))
							{
								$tLogCountBrowser[$Part[4]] += 1;
							}
						}
						elseif (!empty($Part[0]) && $Part2[0] < 43200)
						{
							$start = $Part[0];
							$end = $Part2[0];
			
							if (empty($end))
								$time = 0;
							else				
								$time = ($end - $start);

							$tTotalTime[date("Y").date("m")] += $time;
						}
						
						//-- COUNT TOTAL HIT --\\
						if (!empty($Part[5]))
							$tTotalHits[date("Y").date("m")] += 1;
						
						//-- COUNT ALL PAGES --\\
						if (!empty($Part[5]))
						{	
							if (preg_match ("/\?/i", $Part[5]))
							{
								$Pagex = explode("?", $Part[5]);
								$Page = $Pagex[0];
							}
							else
								$Page = $Part[5];
		
							if ($Page == '/' || $Page == '/index.php' || $Page == 'index.php')
								$Page = "index";
								
							$tLogCountPage[$Page] += 1;
						}
					}
				}
			}	
		}

		if (!empty($tLogCountY))
			$this->SerializeLog($this->SerFileYear, 	$tLogCountY);
		if (!empty($tLogCountM))
			$this->SerializeLog($this->SerFileMonth, 	$tLogCountM);
		if (!empty($tLogCountD))
			$this->SerializeLog($this->SerFileDay, 		$tLogCountD);
		if (!empty($tLogCountHost))
			$this->SerializeLog($this->SerFileHost, 		$tLogCountHost);
		if (!empty($tLogCountReferer))
			$this->SerializeLog($this->SerFileReferer, 		$tLogCountReferer);
		if (!empty($tLogCountWithOutRef))
			$this->SerializeLog($this->SerFileWithOutReferer, 		$tLogCountWithOutRef);
		if (!empty($tLogCountWithRef))
			$this->SerializeLog($this->SerFileWithReferer, 		$tLogCountWithRef);			
		if (!empty($tLogCountBrowser))
			$this->SerializeLog($this->SerFileBrowers, 		$tLogCountBrowser);
		if (!empty($tLogCountCountry))
			$this->SerializeLog($this->SerFileCountry, 		$tLogCountCountry);
		if (!empty($tLogCountPage))
			$this->SerializeLog($this->SerFilePages, 		$tLogCountPage);
		if (!empty($tTotalTime))
			$this->SerializeLog($this->SerFileTotalTime, 	$tTotalTime);
		if (!empty($tTotalHits))
			$this->SerializeLog($this->SerFileTotalHits, 		$tTotalHits);
		if (!empty($tLogCountHour))
			$this->SerializeLog($this->SerFileTotalHour, 		$tLogCountHour);
	}
	
	function RetunrDetailDay($Year, $Month, $Day)
	{
		$Path = "./log/";
		if (file_exists($Path . $Year . $Month . $Day .".dlog"))
		{
			$fd = fopen ($this->AccessPath . "log/" . $Year . $Month . $Day .".dlog", "r");
			$contents = fread ($fd, filesize($this->AccessPath . "log/" . $Year . $Month . $Day .".dlog"));
			fclose ($fd);

			$Log = explode("\n", $contents);

			for ($i = 0; $i < count($Log); $i++)
			{	
				$Part = explode("|", $Log[$i]);
				$Part2 = explode("|", $Log[$i+1]);

				if (date("Y", $Part[0]) > 1990)
				{
					$tDayLog["Date"] 		= $Part[0];
					$tDayLog["Ip"] 			= $Part[1];
					$tDayLog["Host"] 		= $Part[2];
					
					$tDayLog["Referer"] 	= $Part[3];
						
					$tDayLog["Client"] 		= $Part[4];
					
					if (date("Y", $Part2[0]) > 1990)
						$tDayLog["Detail"]		= 0;
					else
						$tDayLog["Detail"]		= 1;
					
					$tDayLog["Uri"] 		= $Part[5];
					$tDayLog["Time"] 		= $Part[6];
					$tDay[] = $tDayLog;
				}
			}
		}
		return $tDay;
	}

	function RetunrDetailDayPerVisit($StartTime, $Year, $Month, $Day)
	{
		$Path = "./log/";
		if (file_exists($Path . $Year . $Month . $Day .".dlog"))
		{
			$fd = fopen ($this->AccessPath . "log/" . $Year . $Month . $Day .".dlog", "r");
			$contents = fread ($fd, filesize($this->AccessPath . "log/" . $Year . $Month . $Day .".dlog"));
			fclose ($fd);

			$Log = explode("\n", $contents);
			for ($i = 0; $i < count($Log); $i++)
			{	
				$Part = explode("|", $Log[$i]);
				$Part2 = explode("|", $Log[$i+1]);

				if ($Part[6] == $StartTime)
				{
					$tDayLog["TimeStart"] 		= $Part[0];
					$tDayLog["TimeEnd"] 		= $Part2[0];
					$tDayLog["Referer"] 		= $Part[3];
					$tDayLog["Uri"] 			= $Part[5];
					
					if (empty($tmp[$Part[5]]))
					{
						$tmp[$Part[5]] = $Part[5];
						$tDayLogSpe["NbPage"]			+= 1;
					}
					$tDayLogSpe["Hits"]			+= 1;
					
					$tDay["all"][] = $tDayLog;
					$tDay["cumul"] = $tDayLogSpe;
				}
			}
		}
		return $tDay;
	}

	
	function ReturnColorCell($moyenne)
	{
		if ($moyenne <= 1)
			$color = 'FF0000';
		elseif ($moyenne <= 2)
			$color = 'FF1900';
		elseif ($moyenne <= 3)
			$color = 'FF3200';
		elseif ($moyenne <= 4)
			$color = 'FF4B00';
		elseif ($moyenne <= 5)
			$color = 'FF6400';
		elseif ($moyenne <= 6)
			$color = 'FF7D00';
		elseif ($moyenne <= 7)
			$color = 'FF9600';
		elseif ($moyenne <= 8)
			$color = 'FFAF00';
		elseif ($moyenne <= 10)
			$color = 'FFC800';
		elseif ($moyenne <= 12)
			$color = 'FFE100';
		elseif ($moyenne <= 14)
			$color = 'FFFA00';
		elseif ($moyenne <= 16)
			$color = 'E1FA00';
		elseif ($moyenne <= 18)
			$color = 'C8FA00';
		elseif ($moyenne <= 20)
			$color = 'AFFA00';
		elseif ($moyenne <= 25)
			$color = '96FA00';
		elseif ($moyenne <= 30)
			$color = '7DFA00';
		elseif ($moyenne <= 35)
			$color = '64FA00';
		elseif ($moyenne <= 40)
			$color = '4BFA00';
		elseif ($moyenne <= 50)
			$color = '32FA00';
		elseif ($moyenne <= 100)
			$color = '19FA00';
			
		return $color;		
	}
	
	function ReturnMonth($Month)
	{
		$tMonth = array("01" => "Jan",
						"02" => "Feb",
						"03" => "Mar",
						"04" => "Apr",
						"05" => "May",
						"06" => "Jun",
						"07" => "Jul",
						"08" => "Aug",
						"09" => "Sep",
						"10" => "Oct",
						"11" => "Nov",
						"12" => "Dec");

		return $tMonth[$Month];
	}
	
	function ReturnImgBrower($type)
	{
		if (preg_match ("/opera/i", $type)) 
			$Img = "opera.gif";
		if (preg_match ("/Mozilla/i", $type)) 
			$Img = "mozzila.gif";
		if (preg_match ("/MSIE/i", $type)) 
			$Img = "ie.gif";
		if (preg_match ("/Mac/i", $type))
			$Img = "mac.gif";
		$BrowserImg = "<img src='./resources/images/browser/" . $Img . "' alt='$type'>";

		return $BrowserImg;
	}

	function ReturnFlag($country)
	{
		switch($country)
		{
			case "fr":
				return "fr.gif";
			case "tr":
				return "tr.gif";
			case "com":
				return "com.gif";
			case "net":
				return "net.gif";
			case "org":
				return "org.gif";
			case "ro":
				return "ro.gif";
			case "uk":
				return "uk.gif";
			case "nz":
				return "nz.gif";
			case "au":
				return "au.gif";
			case "es":
				return "es.gif";
			case "sg":
				return "sg.gif";
			case "ch":
				return "ch.gif";
			case "pl":
				return "pl.gif";
			case "at":
				return "us.gif";
			case "us":
				return "us.gif";
			case "nl":
				return "nl.gif";
			case "hr":
				return "hr.gif";
			case "edu":
				return "edu.gif";
			case "ru":
				return "ru.gif";
			case "it":
				return "it.gif";
			case "de":
				return "de.gif";
			case "dm":
				return "dm.gif";
			case "be":
				return "be.gif";
			case "ca":
				return "ca.gif";
			default:
				return "unknown.gif";
		}
	}
		
	function GetTime($interval)
	{
		$ehours = floor(($interval % 86400) / (3600)); // get hours
		 $emins = floor((($interval % 86400) % 3600) / 60); // get mins
		 $esecs = floor((($interval % 86400) % 3600) % 60); // get secs
		
		$time = $ehours."h - ".$emins."m - ".$esecs."s";
		return $time;
	}
	
	function CheckLog()
	{
		if (is_dir($this->IPath))
			$this->TLogByDay();
		else
		{
			?>
			<script>
				alert("-= VERY IMPORTANT MESSAGE =- \n\n You must create a folder in Webanalyse called log with CHMOD 0770 !\n please look at the file ReadMeFirst before starting.")
			</script>
			<?
		}

		if (file_exists($this->SerFileYear))
			return true;
		else
			return false;	
	}
	
	function WsOverUrl($attrib = '', $data = '', $Url = '')
	{
		global $SCRIPT_URL;
		global $REQUEST_URI;
		
		if (empty($attrib))
			if ($Url == 'SCRIPT')
				return $SCRIPT_URL;
			else
				return $REQUEST_URI;
		
		if (empty($Url))
			$Url = $REQUEST_URI;
		if ($Url == 'SCRIPT')
			$Url = $SCRIPT_URL;
	
		$tUrl = parse_url($Url);
		$Argu = $tUrl['query'];
		$Url = $tUrl['path'];
		$tArgu = array();
		if (!empty($Argu))
			$tArgu = explode('&', $Argu);
		$tDstArgu = array();
		$found = false;
		for ($i = 0; $i < count($tArgu) ; $i++)
		{
			$tInfo = explode('=', $tArgu[$i]);
			$param = $tInfo[0];
			$value = $tInfo[1];
			
			if ($param == $attrib)
				$found = true;
			if (($param == $attrib) && ($data != ''))
				$tDstArgu[] = "{$param}={$data}";
			if ($param != $attrib)
				$tDstArgu[] = $tArgu[$i];
		}
	
		if (!$found)
			$tDstArgu[] = "{$attrib}={$data}";
		
		$Argu = implode('&', $tDstArgu);
		if (!empty($Argu))
			$Url = "{$Url}?$Argu";
	
		return $Url;
	}

}
?>