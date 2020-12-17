<!DOCTYPE HTML>
<html lang="ja">

<head>
<link rel="stylesheet" href="stylesheet.css">
</head>

<body>
<h1>野々市市災害掲示板</h1>
<title>野々市市災害掲示板</title>
<img src="img/nonoichi.jpg" width="400" height="260">
    <form action="" method="post" enctype="multipart/form-data">
        ユーザー名:<input type="text" name="name" value=""><br><br>
        メッセージ:<input type="text" name="comment" value=""><br><br>
        投稿画像:<input type="file" name="picture" value=""><br><br>
        住所:<select name="address">
                    <option value="栗田">栗田</option>
                    <option value="稲荷">稲荷</option>
                    <option value="扇が丘">扇が丘</option>
                    <option value="御経塚">御経塚</option>
                    <option value="押越">押越</option>
                    <option value="押野">押野</option>
                    <option value="上林">上林</option>
                    <option value="清金">清金</option>
                    <option value="位川">位川</option>
                    <option value="郷">郷</option>
                    <option value="郷町">郷町</option>
                    <option value="三野">三野</option>
                    <option value="下林">下林</option>
                    <option value="新庄">新庄</option>
                    <option value="末松">末松</option>
                    <option value="菅原町">菅原町</option>
                    <option value="住吉町">住吉町</option>
                    <option value="高橋町">高橋町</option>
                    <option value="田尻町">田尻町</option>
                    <option value="太平寺">太平寺</option>
                    <option value="徳本">徳本</option>
                    <option value="藤平田">藤平田</option>
                    <option value="中林">中林</option>
                    <option value="長池">長池</option>
                    <option value="野代">野代</option>
                    <option value="白山町">白山町</option>
                    <option value="藤平">藤平</option>
                    <option value="二日市">二日市</option>
                    <option value="二日市町">二日市町</option>
                    <option value="堀内">堀内</option>
                    <option value="本町">本町</option>
                    <option value="三日市">三日市</option>
                    <option value="柳町">柳町</option>
                    <option value="矢作">矢作</option>
                    <option value="横宮町">横宮町</option>
                    <option value="蓮花寺町">蓮花寺町</option>
                    <option value="若松町">若松町</option>
                </select><br><br>
        災害の種類:<select name="type">
                    <option value="地震">地震</option>
                    <option value="大雪">大雪</option>
                    <option value="洪水">洪水</option>
                    <option value="火事">火事</option>
                    <option value="竜巻">竜巻</option>
                    <option value="その他">その他</option>
                   </select><br><br>
            <input type="submit" name="regist" value="投稿">
    </form>
</body>
</html>

<?php
try {
    $host = 'localhost';
    $dbname = 'pd';
    $dbuser = 'root';
    $dbpassword = "";
    $pdo = new PDO("mysql:host=$host;port=3308;dbname=$dbname;charset=utf8","$dbuser","$dbpassword");

    } catch (PDOException $e) {
     exit('データベース接続失敗。'.$e->getMessage());
    }

    #データベースへの登録
if(isset($_POST['regist'])){
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $address = $_POST['address'];
    $type = $_POST['type'];
    $image = uniqid(mt_rand(), true);//ファイル名をユニーク化
    $image .= '.' . substr(strrchr($_FILES['picture']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
    $file = "img/$image";
    
    $sql1 = "INSERT INTO pd (name, comment, picture, date, address, type) VALUES (:name, :comment, :picture, now(), :address, :type)";
    $stmt1 = $pdo -> prepare($sql1);
    $params = array(':name'=> $name,':comment'=>$comment,':picture'=>$image,':address'=>$address,':type'=>$type);
    if (!empty($_FILES['picture']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
        move_uploaded_file($_FILES['picture']['tmp_name'], './img/' . $image);//imagesディレクトリにファイル保存
    }
    $stmt1->execute($params);

    }
    #テーブル内容の表示
    $sql2 = "SELECT * FROM pd";
    $stmt2 = $pdo->query($sql2);
    foreach($stmt2 as $row){
        $img = "$row[picture]";
        echo '--------------------'.'<br>'.
            '氏名:'.$row['name'].'<br>'.
            'メッセージ:'.$row['comment'].'<br>'.
            #'写真:'.$row['picture'].'<br>'.
            '日付:'.$row['date'].'<br>'.
            '場所:'.$row['address'].'<br>'.
            '災害の種類:'.$row['type'].'<br>';
        echo '写真:'.'<br>';
        echo "<img src = './img/$img' width = '500' height = '300'>";
        echo '<br>';  
    }

?>