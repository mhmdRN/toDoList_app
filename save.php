<?php
include_once("config.php");

if($_GET['task']!=""){
    $stmt=$pdo->prepare("INSERT INTO `task` (`description`,`finished`) VALUES(?,?)");
    $stmt->execute([$_GET['task'],$_GET['finished']]);
}else{
    echo "Something went wrong";
}