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

        if (isset($_POST['user_name'])) {
            $user_name = $_POST['user_name'];
            echo "<p>ユーザー名チェック完了</p>";
        }

        if (!$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo "有効なメールアドレスではありません";
            return false;
        }
        echo "<p>EMAILチェック完了</p>";
        
        if ( preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password']) ) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            echo "<p>パスワードチェック完了</p>";
        }
        else {
            echo 'パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください';
            return false;
        }

        
        try {
            $query = $pdo->prepare("INSERT INTO users SET 
                                                            user_name = ?,
                                                            email     = ?, 
                                                            password  = ?");
            $query->bindparam(1, $user_name, PDO::PARAM_STR);
            $query->bindparam(2, $email, PDO::PARAM_STR);
            $query->bindparam(3, $password, PDO::PARAM_STR);
            $query->execute(array($user_name, $email, $password)); 
        
        } catch (\Exception $e) {

            echo "登録済みのメールアドレスです";
            return false;
        }

        echo "<p>ユーザー登録が完了しました！</p>"

     
    ?>
</body>
</html>