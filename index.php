<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link href="https://fonts.googleapis.com/css?family=Anton rel=" stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>サインアップ画面</title>
</head>

<body>
    
    <?php include("./title.php") ?>
    <div class="form-container">
        <form action="register.php" method="post">
            <div class="form-item">
            <p class="form-label">ユーザ名</p>
            <input id="name" class="form-input" type="text" placeholder="Mr_Snapman" name="name" required>
                <p class="form-label">メールアドレス</p>
                <input class="form-input" type="text" placeholder="SnapPhoto@snap.com" name="mail" required>
                <p class="form-label">パスワード</p>
                <input class="form-input" type="password" name="password" placeholder="パスワードを入力" required>
            </div>
            <div class="form-submit">
                <input class="submit-Btn" type="submit" value="アカウント登録">
            </div>
        </form>
        <p class="signup-link">既に登録されている方は<a class="link-Btn" href="signin.php">こちら</a></p>
    </div>
</body>

</html>