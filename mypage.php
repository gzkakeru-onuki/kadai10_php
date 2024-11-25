
<?php include("./dbConfig.php"); ?>
<?php
session_start();
//エラー表示
ini_set("display_errors", 1);

$name = $_SESSION['name'];


//1.  DB接続します
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=php_master;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DBConnectError' . $e->getMessage());
}

//２．データ登録SQL作成
$sql = "SELECT * FROM posts WHERE name =:name ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
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
    <link rel="stylesheet" href="css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Anton rel=" stylesheet">
    <title>一覧画面</title>
</head>

<body>
    <?php include("./header.php") ?>
    <?php include("./title.php") ?>
    
    <!-- モーダルを開いた時の外側のレイヤー -->
    <div class="over-lay"></div>

    <div class="wrapper">
        <!--   モーダルを開くボタン -->
        <button class="modal-open-btn servBtn">
            NEW
        </button>
        <!--   モーダルウィンドウ -->
        <div class="modal">
            <form action="post.php" method="post" enctype="multipart/form-data">
                <label for="upload" class="uploadlabel">画像を選択</label>
                <input style="display: none;" type="file" name="image" required id="upload"><br>
                <textarea class="caption" name="caption" placeholder="キャプションを入力"></textarea><br>
                <button class="submitBtn" type="submit">投稿</button>
                <button class="modal-close-btn">閉じる</button>
            </form>
        </div>
    </div>

    <div class="post-container">
        <?php foreach ($values as $value) { ?>
            <div class="posts">
                <img class="post-img" src="<?= $value['image_path'];  ?>">
                <p class="post-name"><?=$value["name"];?></p>
                <p class="post-time"><?=$value["created_at"];?></p>
                <p class="post-caption"><?= $value["caption"]; ?></p>
            </div>
        <?php } ?>
    </div>
    <?php include("./footer.php") ?>
    <script>
        $(function () {
            // モーダルウィンドウを開くとき
            $('.modal-open-btn').on('click', function () {
                $('.modal, .over-lay').addClass('active');
            });

            // モーダルウィンドウを閉じるとき
            $('.modal-close-btn, .over-lay').on('click', function () {
                $('.modal, .over-lay').removeClass('active');
            });
        });

    </script>
</body>

</html>