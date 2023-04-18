<?php
// データベース接続情報
$servername = "mysql:dbname=chat_database;host=localhost";
$username = "root";
$password = "root";
$dbname = "mysql:dbname=chat_database;";

// データベースに接続する
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// メッセージを取得するSQLクエリ
$sql = "SELECT * FROM messages ORDER BY created_at DESC LIMIT 100";

// SQLクエリを実行する
$result = $conn->query($sql);

// 結果を取得する
$messages = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

// データベース接続を閉じる
$conn->close();
?>