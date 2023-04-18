<?php
//XSS対策
function h($s){
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

//セッションにトークンセット
function setToken(){
    $token = sha1(uniqid(mt_rand(), true));
    $_SESSION['token'] = $token;
}

//セッション変数のトークンとPOSTされたトークンをチェック
function checkToken(){
    if(empty($_SESSION['token']) || ($_SESSION['token'] != $_POST['token'])){
        echo 'Invalid POST', PHP_EOL;
        exit;
    }
}

//POSTされた値のバリデーション
function validation($datas,$confirm = true)
{
    $errors = [];

    //学籍番号のチェック
    if(empty($datas['ths'])) {
        $errors['ths'] = '学籍番号を入力してください。';
    }else if(mb_strlen($datas['ths']) > 6) {
        $errors['ths'] = '学籍番号は"ths"を除いた数字5桁で入力してください。';
    }

    //ユーザー名のチェック
    if(empty($datas['name'])) {
        $errors['name'] = 'ユーザー名を入力してください。';
    }else if(mb_strlen($datas['name']) > 10) {
        $errors['name'] = 'ユーザー名は10文字以内で入力してください。';
    }

    //パスワードのチェック（正規表現）
    if(empty($datas["password"])){
        $errors['password']  = "パスワードを入力してください。";
    }else if(!preg_match('/\A[a-z\d]{8,100}+\z/i',$datas["password"])){
        $errors['password'] = "パスワードは8文字以内で入力してください。";
    }
    //パスワード入力確認チェック（ユーザー新規登録時のみ使用）
    if($confirm){
        if(empty($datas["confirm_password"])){
            $errors['confirm_password']  = "パスワードを再度入力してください。";
        }else if(empty($errors['password']) && ($datas["password"] != $datas["confirm_password"])){
            $errors['confirm_password'] = "入力されたパスワードが合致してません。";
        }
    }

    return $errors;
}