<?php
  //input.phpからの入力情報受け取り
  $title = $_POST['title'];
  $overview = $_POST['overview'];
try{
    //IDの末端を調べる
    $contents = $db -> exec('INSERT INTO contents SET contents_name = null, user_id = 0, title = null, genre_id = 1, thumbnail = null, overview = null');
    $pages_end = $db -> query('SELECT contents_id, contents_name, user_id, title, genre_id, thumbnail, overview FROM contents WHERE contents_id=(SELECT MAX(contents_id) FROM contents)');
    $page = $pages_end->fetch();
    
    //各データ名（投稿された年月日時分ID）
    //コンテンツのファイルデータを変数に格納
    $contents_name = date("YnjHis") . $page['contents_id'] . ".mp4";
    //サムネイルのファイルダーたを変数に格納
    $thumbnail = date("YnjHi") . $page['contents_id'] . ".jpg";
    
    //新しいフォルダ作成
    $new_folder = "../../contents_list/video_contents/id_" . $page['contents_id'];
    if (!file_exists($new_folder)){
      mkdir($new_folder,0777,true);
    }
    //新しいファイル作成
    $new_file =  "<?php $" . "contents_id = " . $page['contents_id'] . "; ?>\n";
    $new_file .=file_get_contents('../templates/video_template.php');
    file_put_contents("../../contents_list/video_contents/id_" . $page['contents_id'] ."/index.php" , $new_file);
    
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
    //サムネイル↓
    if(!empty($_FILES['thumbnail']['tmp_name']) && is_uploaded_file($_FILES['thumbnail']['tmp_name'])) {
      
      // ファイルを指定したパスへ保存する
      if(move_uploaded_file($_FILES['thumbnail']['tmp_name'], $new_folder.'/'.$thumbnail)) {
      } else {
        echo 'アップロードされたファイルの保存に失敗しました。';
      }
    }else{
      if(empty($_FILES['thumbnail']['tmp_name'])){
        file_put_contents("../../contents_list/video_contents/id_" . $page['contents_id'] ."/". $thumbnail , file_get_contents('./no_image_logo.png'));
        echo "サムネイル未設定";
      }else{
        echo "エラーが発生しました。";
      }
    }
    //テーブルへの書き込み
    $updert = $db -> prepare('UPDATE contents SET contents_name =:contents_name,  title =:title,thumbnail =:thumbnail,overview =:overview  WHERE contents_id =:contents_id');
    $updert->bindValue(':contents_name', $contents_name);
   // $updert->bindValue(':user_id', $user_id);
    $updert->bindValue(':title', $title);
    //$updert->bindValue(':genre_id', $genre_id);
    $updert->bindValue(':thumbnail', $thumbnail);
    $updert->bindValue(':overview', $overview);
    $updert->bindValue(':contents_id', $page['contents_id']);

    $updert->execute();
    
    echo "投稿が完了しました。作品ページに移動します";
    header("refresh:3;url=../../contents_list/video_contents/id_" .$page["contents_id"] );
  }catch(PDOException $e){
    echo $e;
    die();
  }
  ?>