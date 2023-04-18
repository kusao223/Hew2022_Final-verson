<?php $contents_id = 8; ?>
<?php
//ファンクション
require_once "../../../../db.php";
//データベース接続
db();
$pages= $db -> query('SELECT * FROM contents WHERE contents_id="' .$contents_id. '"');
$page = $pages->fetch();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page['title']; ?></title>
  <link rel="stylesheet" href="../../../../css/contents_main.css">
  <link rel="stylesheet" href="../../../../css/header_nav.css">
  <link rel="stylesheet" href="../../../../css/common.css">
  <link rel="stylesheet" href="../../../../css/main.css">
</head>
<body oncontextmenu="return false;">
<header>
    <a href="../../../../index.php"><img src="../../../../HEW2022_Top_Logo (1).svg" alt=""></a>

    <div class="search-box">
      <input type="text" id="search">
      <button id="searchButton">検索</button>
    </div>
  </header>


  <div class="warpper">
    <div class="l_contents">
      <div class="main_contents">
        <div class="video_wrapper">
          <?php echo "<video src='".$page['contents_name']."' type='video/mp4' controls controlsList='nodownload' preload='none' poster=". $page['thumbnail']." ></video><br>"; ?>
          <h3><?php echo "{$page['title']}<br>"; ?></h3>
          <p><?php echo "{$page['overview']}<br>"; ?></p>

          <div class="youser_info">
            <img src="image/test_top.jpg" alt="">
            <div class="info_box">
                <p id="youser_name">youserName</p>
                <p id="">フォロワー数</p>          
            </div>
          <button class="follow" id="" >フォロー登録</button>
        </div>  
      </div>
    </div>
      
    <div class="content-box">
      <div class = "contents_list">
        <?php
        $pages_end = $db -> query('SELECT contents_id, contents_name, user_id, title, genre_id, thumbnail, overview FROM contents WHERE contents_id=(SELECT MAX(contents_id) FROM contents)');
        $page = $pages_end->fetch();
        $last_page = $page['contents_id'] - 4;
        for ($i=$page['contents_id']; $i >=$last_page ; $i--) {
          if ($i == 0) {
            break;
          }
          $select_page = $db ->query('SELECT contents_id, contents_name, user_id, title, genre_id, thumbnail, overview FROM contents WHERE contents_id = '.$i.'');
          $list_page = $select_page->fetch();
          echo '<a href="../id_' .$list_page["contents_id"]. '"><figure class = "thumbnail_list"><img src="../id_'.$list_page["contents_id"].'/'.$list_page["thumbnail"].'" width="300" height="200" alt=""><figcaption class = "list_title">'.$list_page["title"].'</figcaption></figure></a>';
          echo PHP_EOL;
        }
        ?>
    </div>
  </div>
      </div>
  <div class="r_contents">
      <div class="comment">

      </div>
    </div>
  <div class="global-navBox" id="global-navBox">
    <div class="global-nav" id="global-nav">
        <ul>
            <a href="../../../../index.php"><li class="nav-menu"><p>TOP</p></li></a>
            <?php
                if(empty($_SESSION['user_id'])){
                    echo '<a href="../../../../users/login"><li class="nav-menu"><p>Login</p></li></a>';
                  }else{
                echo'<a href="u../../../../sers/index.php"><li class="nav-menu"><p>MyPage</p></li></a>';
                  }
                ?>
            <a href=""><li class="nav-menu"><p>DM</p></li></a>
            <a href="../../../../contents/make/input.php"><li class="nav-menu"><p>Make</p></li></a>
        </ul>
    </div>
  </div>
</body>
</html>
