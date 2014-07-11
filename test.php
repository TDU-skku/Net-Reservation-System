<?PHP

// -- 設定 -- //
include ('conf.inc.php');
//require_once('conf.inc.php');
//echo "include 'conf.inc.php'<br />";

// -- サブルーチン -- //
include ('lib.inc.php');
//require_once('lib.inc.php');
//echo "include 'lib.inc.php'<br />";

// -- DBの利用 -- //
$dbh = dbSet();


//-- 前処理 --//

$_cfg['thishost'] = "http://".$_SERVER['HTTP_HOST'];
/*
$_cfg['thisurl'] = $_cfg['thishost]'.$_SERVER['SCRIPT_NAME'];
*/
$_cfg['pwd'] = dirname($_SERVER["SCRIPT_NAME"])."/";
$_cfg['thisname'] = basename($_SERVER['SCRIPT_NAME']);
$_PATH = split("\/", $_SERVER["PATH_INFO"]);

//-- 管理者特権 --//
$SuperUser = NULL;
if($_SERVER['PHP_AUTH_USER'] == 'web') $SuperUser = 'web';

//-- デバッグ --//
$DEBUG = ($_cfg['DEBUG'] && $_GET['DEBUG']) ? 1 : 0;
$SuperUser = ($DEBUG) ? 'DebugUser' :$SuperUser ;
if($DEBUG) include('debug.inc.php');

// -- 連想配列に代入 -- //
$_tm = setTime ($_GET['yyyy'], $_GET['mm'], $_GET['dd']);

$ID_LIST = importClubsList($clubsLIST);
importTimeTableList($timeTable);

?>

<?PHP
$log_file = "{$_cfg['logDir']}{$filedate}{$_PATH[1]}.log";

?>
// MAIN PROGRAM //
<?PHP require_once('header.html.php'); ?>
<?PHP //<HTML><BODY> ?>
<div name="main" align="center">
<?PHP if($_PATH[2] == 'edit' && $SuperUser) include ('editor.html.php'); ?>
<?PHP //if($_PHTH[2] == 'view' || $_PATH[2] == 'admin' || $_PATH[2] == 'edit') include ('calendar.html.php'); ?>
<?PHP include ('calendar.html.php'); ?>

<?PHP /*
print_r($clubsLIST); echo "<br />";
print_r($ID_LIST); echo "<br />";
print_r($timeTable); echo "<br />";
*/ ?>
<p>end.</p>
</div>
</BODY></HTML>