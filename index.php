<?php

session_start();
require_once "db.php";
db();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <!-- <link rel="stylesheet" href="./css/ress.css"> -->
    <link rel="stylesheet" href="./css/contents.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru&display=swap" rel="stylesheet">
    <script src="./js/main.js" defer></script>
    <title>leafing</title>
</head>
<div class="wrapper">
<body>
    <header>
        <div class="logo">
            <a href="index.php">
                <img src="images/HEW2022_Top_Logo.svg">
                <h1>Lefin</h1>
            </a>
        </div>
        
        <div class="search-box">
            <input type="text" id="search">
            <button id="searchButton">検索</button>
        </div>

    </header>

    <div class="global-navBox" id="global-navBox">
        <div class="global-nav" id="global-nav">
            <ul>
                <a href="index.php"><li class="nav-menu"><p>TOP</p></li></a>
                <?php
                if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                    echo '<a href="users/usage_contract.php"><li class="nav-menu"><p>Login</p></li></a>';
                  }else{
                echo'<a href="user/mypage.php"><li class="nav-menu"><p>MyPage</p></li></a>';
                  }
                ?>
                <a href=""><li class="nav-menu"><p>DM</p></li></a>
                <a href="contents/make/input.php"><li class="nav-menu"><p>Make</p></li></a>
            </ul>
        </div>
    </div>
    <button id="closeBtn">➡</button>
    
    <div class="contents-selection">
        <a href="" ><div class="content-menu">動画</div></a>
        <a href="" ><div class="content-menu">イラスト</div></a>
        <a href="" ><div class="content-menu">小説</div></a>
        <a href="" ><div class="content-menu">音楽</div></a>
    </div>
    
    
    <main>
        <div class="content-box">
            <h1>新着作品</h1>
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
                    echo '<a href="contents/contents_list/video_contents/id_' .$list_page["contents_id"]. '"><figure class = "thumbnail_list"><img src="contents/contents_list/video_contents/id_'.$list_page["contents_id"].'/'.$list_page["thumbnail"].'" width="300" height="200" alt=""><figcaption class = "list_title">'.$list_page["title"].'</figcaption></figure></a>';
                    echo PHP_EOL;
                    }
                    ?>
                </div>
        </div>
    </main>
    <script src="./js/scroll.js"></script>
</body>
</div>
<footer>
 <?php require_once('footer.html') ?>
</footer>
<!--
<footer>
    <div class="copy">
        <small>&copy; IH12C175_Gruop3</small>
    </div>
</footer> -->
</html>