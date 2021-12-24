<?php
mb_internal_encoding("utf8");
session_start();
if(empty($_POST['form_center'])){
    header("Location:login_error.php");
}
$image_path="./image/".$_SESSION['picture'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ登録</title>
    <link rel="stylesheet" type="text/css" href="mypage.css">
</head>
<body>
    <header>
        <div class="headerbox1"></div>
        <div class="headerbox2"><img src="4eachblog_logo.jpg"></div>
        <div class="headerbox3"><a href="log_out.php">ログアウト</a></div>
    </header>

    <main>   
        <form action="mypage_update.php" class="form" method="post">
            <div class="form_contents">
                <h2>会員情報</h2>
                <div class="contents">
                    <p class="text"><?php echo $_SESSION['name']; ?>さん、こんにちは！</p>
                    <br>
                    <div class="info">
                        <div class="left">
                            <img src="<?php echo $image_path; ?>">
                        </div>
                        <div class="right">
                            <p>氏名：<input class="formbox" type="text" name="name" value="<?php echo $_SESSION['name']; ?>" required></p>
                            <p>メール：<input class="formbox" type="text" name="mail" value="<?php echo $_SESSION['mail']; ?>" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required></p>
                            <p>パスワード：<input class="formbox" type="text" name="password" value="<?php echo $_SESSION['password']; ?>" pattern="^[a-zA-Z0-9]{6,}$" required></p>
                        </div>
                    </div>
                    <div class="comments">
                        <textarea cols="65" rows="5" class="comments_input formbox" name="comments"><?php echo $_SESSION['comments']; ?></textarea>
                    </div>
                </div>
                <div class="submit_update">
                        <input type="submit" class="submit_updatebutton" value="この内容に変更する">
                    </div>
            </div>
        </form>
    </main>
    <footer>
    © 2018 InterNous.inc All rights reserved
    </footer>

</body>
</html>