<?php
session_start();
if(isset($_SESSION['id'])){
    header("Location:mypage.php");
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ登録</title>
    <link rel="stylesheet" type ="text/css" href="login.css">
</head>
<body>
    <header>
        <div class="headerbox1"></div>
        <div class="headerbox2"><img src="4eachblog_logo.jpg"></div>
        <div class="headerbox3"><a href="login.php">ログイン</a></div>
    </header>
    <main>
        <form action="mypage.php" method="post">
            <div class="form_contents">
                <div class="text">
                    <label class="label">メールアドレス</label><br>
                    <div class="input">
                        <input type="text" class="formbox" size="40" name="mail" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" 
                        value="<?php 
                        if(isset($_COOKIE['mail'])){
                        echo $_COOKIE['mail'];
                        }
                        ?>" required>
                    </div>
                </div>
                <div class="text">
                    <label class="label">パスワード</label><br>
                    <div class="input">
                        <input type="password" class="formbox" size="40" name="password" pattern="^[a-zA-Z0-9]{6,}$" 
                        value="<?php 
                        if(isset($_COOKIE['password'])){
                        echo $_COOKIE['password'];
                        }
                        ?>" required>
                    </div>
                </div>
                <div class="login_check">
                    <label><input type="checkbox" name="login_keep" class="formbox" size="40" value="login_keep" 
                    <?php 
                    if(isset($_SESSION['login_keep'])){
                        echo "checked='checked'";
                    }
                    ?>>ログイン状態を保持する</label>
                </div>
                <div class="submit_center">
                    <input type="submit" value="ログイン" class="submit">
                </div>
            </div>
        </form>
    </main>
    <footer>
    © 2018 InterNous.inc All rights reserved
    </footer>
</body>
</html>