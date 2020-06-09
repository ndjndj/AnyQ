<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>input sheet</title>
</head>
<body>
    <?php 
        if (isset($_POST["quiz"])) {
            $quiz_set_id = $_POST["quiz_set_id"];
            $quiz_number = $_POST["quiz_number"];
            $user_id = $_POST["user_id"];
            $quiz = $_POST["quiz"];
            $quiz_type = 1;
            date_default_timezone_set('Asia/Tokyo');
            $day = date("Y-m-d");

            
        }
        
        $pdo = new PDO(
            "mysql:dbname=AnyQ;host=localhost", "root", "root", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
        );

        if ($pdo) {
            echo "<p>データベース接続完了...</p>";
        }
        else {
            echo "<p>データベース接続に失敗しました...</p>";
        }

        $query = $pdo->prepare("INSERT INTO quiz SET quiz_set_id = ?, 
                                                     quiz_number = ?, 
                                                     user_id     = ?,
                                                     quiz        = ?, 
                                                     quiz_type   = ?,
                                                     created_at  = ?,
                                                     updated_at  = ?
        ");

        $query->bindParam("quiz_set_id", $quiz_set_id);
        $query->bindParam("quiz_number", $quiz_number);
        $query->bindParam("user_id", $user_id);
        $query->bindParam("quiz", $quiz);
        $query->bindParam("quiz_type", $quiz_type);
        $query->bindParam("created_at", $day);
        $query->bindParam("updated_at", $day);

        $query->execute(array($quiz_set_id, $quiz_number, $user_id, $quiz, $quiz_type, $day, $day));

        if ($query) {
            echo "<p>登録完了</p>";
        }
        else {
            echo "<p>登録に失敗しました</p>";
        }
    ?>
    
    <a href="../html/test.html">クイズ作成画面に戻る</a>
    <a href="../html/quiz_check_query.html">作成したクイズを確認する</a>
</body>
</html>