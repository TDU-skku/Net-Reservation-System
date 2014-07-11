<?php

// ## DataBase ## //
  $_cfg['dbType'] = 1;
    // 1 = sqlite, 2 = mysql, 0 = ERROR.
  $_cfg['dbUser'] = 'root';
  $_cfg['dbPass'] = 'passwd';
  $_cfg['dbName'] = "net_reservaton";
  $_cfg['dbHost'] = "localhost";
  $_cfg['dbPort'] = "";

// ## General ## //
  $_cfg['placeList'] = "place.txt";
  $_cfg['memberList'] = "../account/group/member.dat";
  $_cfg['ex-memberList'] = "ex-member.txt";
  $_cfg['timeTable'] = "time-table.txt";
  
  $_cfg['logDir'] = "logs/";
  $_cfg['DEBUG'] = "TRUE";

?>
