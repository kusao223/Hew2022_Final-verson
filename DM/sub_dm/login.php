<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
</head>
<body>
  <?php
  // セッションの開始
  session_start();

  // ログイン処理
  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // データベース接続設定
    $dsn = 'mysql:dbname=chat_database;host=localhost';
    $user = 'root';
    $password = 'root';
    $options = array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    );

    try {
      // データベースに接続
      $dbh = new PDO($dsn, $user, $password, $options);

      // SQL実行
      $stmt = $dbh->prepare('SELECT id, username, password FROM users WHERE username = ?');
      $stmt->execute([$username]);

      // ユーザー情報の取得
      $user = $stmt->fetch();

      // パスワードのチェック
      if ($user && password_verify($password, $user['password'])) {
        // ログイン成功
        $_SESSION['user_id'] = $user['id'];
        header('Location: chat.php');
        exit;
      } else {
        // ログイン失敗
        echo 'Invalid username or password.';
      }
    } catch (PDOException $e) {
      // エラー処理
      echo 'Database connection failed: ' . $e->getMessage();
    }
  }
  ?>
  <form method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>
    <label for="password">Password:</label>
    <input type="password" name="password" required><br>
    <input type="submit" name="submit" value="Login">
  </form>
</body>
</html>
