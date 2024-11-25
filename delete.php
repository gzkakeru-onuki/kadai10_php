<?php include("./dbConfig.php"); ?>
<?php
//エラー表示
ini_set("display_errors", 1);

$id = $_POST["id"];

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=php_master;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
  exit('DBConnectError' . $e->getMessage());
}

//データ更新SQL作成
$deleteSql = "DELETE FROM  posts WHERE id=:id";
$deletestmt = $pdo->prepare($deleteSql);
$deletestmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $deletestmt->execute();

if ($status == false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $deletestmt->errorInfo();
  exit("SQLSellectError:" . $error[2]);
} else {
  header("Location: main.php");
  exit();
}
?>