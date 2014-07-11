<?PHP
//print "<a href=\"$ThisFile/$place/reserve/\">予約の申請をする</a><br>\n";
//##CALENDAR>>
echo "CALENDAR";
echo <<<EoD
	<TABLE BORDER="1" WIDTH="500" CELLPADDING="1" CELLSPACING="1">
		<TR>
			<TH ALIGN="center" WIDTH="10" HEIGHT="20" bgcolor="#CCFFFF" NOWRAP><span class="nowrap">__</span></TH>
			<TH ALIGN="center" WIDTH="10" HEIGHT="20" bgcolor="#FF0033" NOWRAP><span style="color:#F8F8FF;"><B>日</B></span></TH>
			<TH ALIGN="center" WIDTH="10" HEIGHT="20" bgcolor="#D2691E" NOWRAP><span style="color:#F8F8FF;"><B>月</B></span></TH>
			<TH ALIGN="center" WIDTH="10" HEIGHT="20" bgcolor="#D2691E" NOWRAP><span style="color:#F8F8FF;"><B>火</B></span></TH>
			<TH ALIGN="center" WIDTH="10" HEIGHT="20" bgcolor="#D2691E" NOWRAP><span style="color:#F8F8FF;"><B>水</B></span></TH>
			<TH ALIGN="center" WIDTH="10" HEIGHT="20" bgcolor="#D2691E" NOWRAP><span style="color:#F8F8FF;"><B>木</B></span></TH>
			<TH ALIGN="center" WIDTH="10" HEIGHT="20" bgcolor="#D2691E" NOWRAP><span style="color:#F8F8FF;"><B>金</B></span></TH>
			<TH ALIGN="center" WIDTH="10" HEIGHT="20" bgcolor="#4169E1" NOWRAP><span style="color:#F8F8FF;"><B>土</B></span></TH>
		</TR>
EoD;
	$idx1=0; $week=0;$cflg=0;

while($idx1 < 40) {
	$week++;
	$tlsMAX = count($timeTable);
	for($tls=0;$tls<$tlsMAX;$tls++) {
		echo "<TR>"; 
		if($tls == 0) {
			echo <<<EoD
				<TD ALIGN="center" WIDTH="10" HEIGHT="20" bgcolor="#D3D3D3" NOWRAP><span class="nowrap"> <br /> </span></TD>
EoD;
					/* <DEBUG 
					$color = "#99FFFF";
					$text = $days[$idx2];
					$title = "{$idx2} - {$idx1}";
					  DEBUG> */
				for($idx2=($week-1)*7+1;$idx2<=($week)*7;$idx2++) {
					$days[$idx2] = $idx2 - $_tm[mStart];
					if((int)($days[$idx2] <= 0)) {
						$title = "";
						$text = "<br />";
						$color = "#666666";
					} else if((int)($days[$idx2] <= $_tm[mEnd])) {
						if($_tm[mday] > $days[$idx2] && $_tm[mon] == $_tm[mm] && $_tm[year] == $_tm[yyyy]) {
							$color = "#3399CC";
						} else if($days[$idx2] == $_tm[mday] && $_tm[mm] == $_tm[mon] && $_[yyyy] == $_tm[year]) {
							$color = "#FFFF66";
						} else {
							$color = "#99FFFF";
						}
						$yyyy = sprintf("%04d", $_tm[yyyy]);
						$mm = sprintf("%02d",$_tm[mm]);
						$dd = sprintf("%02d",$day[$idx2]);
						$title = "{$yyyy}/{$mm}/{$dd}";
						$text = $days[$idx2];
						
					} else {
						$title= "...";
						$text = "<br />";
						$color = "#666666";
					}
					//debuglog("Debug: calendar:31 #if({$_tm[yyyy]}/{$_tm[mm]}/{$days[$idx2]}  {$_tm[year]}/{$_tm[mon]}/{$_tm[mday]} : {$_tm[dd]})\\n");
					echo <<<EoD
				<TD ALIGN="center" HEIGHT="20" WIDTH="80" BGCOLOR="${color}" TITLE="${title}" style="cursor:pointer;white-space:nowrap;">${text}</TD>
EoD;
					$idx1++;
				}
			} else {
				echo <<<EoD
				<TH ALIGN="center" HEIGHT="20" bgcolor="#FF9966" NOWRAP><FONT SIZE="1">$timeTable[$tls]</FONT></TH>\n
EoD;
				for($idx2=($week-1)*7+1;$idx2<=($week)*7;$idx2++) {
					$link = "";
					if($days[$idx2] <= 0) {
						$title= "NG.";
						$color = "#AAAAAA";
						$text = "X1X";
					} else if($days[$idx2] <= $_tm[mEnd]) {
						if($SuperUser) {
							$nolink = "0";
						} else if($days[$idx2] -1 <= $_tm[mday] && $_tm[mm] == $_tm[mon] && $_tm[yyyy] == $_tm[year]) {
							$nolink = "1";
						} else {
							$nolink = "0";
						}
						$yyyy = sprintf("%04d", $_tm[yyyy]);
						$mm = sprintf("%02d",$_tm[mm]);
						$dd = sprintf("%02d",$days[$idx2]);
						$date = "{$yyyy}/{$mm}/{$dd}";
						$title = $clubsLIST[$CALENDAR[$date][$tls][0]][1];
						
						$color = "#98FB98";
						if($SuperUser){
							if($CALENDAR[$date][$tls][1] == 2){
								$link = "$ThisFile/$place/edit/?yyyy=$yyyy&mm=$mm&dd=$dd&times=$tls&UserID=$CALENDAR{$date}[$tls][0]&exec=admin";
								$text = "\"{$clubsLIST[$CALENDAR[$date][$tls][0]][0]}\""; 
								$color = "#ffd700";
								if(!$text){
									$text = "NoName.";
								}
							} else {
								$link = "$ThisFile/$place/edit/?yyyy={$yyyy}&mm={$mm}&dd={$dd}&times={$tls}";
								$text = "{$clubsLIST[$CALENDAR[$date][$tls][0]][0]}";
							}
						} else {
							
							if($CALENDAR[$date][$tls][1] == 9){
								$link = "";
								$text = $clubsLIST[$CALENDAR[$date][$tls][0]][0]; 
							} else if ($CALENDAR{$date}[$tls][1] == 2) {
								$link = "";
								$title = "承認中...";
								$text = " △ "; 
								if($CALENDAR[$date][$tls][0] == $_ENV['REMOTE_USER']) {
									$link = "$ThisFile/$place/edit/?yyyy=$yyyy&mm=$mm&dd=$dd&times=$tls&UserID=$CALENDAR{$date}[$tls][0]&exec=cancel";
									$title = "キャンセルする";
								}
							} else if ($CALENDAR[$date][$tls][1] == 4) {
								$link = "";
								$text = " × ";
							} else if(($idx2 == ($week-1)*7+1 || $idx2 == ($week)*7) && $CALENDAR{$date}[$tls][1] == 0) {
								$text = " -- ";
								$title = "お休みかも";
								$link = "$ThisFile/$place/reserve/?yyyy=$yyyy&mm=$mm&dd=$dd&times=$tls";
							} else {
								$text = " ○ ";
								$link = "$ThisFile/$place/reserve/?yyyy=$yyyy&mm=$mm&dd=$dd&times=$tls";
							}
						}					
					} else {
						$title= "NG.";
						$intext = "X2X";
						$color = "#AAAAAA";
						$text = "{$intext}";
					}
					if($link && !($nolink)) $text = "<a href=\"{$link}\">{$text}</a>";
					echo <<<EoD
					    <TD ALIGN="center" HEIGHT="20" WIDTH="80" BGCOLOR="$color" TITLE="{$title}" style="cursor:pointer;white-space:nowrap;">{$text}</TD>\n
EoD;
				}

			}
				print "</TR> \n \n";
		}
		/*
		if($idx1 >= $_tm[mEnd]+$_tm[mStart]) {
		  $cflg = 1;
		  last;
		}
		if($idx1 > 40) {
		  $cflg = 1;
		  last;
		}
		*/
	}
echo "</TABLE>";