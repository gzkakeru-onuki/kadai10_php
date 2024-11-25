<?php
session_start();
ini_set("display_errors", 1);

$name = $_POST["name"];
$password = $_POST["password"];
$mail = $_POST["mail"];

/* ①　データベースの接続情報を定数に格納する */
const DB_HOST = 'mysql:dbname=php_master;host=localhost';
const DB_USER = 'root';
const DB_PASSWORD = '';

//②　例外処理を使って、DBにPDO接続する
try {
    $pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
    echo '[ERROR]DbConnectError:' . $e->getMessage() . "\n";
    exit();
}

//３．データ登録SQL作成
$sql = "INSERT INTO users (name, email, password, created_at) VALUES (:name, :mail, :password, sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR); // セキュリティを考慮し、password_hash()を使用するのが理想
$status = $stmt->execute(); // SQL実行

//４．データ登録処理後
if ($status == false) { // 登録処理にエラーがあれば
    $error = $stmt->errorInfo();
    exit("SQLInsertError: " . $error[2]);
} else {
    // 直接セッションを設定する
    $_SESSION['name'] = $name; // 入力された名前をそのままセッションに保存
    header('Location: main.php');
    exit();
}
?>
