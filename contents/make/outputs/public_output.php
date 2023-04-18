<?php
//各outputに共通するもの

//session
session_start();

//ファンクション
require_once "../../../db.php";
//データベース接続
db();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>処理中</title>
</head>
<body>
  <?php
    if(!empty($_FILES['contents']['tmp_name']) && is_uploaded_file($_FILES['contents']['tmp_name'])) {
      $file_type = 'video/mp4';
      if (strpos($file_type,'video')!== false) {
        echo "1";
        require_once "./video_output.php";
      }elseif (strpos($file_type,'audio')!== false) {
        require_once "./";
        echo "2";
      }elseif(strpos($file_type,'image')!== false){
        require_once "./";
        echo "3";
      }else{
        echo $file_type;
      }
    }else{
      echo "失敗しました";
    }
  ?>
</body>
</html>