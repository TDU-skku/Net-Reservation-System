<?PHP
// 翌月、翌年を計算
if($_tm['mm']>0 && $_tm['mm']<12){
  $nyyyy = $_tm['yyyy'];
  $nmm = $_tm['mm'] + 1;
} else if ($_tm['mm'] == 12) {
  $nyyyy = $_tm['yyyy'] + 1;
  $nmm = 1;
} else {
  ;
}
echo <<<EOF
<HTML lang="ja">
<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<TITLE>ネット予約システム</TITLE>
</HEAD>
<BODY bgcolor="white">
	<p style="text-align:right;font-size:small">ようこそ　<b><font size=3>{$_ENV['REMOTE_USER']}</font></b>さん  (<b>ID: </b>{$_SERVER['PHP_AUTH_USER']}) </p>
<div name="head" align="center">
	<h1> 予約</h1>
	(<a href="{$_cfg[thishost]}{$_cfg[pwd]}/{$_cfg[thisname]}{$_SERVER[PATH_INFO]}">今月</a>)
		{$_tm[yyyy]} 年 {$_tm[mm]} 月	
	(<a href="{$_cfg['thishost']}{$_cfg['pwd']}/{$_cfg['thisname']}{$_SERVER['PATH_INFO']}?yyyy={$nyyyy}&mm={$nmm}">{$nmm} 月へ→</a>)
</div>
EOF;
?>