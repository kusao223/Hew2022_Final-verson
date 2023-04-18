<?php

$dsn  = 'mysql:host=localhost;dbname=HEW2;charaset=utf8mb4';
$db_user = 'root';
$db_password = 'root';

try {
    $pdo = new PDO($dsn,$db_user,$db_password,[
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES =>false
    ]);
} catch (PDOException $e) {
    // echo 'ERROR: Could not connect.'.$e->getMessage()."\n";
    exit();
}
