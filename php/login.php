<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quiz_check</title>
</head>
<body>
    <h1>ユーザー登録画面</h1>
    <a href="../html/index.html">トップに戻る</a>
    <?php 
        //require_once(config.php);

        $pdo = new PDO(
            "mysql:dbname=AnyQ;host=localhost", "root", "root", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
        );

        if ($pdo) {
            echo "<p>データベース接続完了...</p>";
        }
        else {
            echo "<p>データベース接続に失敗しました...</p>";
        }

        if (!$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo "有効なメールアドレスではありません";
            return false;
        }

        try {
            $query = $pdo->prepare("SELECT * FROM USERS WHERE EMAIL = ?");
            $query->execute(array($_POST['email']));
            $row = $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }

        echo "<p>EMAILチェック完了</p>";
        
        if (!isset($row['email'])) {
            echo 'メールアドレスが存在しないか、パスワードが間違っています';
            return false;
        }

        if (password_verify($_POST['password'], $row['password'])) {
            session_regenerate_id(true);
            $_SESSION['email'] = $row['email'];
            echo "<p>ログイン完了</p>";
        }
        else {
            echo 'パスワードが間違っています';
        }

        

     
    ?>
</body>
</html>