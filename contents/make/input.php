<?php
//session_start();
//if(empty($_SESSION['user_id'])){
//  header('Location: login.php');
//  exit;
//}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page['title']; ?></title>
  <link rel="stylesheet" href="../../css/contents_main.css">
  <link rel="stylesheet" href="../../css/header_nav.css">
  <link rel="stylesheet" href="../../css/common.css">
  <link rel="stylesheet" href="../../css/main.css">
</head>
<body oncontextmenu="return false;">
<body>
<header>
<a href="../../index.php"><img src="../../HEW2022_Top_Logo (1).svg" alt=""></a>

<div class="search-box">
  <input type="text" id="search">
  <button id="searchButton">検索</button>
</div>
</header>
<style>
  body{
    height: ;
  }
  header.logo{
    margin:0;
    top:10
  }
 .title{
  height: 175px;
 }
}
 .contents{
   height:5vw;
 }
}
 .thumbnail{
   height:5vw;
 }
}
 .overview{
   height:5vw;
 }
</style>
<div class="input"></div>
  <form action="outputs/public_output.php" method="post" enctype="multipart/form-data">
    <div class = "title">作品タイトル:<input type = "text" name="title" required></div>
    <hr>
    <div class = "contents">作品アップロード<input type="file" name ="contents" required></div>
    <hr>
    <div class = "thumbnail">作品サムネイル<input type="file" name="thumbnail"></div>
    <hr>
    概要<textarea name="overview" rows="10" wrap ="hard"></textarea>
    <input type="submit" value="投稿">
  </form>
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