<?php
mb_internal_encoding("utf8");
session_start();
if(empty($_SESSION['id'])){
    try{
        $pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","mysql");
    }catch(PDOException $e){
        die("<p>申し訳ございません。現在サーバーが込み合っており一時的にアクセスが出来ません。<br>しばらくしてから再度ログインしてください。</p>
        <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>"
        );
    }
    $stmt = $pdo->prepare("select * from login_mypage where mail = ? && password = ?");
    $stmt->bindValue(1,$_POST['mail']);
    $stmt->bindValue(2,$_POST['password']);
    $stmt->execute();
    $pdo = NULL;
    
    while($row = $stmt->fetch()){
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['mail'] = $row['mail'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['picture'] = $row['picture'];
        $_SESSION['comments'] = $row['comments'];
    }

    if(empty($_SESSION['id'])){
        header("Location:login_error.php");
    }
    if(!empty($_POST['login_keep'])){
        $_SESSION['login_keep']=$_POST['login_keep'];
    }
}
$image_path="./image/".$_SESSION['picture'];
if(empty($_SESSION['mail'])){
    header('Location:login_error.php');
}elseif(empty($_SESSION['password'])){
    header('Location:login_error.php');
}

if(!empty($_SESSION['id']) && !empty($_SESSION['login_keep'])){
    setcookie('mail',$_SESSION['mail'],time()+60*60*24*7);
    setcookie('password',$_SESSION['password'],time()+60*60*24*7);
    setcookie('login_keep',$_SESSION['login_keep'],time()+60*60*24*7);
} else if (empty($_SESSION['login_keep'])){
    setcookie('mail','',time()-1);
    setcookie('password','',time()-1);
    setcookie('login_keep','',time()-1);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ登録</title>
    <link rel="stylesheet" href="mypage.css">
</head>
<body>
    <header>
        <div class="headerbox1"></div>
        <div class="headerbox2"><img src="4eachblog_logo.jpg"></div>
        <div class="headerbox3"><a href="log_out.php">ログアウト</a></div>
    </header>
    <main>
        <div class="form">
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
                            <p>氏名：<?php echo $_SESSION['name']; ?></p>
                            <p>メール：<?php echo $_SESSION['mail']; ?></p>
                            <p>パスワード：<?php echo $_SESSION['password']; ?></p>
                        </div>
                    </div>
                    <div class="comments"><?php echo $_SESSION['comments']; ?></div>

                    <form class="form_center" action="mypage_hensyu.php" method="post">
                        <input type="hidden" value="<?php echo rand(1,10); ?>" name="form_center">
                        <div class="submit_input">
                            <input type="submit" class="submit_button" value="編集する">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer>
    © 2018 InterNous.inc All rights reserved
    </footer>
</body>
</html>