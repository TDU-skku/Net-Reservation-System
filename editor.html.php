<?PHP
echo <<<EOF
<FORM NAME="edit" ACTION="{$_cfg['thishost']}{$_cfg['pwd']}/{$_cfg['thisname']}/{$_PATH[1]}/admin" METHOD="post">
	<INPUT TYPE="hidden" NAME="yyyy" VALUE="$_tm[yyyy]">
	<INPUT TYPE="hidden" NAME="mm" VALUE="$_tm[mm]">
	<INPUT TYPE="hidden" NAME="dd" VALUE="$_tm[dd]">
	<INPUT TYPE="hidden" NAME="times" VALUE="$times">
	<INPUT TYPE="hidden" NAME="exec" VALUE="admin">
<TABLE BORDER=1 WIDTH="60%" BGCOLOR="#DDDDDD" CELLPADDING="10" CELLSPACING="0">
	<TR>
		<TD BGCOLOR="#FFFFFF" ALIGN="center" NOWRAP>
			{$_tm[yyyy]} 年 {$_tm[mm]} 月 {$_tm[dd]} 日　
			<!-- $timeLIST[$times]　 -->
			<SELECT NAME="UserID">
			</SELECT>　
			<INPUT TYPE="submit" NAME="" VALUE="登録する">
		</TD>
	</TR>
</TABLE>
</FORM>
EOF;
?>