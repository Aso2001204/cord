<?php
$pdo = new PDO('mysql:host=mysql139.phy.lolipop.lan;
                dbname=LAA1290556-mikado',
    'LAA1290556',
    'mikado');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>検索結果画面</title>
</head>
<body>
<header></header>
<h1>おすすめ商品</h1>
<?=$output?>
<footer></footer>
</body>
</html>
