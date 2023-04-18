<?php
// データベース接続
$dsn = 'mysql:dbname=chat_database;';
$user = 'root';
$password = 'root';
$options = array(
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false,
);
try {
  $dbh = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
  exit();
}

// メッセージの送信
if (isset($_POST['message'])) {
  $message = $_POST['message'];
  $recipientId = $_POST['recipient_id'];
  $sql = 'INSERT INTO messages (sender_id, recipient_id, message) VALUES (?, ?, ?)';
  $stmt = $dbh->prepare($sql);
  $stmt->execute([$userId, $recipientId, $message]);
}
?>
