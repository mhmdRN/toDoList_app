<?php
include_once("config.php");
 
$stmt=$pdo->query("SELECT * FROM `task`");
$rs=[];
while($row=$stmt->fetch()){
    $rs=array_merge($rs,array($row['description'].$row['finished']));
}
$str=implode(",",$rs);
echo $str;