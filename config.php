<?php
try{
    $host='localhost';
    $user='root';
    $pass='';
    $dbname="todolist";
    $charset='utf8mb4';
    $dsn="mysql:host=$host;dbname=$dbname;charset=$charset";
    $options=[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES=>false];
    $pdo=new pdo($dsn,$user,$pass,$options);
}catch(\PDOException $e){
    throw new \PDOException($e->getMessage(),(int) $e->getCode());
}