<?php
session_start();
require_once "HEW_2_ALL/db.php";
db();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bord</title>
    <style>
        *{
    margin: 0;
    padding: 0;
    width: 100%;
}

header{
    color: #fff;
    background-color: #c00;
    border-bottom: solid 1px #fff;
    display: flex;
    justify-content: space-between;
    padding: 30px 0;
}

.header_left{
    width: 40%;
    padding-top: 1%;
    padding-left: 20px;
    font-size: 24px;
}

.header_right{
    width: 60%;
}

.title{
    border-bottom: solid 3px #fff;
    padding-bottom: 10px;
}

.info{
    padding-top: 10px;
}

.frame{
    margin-left: 5%;
    width: 90%;
    margin-bottom: 50px;
}

.overview{
    text-decoration: none;
    color: #fff;
    background-color: #c33;
    margin-bottom: 2%;
}

span{
    font-weight: bold;
    color: #f00;
}
.sentence{
    font-size: 27px;
}

.sentences{
    width: 75%;
}

.words{
    width: 20%;
}

.movies{
    width: 80%;
}

.sells{
    font-size: 30px;
}

footer{
    position: absolute;
    bottom: 0;
    background-color: #c00;
    color: #fff;
    text-align: right;
}

small{
    padding-right: 10px;
}
    </style>
</head>
<body>
    
    <header>
        <div class="header_left">
            <h1>IT42 - 303</h1>
        </div>

        <div class="header_right">
            <div class="title">
                <h2>Leafin(リーフィン)</h2>
            </div>
            <div class="info">
                <p>4年生課程2年 高度情報学科 チーム名 CRAFT-BOSS</p>
            </div>
        </div>
    </header>

    <p class="overview">■作品概要</p>
    <div class="frame">
        <div class="sentence">

            <p class="sentences"><span>誰でも</span>、投稿された作品を自分の「<span>好き</span>」に合わせ、<span>手軽に</span>、<span>手元で</span>楽しめる。</p>
            <p>総合ネットコンテンツの<span>投稿プラットフォーム</span>!</p>

        </div>
    </div>

    <p class="overview">■作品一覧</p>
    <div class="frame">

        <div class="words">
            <p>「<span>好き</span>」をつなげて誰も予想しないコンテンツを<span>盛り上げてみよう</span>!</p>
            <?php
                    $pages_end = $db -> query('SELECT contents_id, contents_name, user_id, title, genre_id, thumbnail, overview FROM contents WHERE contents_id=(SELECT MAX(contents_id) FROM contents)');
                    $page = $pages_end->fetch();
                    $number = rand(1,$page['contents_id']);
                    $select_page = $db ->query('SELECT contents_id, contents_name, user_id, title, genre_id, thumbnail, overview FROM contents WHERE contents_id = '.$number.'');
                    $list_page = $select_page->fetch();

                    echo '<a href="contents/contents_list/video_contents/id_' .$list_page["contents_id"]. '"><figure class = "thumbnail_list"><img src="contents/contents_list/video_contents/id_'.$list_page["contents_id"].'/'.$list_page["thumbnail"].'" width="300" height="200" alt=""><figcaption class = "list_title">'.$list_page["title"].'</figcaption></figure></a>';
                    echo PHP_EOL;
                    ?>
                </div>
        </div>

        <div class="movies">
            <iframe src="" frameborder="0"></iframe>
        </div>

    </div>

    <p class="overview">■セールスポイント</p>
    <div class="frame">
        <p class="sells"><span>閲覧から投稿まで一つでできるSNS。</span></p>
        <p class="sells"><span>投稿された作品なら、誰でもダウンロードができる。</span></p>
    </div>

    <footer><small>学校法人・専門学校 HAL東京</small></footer>
</body>
</html>