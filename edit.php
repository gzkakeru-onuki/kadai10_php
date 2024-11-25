<?php include("./dbConfig.php"); ?>
<?php
//エラー表示
ini_set("display_errors", 1);

$id = $_GET["id"];

//1.  DB接続します
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=php_master;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DBConnectError' . $e->getMessage());
}

//２．データ登録SQL作成
$sql = "SELECT * FROM posts where id =:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("SQLSellectError:" . $error[2]);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード] 連想配列で全て入っている
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/edit.css">
    <link href="https://fonts.googleapis.com/css?family=Anton rel=" stylesheet">
    <title>Document</title>
</head>

<body>
    <?php include("./header.php") ?>
    <?php include("./title.php") ?>
    <div class="edit-container">
        <?php foreach ($values as $value) { ?>
            <form action="update.php" method="post" enctype="multipart/form-data">
                <div class="posts">
                    <img class="post-img" src="<?= $value['image_path']; ?>">
                    <textarea class="caption" placeholder="更新内容を入力" name="caption" value="<?= $value["caption"]; ?>"></textarea>
                    <input type="hidden" name="id" value="<?= $value["id"]; ?>"><br>
                    <button type="submit">更新</button>
                </div>
            </form>
            <form action="delete.php" method="post" enctype="multipart/form-data">
                <div class="posts">
                    <input type="hidden" name="id" value="<?= $value["id"]; ?>">
                    <button type="submit">削除</button>
                </div>
            </form>
        <?php } ?>
    </div>
    <?php include("./footer.php") ?>
</body>

</html>