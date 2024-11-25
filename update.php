<?php include("./dbConfig.php"); ?>
<?php
//エラー表示
ini_set("display_errors", 1);

$id = $_POST["id"];
$caption = $_POST["caption"];

//1.  DB接続します
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=php_master;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DBConnectError' . $e->getMessage());
}

//データ更新SQL作成
$updateSql = "UPDATE posts SET caption=:caption, created_at=:created_at WHERE id=:id";
$updatestmt = $pdo->prepare($updateSql);
$updatestmt->bindValue(":caption", $caption, PDO::PARAM_STR);
$updatestmt->bindValue(":id", $id, PDO::PARAM_INT);
$updatestmt->bindValue(":created_at", date("Y-m-d H:i:s"), PDO::PARAM_STR);
$status = $updatestmt->execute();

if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $updatestmt->errorInfo();
    exit("SQLSellectError:" . $error[2]);
  }else {
    header("Location: main.php");
    exit();
  }
?>