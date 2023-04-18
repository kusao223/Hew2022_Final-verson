<?php
//旧投稿用画面

//ファンクション
require_once "../db.php";
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
    echo $_FILES['contents']['type'];
  }else{








  //input.phpからの入力情報受け取り
  $title = $_POST['title'];
  $overview = $_POST['overview'];
  $contents_genre = 1;

  //処理判定
  try{
    //IDの末端を調べる
    $contents = $db -> exec('INSERT INTO contents SET contents_genre =null, title = null, contents_name = null, overview = null, thumbnail = null');
    $pages_end = $db -> query('SELECT id, contents_genre, title, contents_name, overview, thumbnail FROM contents WHERE id=(SELECT MAX(id) FROM contents)');
    $page = $pages_end->fetch();
    
    //各データ名（投稿された年月日時分ID）
    //コンテンツのファイルデータを変数に格納
    $contents_name = date("YnjHis") . $page['id'] . ".mp4";
    //サムネイルのファイルダーたを変数に格納
    $thumbnail = date("YnjHi") . $page['id'] . ".jpg";
    
    //新しいフォルダ作成
    $new_folder = "../contents_list/video_contents/id_" . $page['id'];
    if (!file_exists($new_folder)){
      mkdir($new_folder,0777,true);
    }
    //新しいファイル作成
    $new_file =  "<?php $" . "id = " . $page['id'] . "; ?>\n";
    $new_file .=file_get_contents('video_template.php');
    file_put_contents("../contents_list/video_contents/id_" . $page['id'] ."/index.php" , $new_file);
    
    //アップロードされたファイルを指定フォルダに格納
    if(!empty($_FILES['contents']['tmp_name']) && is_uploaded_file($_FILES['contents']['tmp_name'])) {
      
      // ファイルを指定したパスへ保存する
      if(move_uploaded_file($_FILES['contents']['tmp_name'], $new_folder.'/'.$contents_name)) {
      } else {
        echo 'アップロードされたファイルの保存に失敗しました。';
      }
    }else{
      echo "error_1";
    }
    if(!empty($_FILES['thumbnail']['tmp_name']) && is_uploaded_file($_FILES['thumbnail']['tmp_name'])) {
      
      // ファイルを指定したパスへ保存する
      if(move_uploaded_file($_FILES['thumbnail']['tmp_name'], $new_folder.'/'.$thumbnail)) {
      } else {
        echo 'アップロードされたファイルの保存に失敗しました。';
      }
    }else{
      echo "サムネイル未設定";
    }
    //テーブルへの書き込み
    $updert = $db -> prepare('UPDATE contents SET contents_genre =:contents_genre, title = :title, contents_name =:contents_name,overview =:overview ,thumbnail =:thumbnail WHERE id =:id');
    $updert->bindValue(':contents_genre', $contents_genre);
    $updert->bindValue(':title', $title);
    $updert->bindValue(':contents_name', $contents_name);
    $updert->bindValue(':overview', $overview);
    $updert->bindValue(':thumbnail', $thumbnail);
    $updert->bindValue(':id', $page['id']);

    $updert->execute();
    
    echo "投稿が完了しました。作品ページに移動します";
    header("refresh:3;url=../contents_list/video_contents/id_" .$page["id"] );
  }catch(PDOException $e){
    echo $e;
    die();
  }
}
  ?>
</body>
</html>