<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../html/index.css">
    <title>login</title>
</head>
<body>
    <!-- ヘッダー -->
    <header>
        <a id="head" href="index.html">AnyQ</a>
    </header>
    <!-- ナビゲーションメニュー -->
    <nav>
        <ul>
            <li>about us</li>
            <li>contact</li>
        </ul>
    </nav>
    <main>
    <?php
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $help = $_POST['help'];

        echo "<p>お名前</p>" .
             "<p>" . $name . "</p>" . 
             "<p>Mail</p>" .
             "<p>" . $mail . "</p>" .
             "<p>お問い合わせ内容</p>" .
             "<p>" . $help . "</p>" ;

        echo "<input type='submit' value='送信'>"

    ?>

    </main>
    <!-- フッター -->
    <footer>AnyQ</footer>
</body>
</html>