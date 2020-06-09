<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quiz_check</title>
</head>
<body>
    <a href="../html/index.html">トップに戻る</a>
    <?php 
        if (isset($_POST["user_id"]) && isset($_POST["quiz_id"])) {   
            $quiz_id = $_POST["quiz_id"];
            $user_id = $_POST["user_id"];
        }

        $pdo = new PDO(
            "mysql:dbname=AnyQ;host=localhost", "root", "root", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
        );

        if ($pdo) {
            echo "<p>データベース接続完了...</p>";
            echo "<p>quiz_id is " . $quiz_id . "</p>";
            echo "<p>user_id is " . $user_id . "</p>";
        }
        else {
            echo "<p>データベース接続に失敗しました...</p>";
        }

        $lst = $pdo->prepare("SELECT QUIZ_SET_ID, QUIZ_NUMBER, USER_ID, QUIZ, QUIZ_TYPE 
                                FROM QUIZ 
                                WHERE QUIZ_SET_ID = ?
                                  AND USER_ID = ? ");

        $lst->bindparam(1, $quiz_id, PDO::PARAM_INT);
        $lst->bindparam(2, $user_id, PDO::PARAM_INT);
        $lst->execute(array($quiz_id, $user_id));
        
        if ($lst) {
            echo "<p>検索成功</p>";
        }
        else {
            echo "<p>検索失敗</p>";
        }

        while($row = $lst->fetch()) {
            echo "
                <h2>ユーザーID</h2>
                <p>{$row['USER_ID']}</p>

                <h2>クイズID</h2>
                <p>{$row['QUIZ_SET_ID']}</p>

                <h2>問番号</h2>
                <p>{$row['QUIZ_NUMBER']}</p>

                <h2>問題</h2>
                <p>{$row['QUIZ']}</p>

                <h2>クイズ形式</h2>
                <p>{$row['QUIZ_TYPE']}</p>
            
            ";
        }
     
    ?>
</body>
</html>