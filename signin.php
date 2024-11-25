<?php include('./dbConfig.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/signin.css">
    <link href="https://fonts.googleapis.com/css?family=Anton rel=" stylesheet">
    <title>ログイン画面</title>
</head>

<body>
    <?php include("./title.php") ?>

    <div class="form-container">
        <form action="login.php" method="post">
            <div class="form-item">
                <p class="form-label">メールアドレス</p>
                <input class="form-input" type="text" placeholder="SnapPhoto@snap.com" name="mail" required>
                <p class="form-label">パスワード</p>
                <input class="form-input" type="password" name="password" placeholder="パスワードを入力" required>
            </div>
            <div class="form-submit">
                <input class="submit-Btn" type="submit" value="ログイン">
            </div>
        </form>
        <p class="signup-link">まだ登録されていない方は<a class="link-Btn" href="index.php">こちら</a></p>
    </div>
</body>

</html>