<?php
/*
    Virtual Database
   @author  : FilthyRoot
   @date    : 03.04.2019
   @version : 1.0.1
   @github  : http://github.com/soracyberteam/
   @website : http://socyte.space/
   
   Copyright (c) FilthyRoot Sora Cyber Team
*/
include 'db.php';
$database_id='virtual_db';
$version_cfg="1.0.1 [Beta Release]";
$database_cfg=count($db["$database_id"]);
if($database_cfg == 0){
    $database_cfg="<font color='red'>Empty</font>";
}else{
    $x=count($db["$database_id"]);
    $y=count($db["$database_id"]) / 2;
    $jumlah=$x - $y;
    $database_cfg="<font color='lime'>".$jumlah."</font>";
}

