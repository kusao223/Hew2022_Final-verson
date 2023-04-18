<?php
session_start();
// セッション変数 $_SESSION["loggedin"]を確認。ログイン済だったらウェルカムページへリダイレクト
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/header_nav.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/home_tab.css">
    <title>Document</title>
</head>
<body>
    <header>
        <img src="image/HEW2022_Top_Logo (1).svg" alt="">

        <div class="search-box">
            <input type="text" id="search">
            <button id="searchButton">検索</button>
        </div>
    </header>

    <!-- main -->
    <div class="main">
        <div class="youser_img">
            <!-- <img src=$Home_photo alt="" id="Home_images"> -->
            <img src="image/test_home.jpg" alt="" id="Home_images">
            <!-- <img src=$Top_photo alt="" id="Top_images"> -->
            <span class="top_img"><img src="image/test_top.jpg" alt="" id="Top_images"></span>
        </div>
            
        <div class="youser_info">
            <span class="info_box">
                <h2 id="youser_name">
                    <?php echo htmlspecialchars($_SESSION["name"]); ?>
                </h2>
                <button class="follow" id="" >フォロー登録</button>                 
            </span>

            <p id="">フォロワー数</p> 
        </div>
        
        <p class="intro">自己紹介aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>

        <div class="tab_panel">
            <ul class="tab-group">
                <li class="tab tab-A is-active">動画</li>
                <li class="tab tab-B">画像</li>
                <li class="tab tab-C">コミュ二ティ</li>
                <li class="tab tab-D">いいね</li>
            </ul>

            <div class="panel-group">
                <div class="panel tab-A is-show">
                    <div class="img_box">
                        <img src="image/202321702253.jpg" alt="">
                    </div>
                </div>
                <div class="panel tab-B">
                    <div class="img_box">
                        <img src="image/test_top.jpg" alt="">
                    </div>
                </div>
                <div class="panel tab-C">
                    <p>コミュニティ</p>
                </div>
                <div class="panel tab-D">
                    <p>いいね</p>
                </div>
            </div>
        </div>        
    </div>


    <!-- nav -->
    <div class="global-navBox" id="global-navBox">
        <div class="global-nav" id="global-nav">
            <ul>
                <a href="../index.php"><li class="nav-menu"><p>TOP</p></li></a>
                <a href="./logout.php"><li class="nav-menu"><p>Logout</p></li></a>
                <a href=""><li class="nav-menu"><p>DM</p></li></a>
                <a href="contents/make/input.php"><li class="nav-menu"><p>Make</p></li></a>
            </ul>
        </div>
    </div>

    <footer>

    </footer>
</body>
<script src="./js/home_tab.js"></script>
</html>