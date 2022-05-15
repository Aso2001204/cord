<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>結果表示</title>
    <link rel="stylesheet" href="./css/style1.css">
</head>
<body>

<?php
//PDOインスタンス作成（DBへのリクエスト開始）
$pdo = new PDO('mysql:host=mysql152.phy.lolipop.lan;
               dbname=LAA1290550-school;charset=utf8',
                'LAA1290550',
                'Aso2001204');
echo '<p name="open">DB_OPEN</p>';
echo '<div class="ans">';

//SQL文の作成
$sql = $pdo->prepare('select * from user where mail = ? && password = ?');
$sql -> execute([$_POST['email'],$_POST['pass']]);

//通常時
foreach($sql as $row){
    if( !( is_null($row['user_name']) ) ){
        echo 'こんにちは、',$row['user_name'] ,'さん';
    }
}
//E-mailに不備があるとき
/*
$sql = $pdo->prepare('select * from user where mail <> ? && password = ?');
$sql -> execute([$_POST['email'],$_POST['pass']]);

foreach($sql as $row){
    echo 'E-mail：',$_POST['email'],'が違います';
}
//Passwordに不備があるとき
$sql = $pdo->prepare('select * from user where mail = ? && password <> ?');
$sql -> execute([$_POST['email'],$_POST['pass']]);

foreach($sql as $row){
        echo 'Password：',$_POST['pass'],'が違います';
}

//両方に不備があるとき

$sql = $pdo->prepare('select * from user where mail <> ? && password <> ?');
$sql -> execute([$_POST['email'],$_POST['pass']]);

echo 'E-mail：',$_POST['email'] , '及び Password：',$_POST['pass'],'が違います';
*/
//終了処理
$pdo = null;
echo '</div>';
echo '<p name="close">DB_CLOSE</p>';
?>
</body>
</html>