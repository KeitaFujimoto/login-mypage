<?php
mb_internal_encoding("utf8");

session_start();
try{
    $pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","mysql");
}catch(PDOException $e){
    die("<p>申し訳ございません。現在サーバーが込み合っており一時的にアクセスが出来ません。<br>しばらくしてから再度ログインしてください。</p>
    <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>"
    );
}
$stmt = $pdo->prepare("UPDATE login_mypage SET name = ?,mail = ?, password = ?,comments = ? WHERE id=?");
$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['comments']);
$stmt->bindValue(5,$_SESSION['id']);

$stmt->execute();

$stmt = $pdo->prepare("select * from login_mypage where id = :id");
$stmt->bindValue(':id',$_SESSION['id']);

$stmt->execute();
$pdo = NULL;

while($row = $stmt->fetch()){
    $_SESSION['name'] = $row['name'];
    $_SESSION['mail'] = $row['mail'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['comments'] = $row['comments'];
}
header('Location:mypage.php');
?>