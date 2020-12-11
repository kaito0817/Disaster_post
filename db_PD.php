$ vim mysq_pdo.php
<?php
$user = 'root';
$pass = 'wsxplm3v8i';

try {
  $pdo = new PDO('mysql:host=localhost;dbname=pd;charset=utf8', $user, $pass);
  $dsn = $pdo->query('SELECT * FROM `pd` LIMIT 0 , 30');

  $dsn->execute();
  $all = $dsn->fetchAll();

  foreach ($all as $row) {
    echo $row['ID'] ."\t" .$row['PICTURE'] ."\t" .$row['POSTED_DATE'] ."\t" .$row['POSTED_TIME'] ."\t" .$row['LATITUDE'] ."\t" .$row['LONGITUDE'] ."\t" .$row['COMMENT'] ."\t" .$row['ADDRESS'] ."\t" .$row['TYPE'] . "\n";
  }

// 接続を閉じる
  $dsn = null;
  $pdo = null;

} catch (PDOException $e) { // PDOExceptionをキャッチする
    print "エラー!: " . $e->getMessage() . "<br/gt;";
    die();
}

?>
