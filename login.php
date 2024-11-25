<?php
session_start();
ini_set("display_errors", 1);

$mail = $_POST["mail"];
$password = $_POST["password"];


/* ①　データベースの接続情報を定数に格納する */
const DB_HOST = 'mysql:dbname=php_master;host=localhost';
const DB_USER = 'root';
const DB_PASSWORD = '';

//②　例外処理を使って、DBにPDO接続する
try {
  $pdo = new PDO(DB_HOST,DB_USER,DB_PASSWORD);
} catch (PDOException $e) {
echo '[ERROR]DbConnectError:'.$e->getMessage()."\n";
exit();
}

//DBから該当のユーザ検索を実施
$sql = "SELECT * FROM users WHERE email = :mail AND password = :password";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

//SQL実行失敗処理
if ($status == false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLSellectError:" . $error[2]);
}

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user){
  $_SESSION['name']=$user['name'];
  header("Location: main.php");
  exit();
}else {
  echo "メールアドレスかパスワードが間違えています。<br>もしくは、アカウントが登録されていません。";
  exit();
}



?>

