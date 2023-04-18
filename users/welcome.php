<?php
session_start();
//ログインしてなかったらログインページに戻す
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ 
            font: 14px sans-serif;
            text-align: center; 
        }
    </style>
</head>
<body>
    <h1 class="my-5">こんにちは、THS<?php echo htmlspecialchars($_SESSION["ths"]).htmlspecialchars($_SESSION["name"]); ?></b>さん。</h1>
    <p>五秒後にトップページに戻ります。</p>
    <p>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out</a>
    </p>
</body>
</html>

    <?php sleep(5);
    header("Location: ../index.php");?>