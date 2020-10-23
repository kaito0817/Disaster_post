<?php
//データベースに接続するために必要なデータソースを変数に格納
//mysql:ホスト名;dbname = データベース名;charset = 文字エンコード
$sq1 = "SELECT * FROM DISASTER_INFORMATIONDISASTER_INFORMATION";
$stmt = $dbh'mysql:localhost;dbname = DISASTER_INFORMATION;charset = utf8';

//データベースのユーザー名
$user = ''

//データベースのパスワード
$password = ''

//tryにPDOの処理を追加
try{

  //PDOインスタンスの作成
  $dbh = new PDO($dsn, $user, $password);

//例外処理の記述
} catch (PDOException $e){

  //エラーメッセージの表示
  echo 'データベースにアクセスできません'. $e->getMessage();

  //強制終了
  exit;

}
?>
