<?php

class Database {
  
  //Get Connection to Server

function getConn() {

$host = "localhost";
$db = "school";
$user = "goi";
$pass = "1goigarg";

$dsn = 'mysql:host=' .$host . ';dbname=' . $db . ';charset=utf8';

try {
  $db = new PDO($dsn, $user, $pass);

  //it will show the error message
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $db;
  }
  catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }

}

}
