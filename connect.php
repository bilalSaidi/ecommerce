<?php

$dsn = 'mysql:host=localhost;dbname=ecomarce';
$user = 'root';
$password = '';
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
);

try{

     $conn = new PDO($dsn,$user,$password,$option);
     $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


}catch (PDOException $e){
    echo 'Failed to Connect ' . $e->getMessage() ;
}