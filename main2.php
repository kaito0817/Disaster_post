<!DOCTYPE HTML>
<html lang="ja">

<head>
</head>

<body>
<h1>野々市市災害掲示板</h1>
    <form method="post" action="">
        ユーザー名:<input type="text" name="name" value=""><br><br>
        メッセージ:<input type="text" name="comment" value=""><br><br>
        投稿画像:<input type="file" name="picture" value=""><br><br>
        住所:<input type="text" name="address" value=""><br><br>
        災害の種類:<input type="text" name="type" value=""><br><br>
        <input type="submit" name="regist" value="投稿">
    </form>
</body>
<?php
?>
</html>

<?php
    try {
        $host = 'localhost';
        $dbname = 'pd';
        $dbuser = 'root';
        $dbpassword = "";
        $pdo = new PDO("mysql:host=$host;port=3308;dbname=$dbname;charset=utf8","$dbuser","$dbpassword");
#        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
         exit('データベース接続失敗。'.$e->getMessage());
        }
    
    
    #データベースへの登録
    if( isset($_POST['regist']) ){
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        $picture = $_POST['picture'];
        $postDate = $_POST[date('Y-m-d H:i:s')];
        $address = $_POST['address'];
        $type = $_POST['type'];

        $stmt = $pdo -> prepare("INSERT INTO user (name, comment) VALUES (:name, :comment)");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        $stmt->bindParam(':picture', $picture, PDO::PARAM_STR);
        $stmt->bindParam(date('Y-m-d H:i:s'), $postDate, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->execute();
        $pdo->query($stmt);
        header("Location: " . $_SERVER['PHP_SELF']);
    }
    #テーブル内容の表示
    $sql = "SELECT * FROM user ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    foreach ((array)$stmt as $row) {
        #echo htmlspecialchars($row['name'], ENT_QUOTES|ENT_HTML5).' '.htmlspecialchars($row['comment'], ENT_QUOTES|ENT_HTML5);
        echo '<br>';
    }
?>