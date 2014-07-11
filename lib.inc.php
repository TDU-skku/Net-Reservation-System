<?PHP /* 関数等 */

function DEBUG(){
	return;
}

// ツェラーの公式
function wday ($year,$month,$day) {
	if($month<3){ $month += 12; $year--; }
	return ($year+(int)($year/4)-(int)($year/100)+(int)($year/400)+(int)((13*$month+8)/5)+$day)% 7;
}

// 時間等を取得
function setTime ($get_yyyy, $get_mm, $get_dd) {
	date_default_timezone_set('Asia/Tokyo');
	// 現在時刻を代入
	$tm = getdate();

	//もし、日付指定がないなら今日を指定する。
	/*
	$yyyy = ($get_yyyy) ? sprintf("%04d",$get_yyyy) : sprintf("%04d",$tm['year']);
	$mm = ($get_mm) ? sprintf("%02d",$get_mm) : sprintf("%02d",$tm['mon']);
	$dd = ($get_dd) ? sprintf("%02d",$get_dd) : sprintf("%02d",$tm['mday']);
	*/
	$yyyy = ($get_yyyy) ? (int)$get_yyyy : $tm['year'];
	$mm = ($get_mm) ? (int)$get_mm : $tm['mon'];
	$dd = ($get_dd) ? (int)$get_dd : $tm['mday'];

	// 月の末日の指定（左から順に1月、2月・・・）
	$mdays = array(31,28,31,30,31,30,31,31,30,31,30,31);

	// うるう年の判定（4の倍数ならうるう年、しかし100の倍数ならうるう年でない、また400の倍数ならうるう年）
	if( (($yyyy%4 ==0)&&($yyyy%100 != 0))||($yyyy%400 == 0) ) $mdays[1]=29;

	// 月の初日の曜日（ツェラーの公式）、月の末日を取得
	$wdayStart= wday($yyyy,$mm,1);	$monEnd = $mdays[$mm-1];
	
	return array('yyyy'=>$yyyy, 'year' => $tm['year'], 'mm'=>$mm, 'mon' => $tm['mon'], 'dd'=>$dd, 'mday' => $tm['mday'], 'mStart'=>$wdayStart, 'mEnd'=>$monEnd);
}

// DBの初期化
function dbSet () {
	//echo "fnc dbSet()<br />";
	global $_cfg;
		switch ($_cfg['dbType']) {
		case 1:
			$dsn = "sqlite:{$_cfg['dbName']}.db3";
			$userId = NULL;
			$passwd = NULL;
			break;
		case 2:
			$dsn = "mysql:dbname={$_cfg['dbName']}; host={$_cfg['dbHost']}; port={$_cfg['dbPort']}";
			$userId = $_cfg['dbUser'];
			$passwd = $_cfg['dbPass'];
			break;
		default:
			$dsn = "T:{$_cfg['dbType']},N:{$_cfg['dbName']}";
			$userId = $_cfg['dbUser'];
			$passwd = $_cfg['dbPass'];
			break;
	}
		//echo "PDO({$dsn}, {$userId}, {$passwd})";

	try{
		$dbh = new PDO($dsn, $userId, $passwd);
	}catch (PDOException $e){
		print('Connection failed:'.$e->getMessage());
		die();
	}

	return $dbh;
}

function dbTable ($confFile) {
	return;
}
	
function importClubsList (&$clubsLIST) {
	global $_cfg;
	$fp = fopen($_cfg[memberList], "r");
	while ($line = fgets($fp)) {
		rtrim($line,"\n");
		$line = mb_convert_encoding($line, "UTF-8", "SJIS-win");
		$val = explode ("<>", $line);
		if ($val[0] > 0) {
			$clubsLIST[$val[3]][0] = $val[1];
			$clubsLIST[$val[3]][1] = $val[2];
			$ID_LIST[] = $val[3];
		}
	}
	fclose($fp);
	$fp = fopen($_cfg['ex-memberList'], "r");
	while ($line = fgets($fp)) {
		$id++;
		$exid = sprintf("ex-%03d",$id);
		rtrim($line, "\n");
		$line = mb_convert_encoding($line, "UTF-8", "SJIS-win");
		$val = explode("<>", $line);
		$clubsLIST[$exid][0] = $val[0];
		$clubsLIST[$exid][1] = $val[1];
		$ID_LIST[] = $exid;
	}
	fclose($fp);
	return $ID_LIST;
}

function importTimeTableList (&$timeTable) {
	global $_cfg;
	$timeTable[] = "**:** - **:**"; 
	$fp = fopen ($_cfg[timeTable], "r");
	while ($line = fgets($fp)) {
		$line = mb_convert_encoding($line, "UTF-8", "SJIS-win");
		rtrim($line,"\n");
		$timeTable[] = $line;
	}
	fclose($fp);
}

?>