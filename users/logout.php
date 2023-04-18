<?php
session_start();

//セッション変数の削除
$_SESSION = [];
//セッション削除
session_destroy();

//ログインページへリダイレクト
header("location: login.php");
exit;