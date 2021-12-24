<?php
try{
mb_internal_encoding("utf8");
//DB接続
$pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","mysql");
}catch(PDOException $e){
die("<p>申し訳ございません。現在サーバーが込み合っており一時的にアクセスが出来ません。<br>しばらくしてから再度ログインしてください。</p>
");
}
//prepared statement
$stmt = $pdo->prepare("insert into login_mypage(name,mail,password,picture,comments)values(?,?,?,?,?)");
$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['picture']);
$stmt->bindValue(5,$_POST['comments']);

//executeでクエリを実行
$stmt->execute();
$pdo = NULL;
header('Location:after_register.html');
?>