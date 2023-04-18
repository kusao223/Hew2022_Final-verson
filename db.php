<?php
function db(){
  try {
    //データベースの接続先情報
    $dbn = "mysql:dbname=HEW2;";
    $host = "host=localhost;";
    $user = "root";
    $pass = "root";
    global $db ;
    //データベースの接続
    $db= new PDO($dbn.$host,$user,$pass);
    
  }catch(PDOException $e){
    echo "エラー";
    die();
  }
}

